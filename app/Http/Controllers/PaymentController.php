<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Group;
use App\Member;
use App\SetPayment;

class PaymentController extends Controller
{
    public function index($id){
        $memberList = DB::table('members')->join('users', 'members.user_id','users.id')->select('users.name','users.id')->where('members.status', 'accepted')->get();
        
        return response()->json($memberList, 200);
    }

    public function addPaymentView(){
        return view('pages.addPayment');
    }

    public function addPayment(Request $request){
        $validated = Validator::make($request->all(), [
            'nominal' => 'numeric'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $exist = SetPayment::select('index_row')->where('group_id', $request->route('id'))->latest()->first();

        if(!empty($exist)){     
            
            $payment = new SetPayment();
            $payment->group_id = $request->route('id');
            $payment->index_row = $exist->index_row + 1;
            $payment->nominal = $request->get('nominal');
            $payment->save();

            return response()->json($payment, 201);
        }

        $payment = new SetPayment();
        $payment->group_id = $request->route('id');
        $payment->index_row = 1;
        $payment->nominal = $request->get('nominal');
        $payment->save();

        return response()->json($payment, 201);
    }
}
