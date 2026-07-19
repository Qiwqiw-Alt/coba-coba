<?php
 require_once 'todo.php';

 if (isset($_POST['submit'])) {
    $todoModel = new todo();

    if ($todoModel->create($_POST)) {
        header("Location: homepage.php?status=success");
        exit;
    } else {
        echo "Error: ". $todoModel->getError();
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container bg-dark">
    <div>
        <div class="container bg-dark mt-5 text-white p-5 text-center">
            <h1 class="display-2"><strong> New Task </strong></h1>
        </div>

        
        <form action="" method="POST" class="pt-2 p-4 border text-white border-white border-3 rounded-4 d-flex flex-column gap-4">
            <div class="mb-2 mt-3">
                <label for="task" class="form-label">Task Name: </label>
                <input type="text" name="task" id="task" class="form-control" placeholder="Enter task name" required>
            </div>

            <div class="mb-2">
                <label for="description" class="form-label">Task Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter task Description">
            </div>

            <div class="mb-2">
                <label for="is_completed" class="form-label">Task Status</label>
                <select id="is_completed" name="is_completed" class="form-control">
                    <option value="0">Incomplete</option>
                    <option value="1">Complete</option>
                </select>
            </div>
        </form>
    

        <div class="container mt-5 d-flex gap-2">
            <button type="submit" name="submit" class="btn btn-success">Save</button>
            <button
                type="button"
                class="btn btn-light"
                onclick="window.location.href='homepage.php'">Exit
            </button>
        </div>
    </div>
</body>
</html>