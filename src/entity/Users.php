<?php


namespace App\Entity;



class Users
{
    protected ?int $id;
    protected string $img;
    protected string $username;
    protected string $email;
    protected string $password;
    protected ?string $createdAt;
    protected ?string $updatedAt;
    protected ?string $role;
    protected ?string $token;
    protected ?string $expDate;

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
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function getExpDate(): ?string
    {
        return $this->expDate;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
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
     * @param string|null $createdAt
     * @return Users
     */
    public function setCreatedAt(?string $createdAt): Users
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string|null $updatedAt
     * @return Users
     */
    public function setUpdatedAt(?string $updatedAt): Users
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param string|null $role
     * @return Users
     */
    public function setRole(?string $role): Users
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @param string|null $expDate
     * @return Users
     */
    public function setExpDate(?string $expDate): Users
    {
        $this->expDate = $expDate;
        return $this;
    }

    /**
     * @param string|null $token
     * @return Users
     */
    public function setToken(?string $token): Users
    {
        $this->token = $token;
        return $this;
    }


}