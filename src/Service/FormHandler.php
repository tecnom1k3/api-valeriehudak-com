<?php
namespace Acme\Service;

use Acme\Dto\FormProcessRequest;
use App\Mail\FormComments as FormCommentsEmail;
use Illuminate\Support\Facades\Mail;

class FormHandler
{

    public function processForm(FormProcessRequest $request)
    {
        Mail::to(config('mail.address.comments.main'))
            ->bcc(config('mail.address.comments.bcc'))
            ->send(new FormCommentsEmail($request));
        return true;
    }
}