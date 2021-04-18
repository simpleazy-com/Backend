<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\DB;

use App\SetPayment;
use App\MemberPaymentStatus;

class ReportPayment implements FromCollection
{
    use Exportable;

    public $id;
    public $payment_id;

    public function __construct($id, $payment_id){
        $this->id = $id;
        $this->payment_id = $payment_id;
    }

    public function collection()
    {
        $exportableReport = DB::table('members')
        ->join('users', 'members.user_id', 'users.id')
        ->join('member_payment_status', 'members.id', 'member_payment_status.member_id')
        ->select('users.id','users.name', 'member_payment_status.status')
        ->where('members.group_id', $this->id)
        ->where('member_payment_status.payment_id', $this->payment_id)
        ->where('members.status', 'accepted')
        ->orderBy('members.isAdmin','desc')
        ->get();

        return $exportableReport;
    }
}
