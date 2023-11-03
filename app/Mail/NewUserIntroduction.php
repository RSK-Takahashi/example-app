<?php

namespace App\Mail;

// 186-15
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// class NewUserIntroduction extends Mailable
// 202-05
class NewUserIntroduction extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // 182-10
    public $subject = '新しいユーザーが追加されました！';
    // 186-15
    public User $toUser;
    public User $newUser;

    /**
     * Create a new message instance.
     */
    public function __construct(User $toUser, User $newUser)
    {
        // 186-15
        $this->toUser = $toUser;
        $this->newUser = $newUser;
    }

    // 182-10
    /**
     * Buile the message.
     * 
     * @return $this
     */
    public function build()
    {
        // return $this->view('email.new_user_introduction');
        // 189-20
        return $this->markdown('email.new_user_introduction');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'New User Introduction',
            // subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'view.name',
            // view: 'email.new_user_introduction',
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
