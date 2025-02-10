<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $transaction;
    public $company;
    public $admin;
    public $receiving_wallet;
   
    /**
     * Create a new message instance.
     */
    public function __construct($transaction, $admin)
    {
        $this->transaction = $transaction;
        $this->admin = $admin;
        $this->receiving_wallet = Wallet::find($transaction->receiving_wallet_id);
        $this->company = Auth::user()->company;
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->company->email, $this->company->name),
             subject: 'Transaction Verification Notification',
         );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transaction_verification_email',
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
