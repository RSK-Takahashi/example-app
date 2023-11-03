<?php

namespace App\Mail;

// 213-07
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// class DailyTweetCount extends Mailable
// 213-07
class DailyTweetCount extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // 213-07
    public User $toUser;
    public int $count;

    /**
     * Create a new message instance.
     */
    // public function __construct()
    // 213-07
    public function __construct(User $toUser, int $count)
    {
        // 213-07
        $this->toUser = $toUser;
        $this->count = $count;
    }

    // 213-07
    /**
     * Build the message.
     * 
     * @return $this
     */
    public function build()
    {
        return $this->subject("昨日は{$this->count}件のつぶやきが追加されました！")
            ->markdown('email.daily_tweet_count');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // コメントアウトしないとこちらが優先される
            // subject: 'Daily Tweet Count',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
