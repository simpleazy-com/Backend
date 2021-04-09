<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Events\InvoiceHasCreatedEvent;

use Auth;
use App\Group;
use App\Member;
use App\SetPayment;
use App\MemberPaymentStatus;

class PaymentController extends Controller
{
    public function index($id){
        // List Tagihan/payment milik sendiri
        $data['konten'] = MemberPaymentStatus::
        join('members','member_payment_status.member_id','members.id')
        ->join('set_payment','member_payment_status.payment_id','set_payment.id')
        ->selectRaw('members.user_id, member_payment_status.payment_id, set_payment.nominal, set_payment.deadline, member_payment_status.status')
        ->where('members.user_id',Auth::id())
        ->where('set_payment.group_id', $id)
        ->orderBy('set_payment.deadline', 'desc')
        ->get();
        return 
        // response()->json($data, 200);
        view('pages.paymentView', compact('data'));
    }

    public function addPaymentView($id){
        $memberList = DB::table('members')
                    ->join('users', 'members.user_id','users.id')
                    ->selectRaw('members.*, users.name')
                    ->where('group_id',$id)
                    ->get();
        return view('pages.addPayment', compact('memberList'));
    }

    public function addPayment(Request $request){
        
        $validated = Validator::make($request->all(), [
            'nominal' => 'required|numeric',
            'selected_member[]' => 'boolean',
            'deadline' => 'required|date'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $setPayment = SetPayment::select('index_row')->where('group_id', $request->route('id'))->latest()->first();

        if(!empty($setPayment)){     
            
            $payment = new SetPayment();
            $payment->group_id = $request->route('id');
            $payment->index_row = $setPayment->index_row + 1;
            $payment->nominal = $request->get('nominal');
            $payment->deadline = $request->get('deadline');
            $payment->save();

            // Invoice or Payment event occurs

            // event(new InvoiceHasCreatedEvent($payment));

            // select all member in this group
            
            foreach($request->selected_member as $sm){
                $paymentStatus = new MemberPaymentStatus();
                $paymentStatus->member_id = $sm;
                $paymentStatus->payment_id = $payment->id;
                $paymentStatus->status = 'belum_bayar';
                $paymentStatus->total = 0;
                $paymentStatus->save();
            }

            return response()->json($payment, 200);
        }

        $payment = new SetPayment();
        $payment->group_id = $request->route('id');
        $payment->index_row = 1;
        $payment->nominal = $request->get('nominal');
        $payment->deadline = $request->get('deadline');
        $payment->save();

        $setPayment = Member::where('group_id', $request->route('id'))
        ->get();

        foreach($setPayment as $sp){
            $paymentStatus = new MemberPaymentStatus();
            $paymentStatus->member_id = $sp->id;
            $paymentStatus->payment_id = $payment->id;
            $paymentStatus->status = 'belum_bayar';
            $paymentStatus->total = 0;
            $paymentStatus->save();
        }

        return response()->json($payment, 201);
    }

    public function checkUserPaymentStatus($id, $user_id){
        $listPayment = DB::table('set_payment')
                    ->join('member_payment_status', 'set_payment.id', 'member_payment_status.payment_id')
                    ->select('set_payment.nominal', 'set_payment.index_row', 'member_payment_status.status')
                    ->where('set_payment.group_id', $id)
                    ->where('member_payment_status.user_id', $user_id)
                    ->get();

        return response()->json($listPayment, 200);
    }

    public function userDetailPayment($id, $user_id, $index_row){
        // $detailPaymentByIndexRows = DB::table('');
    }    

    public function paymentList($id){
        $listPayment = DB::table('set_payment')
                    ->join('member_payment_status', 'set_payment.id', 'member_payment_status.payment_id')
                    ->join('members', 'set_payment.group_id','members.group_id')
                    ->select('members.user_id','set_payment.nominal', 'set_payment.index_row','member_payment_status.status')
                    ->where('set_payment.group_id', $id)
                    ->get();
                    
        return response()->json($listPayment, 200); 
    }

    public function paymentAdminView($id){
        // List tagihan beserta berapa orang yang bayar dibanding semua yang menerima kontrak tagihan
        $data['id'] = $id;

        $data['payment'] = SetPayment::
        where('set_payment.group_id',$id)
        ->selectRaw('set_payment.id, nominal, deadline')
        // ->orderBy('set_payment.id', 'desc')
        ->get();
        
        $data['payment_status'] = null;
        $i = 0;
        foreach($data['payment'] as $payment){
            $data['payment_status'][$i] = MemberPaymentStatus::
            where('member_payment_status.payment_id',$payment -> id)
            ->get();
            $i++;
        }
        // $data['konten'] = SetPayment::
        // join('member_payment_status','set_payment.id','member_payment_status.payment_id')
        // ->selectRaw('nominal, deadline, count(member_payment_status.id)')
        // ->where('group_id',$id)
        // ->groupBy('set_payment.id')
        // ->get();
        $data['perbandingan_jumlah_tagihan'][] = null;
        $i = 0;
        foreach($data['payment_status'] as $paymentStatus){
            $totalTagihan = 0;
            $sudahBayar = 0;
            foreach($paymentStatus as $ps){
                if($ps->status != "belum_bayar"){
                    $sudahBayar++;   
                }
                $totalTagihan++;
            }
            $data['perbandingan_jumlah_tagihan'][$i]['sudah_bayar'] = $sudahBayar;
            $data['perbandingan_jumlah_tagihan'][$i]['total_tagihan'] = $totalTagihan;
            $i++;
        }
        // return response()->json($data['payment_status'], 200);
        return view('pages.paymentAdmin', compact('data'));
    }
}
