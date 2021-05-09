<?php


namespace App\Entity;


class Messages
{
    protected ?int $id;
    protected string $name;
    protected string $email;
    protected string $subject;
    protected string $message;
    protected ?string $createdAt;
    protected ?string $updatedAt;
    protected ?int $answered;
    protected ?string $answer = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @return int|null
     */
    public function getAnswered(): ?int
    {
        return $this->answered;
    }

    /**
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }


    /**
     * @param int|null $id
     * @return Messages
     */
    public function setId(?int $id): Messages
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     * @return Messages
     */
    public function setName(string $name): Messages
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return Messages
     */
    public function setEmail(string $email): Messages
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $subject
     * @return Messages
     */
    public function setSubject(string $subject): Messages
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param string $message
     * @return Messages
     */
    public function setMessage(string $message): Messages
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string|null $createdAt
     * @return Messages
     */
    public function setCreatedAt(?string $createdAt): Messages
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string|null $updatedAt
     * @return Messages
     */
    public function setUpdatedAt(?string $updatedAt): Messages
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param int|null $answered
     * @return Messages
     */
    public function setAnswered(?int $answered): Messages
    {
        $this->answered = $answered;
        return $this;
    }

    /**
     * @param string|null $answer
     * @return Messages
     */
    public function setAnswer(?string $answer): Messages
    {
        $this->answer = $answer;
        return $this;
    }

}