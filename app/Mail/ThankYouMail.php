<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    // Public variable to store the contact name
    public $contactName;

    /**
     * Create a new message instance.
     */
    public function __construct($contactName)
    {
        // Initialize the contact name
        $this->contactName = $contactName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Define the subject of the email
        return new Envelope(
            subject: 'Thank You for Contacting Us!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Return the content for the email, with the passed contact name
        return new Content(
            view: 'emails.thank_you',  // Define the correct view file
            with: [
                'contactName' => $this->contactName,  // Pass the contact name to the view
            ]
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
