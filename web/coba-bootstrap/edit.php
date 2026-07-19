<?php
    require_once 'todo.php';

    $todoModel = new todo();

    $id = $_GET['id'];
    $todo = $todoModel->getById($id);

    if (!$todo) {
        die ("Task is not found!");
    }

    if (isset($_POST['submit'])) {
        if($todoModel->update($id, $_POST)) {
            header("Location: homepage.php?status=updated");
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
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container bg-dark">
    <div>
        <div class="container bg-dark mt-5 text-white p-5 text-center">
            <h1 class="display-2"><strong>Edit Task</strong></h1>
        </div>

        
        <form action="" method="POST" class="pt-2 p-4 border text-white border-white border-3 rounded-4 d-flex flex-column gap-4">
            <div class="mb-2 mt-3">
                <label for="task" class="form-label">Task Name</label>
                <input type="text" name="task" id="task" class="form-control" value="<?php echo $todo['task']; ?>">
            </div>

            <div class="mb-2">
                <label for="description" class="form-label">Task Description</label>
                <input type="text" name="description" id="description" class="form-control" value="<?php echo $todo['description']?>">
            </div>

            <div class="mb-2">
                <label for="is_completed" class="form-label">Task Status</label>
                <select id="is_completed" name="is_completed" class="form-control">
                    <option value="0" <?php echo $todo['is_completed'] == 0 ? 'selected': ''; ?>>Incomplete</option>
                    <option value="1" <?php echo $todo['is_completed'] == 1 ? 'selected': ''; ?>>Complete</option>
                </select>
            </div>    
        </form>

        <div class="container mt-5 d-flex gap-2">
            <button type="submit" name="submit" class="btn btn-success">Save</button>
            <button type="button"
                    class="btn btn-info"
                    onclick="window.location.href='detail.php?id=<?php echo $todo['id']; ?>'">Detail Task
            </button>
            <button
                type="button"
                class="btn btn-light"
                onclick="window.location.href='homepage.php'">
                Exit
            </button>
        </div>
    </div>
</body>
</html>