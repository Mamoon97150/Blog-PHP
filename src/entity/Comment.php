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

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        $this->id = $data['id'];
        $this->postId = $data['post_id'];
        $this->userId = $data['user_id'];
        $this->comment = $data['comment'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['created_at'];
        $this->approved = $data['approved'];
    }

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
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
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
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): mixed
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(mixed $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt(): mixed
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt(mixed $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getApproved(): mixed
    {
        return $this->approved;
    }

    /**
     * @param mixed $approved
     */
    public function setApproved(mixed $approved): void
    {
        $this->approved = $approved;
    }

}