<?php


namespace App\Entity;


class Comment
{
    protected int $id;
    protected int $postId;
    protected int $userId;
    protected string $comment;
    protected mixed $createdAt;
    protected mixed $updatedAt;
    protected mixed $approved;

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
     * @param int $id
     * @return Comment
     */
    public function setId(int $id): Comment
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
     * @param mixed $createdAt
     * @return Comment
     */
    public function setCreatedAt(mixed $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param mixed $updatedAt
     * @return Comment
     */
    public function setUpdatedAt(mixed $updatedAt): Comment
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param mixed $approved
     * @return Comment
     */
    public function setApproved(mixed $approved): Comment
    {
        $this->approved = $approved;
        return $this;
    }


}