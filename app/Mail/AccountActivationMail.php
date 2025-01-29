<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountActivationMail extends Mailable
{
    use Queueable, SerializesModels;
    public  $company;
    public  $user;
    public  $reason;
    public $admin;
    /**
     * Create a new message instance.
     */
    public function __construct($company, $reason)
    {
       $this->admin = Company::where('type','admin')->first();
       $this->company = $company;
       $this->user = $company->user;
       $this->reason = $reason;
      
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->admin->noreply, 'NoReply'),
             subject: 'Account Activation Status',
         );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.activation',
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
