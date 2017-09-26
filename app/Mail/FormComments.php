<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Acme\Dto\FormProcessRequest;

class FormComments extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var FormProcessRequest
     */
    protected $formRequest;

    /**
     * FormComments constructor.
     * @param FormProcessRequest $request
     */
    public function __construct(FormProcessRequest $request)
    {
        $this->formRequest = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.comments')
            ->with([
                'name' => $this->formRequest->getName(),
                'email' => $this->formRequest->getEmail(),
                'comments' => $this->formRequest->getComments(),
            ]);
    }
}
