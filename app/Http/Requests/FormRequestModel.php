<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Acme\Service\Jwt;

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

        /** @var Jwt $jwtService */
        $jwtService = App()->make(Jwt::class);

        return $jwtService->validate($token);
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
