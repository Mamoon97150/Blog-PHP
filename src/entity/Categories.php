<?php


namespace App\Entity;


class Categories
{
    protected int $id;
    protected string $name;


    /**
     * @return int
     */
    public function getId(): int
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
     * @param int $id
     * @return Categories
     */
    public function setId(int $id): Categories
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}