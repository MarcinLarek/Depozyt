<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlatformData;

class ResetPasswordMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $varmail = $request->email;
        $uservar =  User::where('email', $varmail)->first();
        $data = PlatformData::where('id', 1)->first();
        return $this->subject(__('mail.RES-title'))->markdown('emails.reset-password')
                  ->with('uservar', $uservar)
                  ->with('data', $data);
    }
}
