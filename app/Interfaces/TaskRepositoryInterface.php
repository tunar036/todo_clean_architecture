<?php

interface TaskRepositoryInterface
{
    public function all(): array;
    public function save(Task $task): void;
    public function find(int $id): ?Task;
    public function delete(int $id): void;
}
