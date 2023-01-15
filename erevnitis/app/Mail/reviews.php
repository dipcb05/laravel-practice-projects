<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class reviews extends Mailable
{
    use Queueable, SerializesModels;

    private $user, $post, $review;


    /**
     * Create a new message instance.
     *
     * @param $l
     */
    public function __construct($user, $post, $review)
    {

        $this->user = $user;
        $this->review = $review;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('mail.reviews')
        ->with([
        'user' => $this->user,
            'post' => $this->post,
            'review' => $this->review
    ]);
    }
}
