<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Masterdata\employee;

class candidate_share extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $touser;
     public $link;
    public function __construct(employee $emp,string $link=null)
    {
        $this->touser=$emp->fname_en.'.'.substr($emp->lname_en,0,1);
        $this->link=$link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(auth()->user()->name.' Recommend Candidate For '.$this->touser)->view('mail.candidate_share');
    }
}
