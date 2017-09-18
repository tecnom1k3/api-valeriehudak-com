<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Acme\Service\Jwt;
use Acme\Service\ReCaptcha;

class FormRequestModel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $token = $this->request->get('token');
        $captcha = $this->request->get('g-recaptcha-response');

        /** @var Jwt $jwtService */
        $jwtService = App()->make(Jwt::class);

        /** @var ReCaptcha $captchaService */
        $captchaService = App()->make(ReCaptcha::class);

        if ($jwtService->validate($token)) {
            return $captchaService->validate($captcha);
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'comments' => 'required',
            'token' => 'required',
            'g-recaptcha-response' => 'required',
        ];
    }
}
