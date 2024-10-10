<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>

<body>
    <h1>To-Do List</h1>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><a href="index.php?action=delete&id=<?php echo $task->getId(); ?>">delete</a> |
              <?php echo htmlspecialchars($task->getTitle()); ?>
               <?php echo $task->isCompleted() ? '(Tamamlandı)' : ''; ?></li>
        <?php endforeach; ?>
    </ul>

    <form method="POST" action="index.php">
        <input type="text" name="title" required placeholder="Yeni tapşırıq">
        <button type="submit">Əlavə et</button>
    </form>
</body>

</html>