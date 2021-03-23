<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\DeadlineMail;

use Mail;

class InvoiceStartScheduleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $group_id = $event->payment->group_id;
        $index_row = $event->payment->index_row;
        
        $members_email = DB::table('users')
                        ->join('members', 'users.id', 'members.user_id')
                        ->join('set_payment', 'members.group_id', 'set_payment.group_id')
                        ->select('users.email')
                        ->where('set_payment.group_id', $group_id)
                        ->where('set_payment.index_row', $index_row)
                        ->where('members.status', 'accepted')
                        ->get();
        

        foreach($members_email as $me){
            Log::info($me->email);
            Mail::to($me->email)->send(new DeadlineMail());
        }

        Log::info('Gpp abaikan aja cuma debug');

    }
    
    public function failed(OrderShipped $event, $exception)
    {
        Log::info('Failed to sending an email!');
    }
}
