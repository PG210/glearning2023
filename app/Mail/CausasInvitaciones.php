<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CausasInvitaciones extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $nombrejugador;
    public $description;


    public function __construct($nombrejugador, $description)
    {
        //
        $this->nombrejugador = $nombrejugador;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.invitaciones')->with([
            'nombrejugador' => $this->nombrejugador,
            'description' => $this->description, 
        ]); 
    }
}
