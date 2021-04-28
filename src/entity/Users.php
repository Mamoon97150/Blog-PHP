<?php


namespace App\Entity;


use DateTime;

class Users
{
    protected ?int $id;
    protected string $img;
    protected string $username;
    protected string $email;
    protected string $password;
    protected ?DateTime $createdAt;
    protected ?DateTime $updatedAt;
    protected string $role;

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): mixed
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt(): mixed
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param int|null $id
     * @return Users
     */
    public function setId(?int $id): Users
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $img
     * @return Users
     */
    public function setImg(string $img): Users
    {
        $this->img = $img;
        return $this;
    }

    /**
     * @param string $username
     * @return Users
     */
    public function setUsername(string $username): Users
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $email
     * @return Users
     */
    public function setEmail(string $email): Users
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return Users
     */
    public function setPassword(string $password): Users
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param DateTime|null $createdAt
     * @return Users
     */
    public function setCreatedAt(?DateTime $createdAt): Users
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param DateTime|null $updatedAt
     * @return Users
     */
    public function setUpdatedAt(?DateTime $updatedAt): Users
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param string $role
     * @return Users
     */
    public function setRole(string $role): Users
    {
        $this->role = $role;
        return $this;
    }


}