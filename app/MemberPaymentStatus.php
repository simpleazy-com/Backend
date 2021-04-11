<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberPaymentStatus extends Model
{
    protected $table = 'member_payment_status';

    protected $fillable = ['member_id', 'payment_id', 'status', 'total'];

}
