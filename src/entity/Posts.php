<?php


namespace App\Entity;


use DateTime;

class Posts
{
    private ?int $id;
    private int $categoryId;
    private string $title;
    private string $hook;
    private string $content;
    private ?string $createdAt;
    private ?string $updatedAt;
    private string $img;
    private int $userId;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): Posts
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): Posts
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHook()
    {
        return $this->hook;
    }

    /**
     * @param mixed $hook
     */
    public function setHook($hook): Posts
    {
        $this->hook = $hook;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): Posts
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): mixed
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): Posts
    {
        $this->img = $img;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): Posts
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param int|null $id
     * @return Posts
     */
    public function setId(?int $id): Posts
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $createdAt
     * @return Posts
     */
    public function setCreatedAt(?string $createdAt): Posts
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string|null $updatedAt
     * @return Posts
     */
    public function setUpdatedAt(?string $updatedAt): Posts
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}