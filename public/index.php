<?php

require_once __DIR__ . '/../app/Models/Task.php';
require_once __DIR__ . '/../app/Interfaces/TaskRepositoryInterface.php';
require_once __DIR__ . '/../app/Repositories/FileTaskRepository.php';
require_once __DIR__ . '/../app/Controllers/TaskController.php';

$filePath = __DIR__ . '/../data/tasks.json';
$taskRepo = new FileTaskRepository($filePath);
$taskController = new TaskController($taskRepo);

// İstək metodu kontrol edərək uyğun metodu çağırırıq
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->save();
}elseif(isset($_GET['action']) && $_GET['action'] === 'delete'){
    $taskController->delete();
} else {
    // TaskController-in index metodunu çağırırıq
    $taskController->index();
}