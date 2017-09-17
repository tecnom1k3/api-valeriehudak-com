<?php

namespace Acme\Service;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\BaseSigner;

class Jwt
{

    /**
     * @var \Lcobucci\JWT\Signer\BaseSigner
     */
    protected $signer;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var string
     */
    protected $key;

    /**
     * @param BaseSigner $signer
     * @return Jwt
     */
    public function setSigner(BaseSigner $signer): Jwt
    {
        $this->signer = $signer;
        return $this;
    }

    /**
     * @param Builder $builder
     * @return Jwt
     */
    public function setBuilder(Builder $builder): Jwt
    {
        $this->builder = $builder;
        return $this;
    }

    /**
     * @param string $key
     * @return Jwt
     */
    public function setKey(string $key): Jwt
    {
        $this->key = $key;
        return $this;
    }


    /**
     * @return string
     */
    public function get(): string
    {
        $id = base64_encode(
            hash(
                'sha256',
                uniqid(
                    random_bytes(16),
                    true
                ),
                true
            )
        );

        $token = $this->builder->setIssuer(getenv('JWT_ISS'))// Configures the issuer (iss claim)
        ->setAudience(getenv('JWT_ISS'))// Configures the audience (aud claim)
        ->setId($id, true)// Configures the id (jti claim), replicating as a header item
        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
        ->setNotBefore(time())// Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + intval(getenv('JWT_EXPIRATION')))// Configures the expiration time of the token (exp claim)
        ->sign($this->signer, $this->key)
        ->getToken(); // Retrieves the generated token

        return (string)$token;
    }
}