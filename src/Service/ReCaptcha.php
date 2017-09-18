<?php
namespace Acme\Service;

use GuzzleHttp\Client;

class ReCaptcha
{
    const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * @var Client
     */
    protected $httpClient;

    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @param string $token
     * @return bool
     */
    public function validate(string $token):bool
    {
        $result = $this->httpClient->post(
            self::VERIFY_URL,
            [
                'form_params' => [
                    'secret' => getenv('CAPTCHA_SECRET'),
                    'response' => $token
                ],
            ]
        );

        $responseData = json_decode($result->getBody()->getContents());

        return $responseData->success === true;
    }

}