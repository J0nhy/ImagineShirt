<?php

namespace App\Mail;

use App\Models\order_items;
use App\Models\orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\tshirt_images;
use Illuminate\Support\Facades\View;
use stdClass;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;
    public $encomenda;
    public $itens;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->encomenda = orders::find($id);
        $this->itens = order_items::where('order_id', $id)->get();
        
        foreach ($this->itens as $item) {
            $item->load('tshirtImage'); // Carregar a relação com a tabela tshirt_images
        }
        //dd($this->encomenda, $this->itens);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Recibo Encomenda - ImagineShirt',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.emailEncomenda',
            with: ['encomenda' => $this->encomenda,'itens' => $this->itens],
        );
    }

    /*public function sendMail($id){

        $encomenda = orders::find($id);
        $itens = order_items::where('order_id', $id)->get();

        foreach ($itens as $item) {
            $item->load('tshirtImage'); // Carregar a relação com a tabela tshirt_images
        }

        Mail::to(Auth::user()->email)->send(new MailSender($encomenda, $itens));
    }*/
}