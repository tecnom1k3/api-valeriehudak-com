<?php

namespace Acme\Service;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\BaseSigner;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Jwt
{
    const CONFIG_JWT_ISSUER     = 'jwt.issuer';
    const CONFIG_JWT_AUDIENCE   = 'jwt.audience';
    const CONFIG_JWT_EXPIRATION = 'jwt.expiration';
    const HASH_ALGO             = 'sha256';
    const ID_NUM_BYTES          = 32;
    const ID_MORE_ENTROPY       = true;

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
     * @var ValidationData
     */
    protected $validationData;

    public function __construct(ValidationData $validationData)
    {
        $this->validationData = $validationData;
        $this->validationData->setIssuer(config(self::CONFIG_JWT_ISSUER));
        $this->validationData->setAudience(config(self::CONFIG_JWT_AUDIENCE));
    }

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
        $currentTime = time();
        $expiration = $this->getExpirationTimeStamp($currentTime);

        $token = $this->builder->setIssuer($this->validationData->get('iss'))
        ->setAudience($this->validationData->get('aud'))
        ->setId($this->generateId(), true)
        ->setIssuedAt($currentTime)
        ->setNotBefore($currentTime)
        ->setExpiration($expiration)
        ->sign($this->signer, $this->key)
        ->getToken();

        return (string)$token;
    }

    /**
     * @param int $timeStamp
     * @return int
     */
    protected function getExpirationTimeStamp(int $timeStamp): int
    {
        return $timeStamp + intval(config(self::CONFIG_JWT_EXPIRATION));
    }

    /**
     * @return string
     */
    protected function generateId(): string
    {
        return base64_encode(
            hash(
                self::HASH_ALGO,
                uniqid(
                    random_bytes(self::ID_NUM_BYTES),
                    self::ID_MORE_ENTROPY
                ),
                true
            )
        );
    }

    /**
     * @param $jwt
     * @return bool
     */
    public function validate($jwt): bool
    {
        $token = (new Parser())->parse($jwt);
        if( $token->verify($this->signer, $this->key))
        {
            return $token->validate($this->validationData);
        }

        return false;
    }
}