<?php
namespace Acme\Service;

use Acme\Dto\FormProcessRequest;
use App\Mail\FormComments as FormCommentsEmail;
use Illuminate\Support\Facades\Mail;

class FormHandler
{

    public function processForm(FormProcessRequest $request)
    {
        Mail::to(getenv('MAIL_COMMENTS_TO_ADDRESS'))
            ->send(new FormCommentsEmail($request));
        return true;
    }
}