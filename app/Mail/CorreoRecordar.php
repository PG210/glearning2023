<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorreoRecordar extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nombre;

    public $ran;

    public $cap;

    public function __construct($nombre, $ran, $cap)
    {
        $this->nombre = $nombre;
        $this->ran = $ran;
        $this->cap = $cap;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
   

    public function build()
    {
        return $this->view('mails.avance')
        ->with(['nombre' => $this->nombre, 'ran' => $this->ran, 'cap' => $this->cap]);
    }
}
