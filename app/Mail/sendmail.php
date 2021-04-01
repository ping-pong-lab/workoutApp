<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $title;
    protected $name;
    protected $mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$mail)
    {
        //
        $this->title = "パスワード再設定用URLのご連絡";
        $this->name = $name ;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('login.mail.mail_forgetpass')
                    ->text('login.mail.plaintext_forgetpass')
                    ->subject($this->title)
                    ->with([
                        'name' => $this->name,
                        'mail' => $this->mail,
                      ]);
    }
}
