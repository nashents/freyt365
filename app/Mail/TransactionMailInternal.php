<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionMailInternal extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $transaction;
    public $receiving_wallet;
    public $admin;
   
    /**
     * Create a new message instance.
     */
    public function __construct($transaction,$receiving_wallet, $admin)
    {
        $this->transaction = $transaction;
        $this->receiving_wallet = $receiving_wallet;
        $this->admin = $admin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->admin->noreply, $this->admin->name),
             subject: 'Transaction Notification',
         );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transactions_internal',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
