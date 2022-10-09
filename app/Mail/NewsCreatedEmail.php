<?php

namespace App\Mail;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $news;

    public $unsubscribeLink;

    /**
     * Create a new message instance.
     *
     * @param  News  $news
     * @param  string  $unsubscribeLink
     */
    public function __construct(News $news, string $unsubscribeLink)
    {
        $this->news = $news;
        $this->unsubscribeLink = $unsubscribeLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('newsletter.news.subject'))
        ->markdown('emails.news-created', ['news' => $this->news, 'unsubscribeLink' => $this->unsubscribeLink]);
    }
}
