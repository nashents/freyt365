<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Wallet;
use App\Models\BankAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $transaction;
    public $receiving_wallet;
    public $admin;
   
    /**
     * Create a new message instance.
     */
    public function __construct($transaction, $admin)
    {
        $this->transaction = $transaction;
        if ($transaction->receiving_wallet_id) {
            $this->receiving_wallet = Wallet::find($transaction->receiving_wallet_id);
        }
        $this->admin = $admin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->admin->email, $this->admin->name),
             subject: 'Transaction Notification',
         );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transactions',
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
