<?php


namespace App\Entity;


class Comment
{
    protected ?int $id;
    protected int $postId;
    protected int $userId;
    protected string $comment;
    protected ?string $createdAt;
    protected ?string $updatedAt;
    protected ?int $approved = 0;

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
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
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
     * @return mixed
     */
    public function getApproved(): mixed
    {
        return $this->approved;
    }

    /**
     * @param int|null $id
     * @return Comment
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int $postId
     * @return Comment
     */
    public function setPostId(int $postId): Comment
    {
        $this->postId = $postId;
        return $this;
    }

    /**
     * @param int $userId
     * @return Comment
     */
    public function setUserId(int $userId): Comment
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param string $comment
     * @return Comment
     */
    public function setComment(string $comment): Comment
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @param string|null $createdAt
     * @return Comment
     */
    public function setCreatedAt(?string $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param string|null $updatedAt
     * @return Comment
     */
    public function setUpdatedAt(?string $updatedAt): Comment
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param int|null $approved
     * @return Comment
     */
    public function setApproved(?int $approved): Comment
    {
        $this->approved = $approved;
        return $this;
    }


}