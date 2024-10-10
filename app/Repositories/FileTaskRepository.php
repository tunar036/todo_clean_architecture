<?php

trait TestTrait
{
    public function toArray($x)
    {
        return json_decode(file_get_contents($this->filePath), true) ?? [];
    }
}


class FileTaskRepository implements TaskRepositoryInterface
{
    use TestTrait;
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function all(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $data = json_decode(file_get_contents($this->filePath), true);
        $tasks = [];
        if ($data === null) {
            return []; // JSON düzgün formatda deyilsə, boş array döndər
        }
        foreach ($data as $taskData) {
            $task = new Task($taskData['title'], $taskData['description']);
            $task->setId($taskData['id']);
            if ($taskData['completed']) {
                $task->complete();
            }
            $tasks[] = $task;
        }
        return $tasks;
    }


    public function save(Task $task): void
    {
        // $tasks = json_decode(file_get_contents($this->filePath), true) ?? [];
        $tasks = $this->toArray($this->filePath);
        $task->setId(count($tasks) + 1);
        $tasks[] = [
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'completed' => $task->isCompleted()
        ];

        file_put_contents($this->filePath, json_encode($tasks, JSON_PRETTY_PRINT));
    }

    public function find(int $id): ?Task
    {
        $tasks = $this->all();
        foreach ($tasks as $task) {
            if ($task->getId() === $id) {
                return $task;
            }
        }
        return null;
    }

    public function delete(int $id): void
    {
        $tasks = $this->all();
        $newTasks = array_filter($tasks, function($task) use($id){
            return $task->getId() !== $id;
        });
        $tasksArray =  array_map(function($task){
            return [
                'id'=>$task->getId(),
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'completed' => $task->isCompleted()
            ];
        },$newTasks);
        file_put_contents($this->filePath, json_encode($tasksArray, JSON_PRETTY_PRINT));

    }
}
