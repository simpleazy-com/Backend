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
        $memberList = DB::table('members')
            ->join('users', 'members.user_id','users.id')
            ->select('users.name','users.id')
            ->where('members.status', 'accepted')
            ->where('members.group_id', $id)
            ->get();
        
        return response()->json($memberList, 200);
    }

    public function addPaymentView($id){
        $memberList = DB::table('members')
            ->join('users', 'members.user_id','users.id')
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
            event(new InvoiceHasCreatedEvent($payment));

            // select all member in this group

            foreach($request->selected_member as $sm){
                $paymentStatus = new MemberPaymentStatus();
                $paymentStatus->member_id = $sm;
                $paymentStatus->payment_id = $payment->id;
                $paymentStatus->status = 'belum_bayar';
                $paymentStatus->total = 0;
                $paymentStatus->save();
            }

            return response()->json($payment, 201);
        }

        $payment = new SetPayment();
        $payment->group_id = $request->route('id');
        $payment->index_row = 1;
        $payment->nominal = $request->get('nominal');
        $payment->deadline = $request->get('deadline');
        $payment->save();

        $setPayment = Member::where('group_id', $request->route('id'))->get();

        foreach($setPayment as $sp){
            $paymentStatus = new MemberPaymentStatus();
            $paymentStatus->member_id = $sp->user_id;
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

}
