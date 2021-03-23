<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Mail\DeadlineMail;

class MailController extends Controller
{
    public function mailer(){
        Mail::to('higanas@gmail.com')->send(new DeadlineMail());
        return '';
    }
}
