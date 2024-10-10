<?php

class TaskController
{
    private TaskRepositoryInterface $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }


    public function index(): void
    {
        $tasks = $this->taskRepo->all();
        include __DIR__ . '/../Views/tasks/index.php';
    }

    public function save()
    {
        // var_dump($_POST);
        // die();
        if (isset($_POST['title'])) {
            $title = trim($_POST['title']);
            $description = '';
            $task = new Task($title, $description);
            $this->taskRepo->save($task);


            header('Location: index.php');
            exit();
        }

        header('Location: index.php');
        exit();
    }

    public function delete(): void {
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            $this->taskRepo->delete($id);
        }
        header("Location: index.php");
        exit();
    }
}
