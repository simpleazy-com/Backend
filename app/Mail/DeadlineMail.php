<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeadlineMail extends Mailable
{
    use Queueable, SerializesModels;

    public $deadline;
    public $group_name;

    public function __construct($deadline, $group_name)
    {
        $this->deadline = $deadline;
        $this->$group_name = $group_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.deadline-mail', [
            'deadline' => $this->deadline,
            'group_name' => $this->group_name,
        ]);
    }
}
