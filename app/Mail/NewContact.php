<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    //Creo una proprietà pubblica per passarla al costruttore al momento della creazione dell'oggetto
    //Questa possibilità è consentita SOLO negli oggetti di tipo Mail
    public $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_lead)
    {
        $this->lead = $_lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //Posso non specificare compact, grazie alla proprietà pubblica creata in precedenza che Laravel riesce a leggere
        return $this->view('emails.new-contact');
    }
}
