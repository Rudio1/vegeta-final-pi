<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMailRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $text;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($text, $content)
    {
        $this->text = $text;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->text)->view('emails.meuemail', ['conteudo' => $this->content]);
    }
}
