<?php

namespace App\Mail;

use App\Models\NewsletterEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletterEmail;

    public $subscribeLink;

    /**
     * Create a new message instance.
     *
     * @param  NewsletterEmail  $newsletterEmail
     * @param  string  $subscribeLink
     */
    public function __construct(NewsletterEmail $newsletterEmail, string $subscribeLink)
    {
        $this->newsletterEmail = $newsletterEmail;
        $this->subscribeLink = $subscribeLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('newsletter.verify.subject', ['app_name' => config('app.name')]))
        ->markdown('emails.verify-email', ['email' => $this->newsletterEmail, 'subscribeLink' => $this->subscribeLink]);
    }
}
