<?php

class Task
{
    private int $id;
    private string $title;
    private string $description;
    private bool $completed;

    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
        $this->completed = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function isCompleted(): bool
    {
        return $this->completed;
    }
    public function complete(): void
    {
        $this->completed = true;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
