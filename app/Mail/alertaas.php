<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class alertaas extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $mailobjeto;


    public function __construct($mailobjeto)
    {
        //
        $this->mailobjeto = $mailobjeto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.alertas')->with([
            'mailobjeto' => $this->mailobjeto, 
        ]);        
    }
}
