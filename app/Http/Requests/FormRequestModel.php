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
        $token   = $this->request->get('token');
        $captcha = $this->request->get('g-recaptcha-response');

        if ($token && $captcha) {
            /** @var Jwt $jwtService */
            $jwtService     = App()->make(Jwt::class);
            /** @var ReCaptcha $captchaService */
            $captchaService = App()->make(ReCaptcha::class);
            
            return $jwtService->validate($token) && $captchaService->validate($captcha);
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
            'name'                 => 'required|min:5|string',
            'email'                => 'required|email',
            'comments'             => 'required|min:10|string',
            'token'                => 'required|string|min:250',
            'g-recaptcha-response' => 'required|string|min:400',
        ];
    }
}
