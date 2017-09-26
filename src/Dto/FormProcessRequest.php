<?php
namespace Acme\Dto;


class FormProcessRequest
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $comments;

    /**
     * @param string $name
     * @return FormProcessRequest
     */
    public function setName(string $name): FormProcessRequest
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return FormProcessRequest
     */
    public function setEmail(string $email): FormProcessRequest
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $comments
     * @return FormProcessRequest
     */
    public function setComments(string $comments): FormProcessRequest
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getComments(): string
    {
        return $this->comments;
    }
}