<?php
    require_once 'todo.php';

    $todoModel = new todo();

    $id = $_GET['id'];
    $todo = $todoModel->getById($id);

    if (!$todo) {
        die ("task is not found");
    }

    if(isset($_POST['delete'])) {
        if($todoModel->delete($id)) {
            header("Location: homepage.php?status=deleted");
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
    <title>Detail Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container bg-dark">
    <div class="">
        <div class="container bg-dark mt-5 text-white p-5 text-center ">
            <h1>Task: <?php echo $todo['task']; ?></h1>
        </div>
    
        <div class="container text-white p-5 border border-white border-3 rounded-4">
            <div class="d-flex flex-column gap-2">
                <h2>Description</h1>
                <p class=""><?php echo $todo['description']; ?></p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="fs-6">Task Status:</span>
                <?php if ($todo['is_completed'] == 1): ?>
                    <span class="badge bg-success bg-opacity-75 text-white px-3 py-2 rounded-pill fs-6 border border-success">
                        ✓ Complete
                    </span>
                <?php else: ?>
                    <span class="badge bg-secondary bg-opacity-50 text-white px-3 py-2 rounded-pill fs-6 border border-light border-opacity-25">
                        ○ Incomplete
                    </span>
                <?php endif; ?>
            </div>

        </div>

        <div class="container mt-5 d-flex gap-2">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='edit.php?id=<?php echo $todo['id']; ?>'">Edit Task</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $todo['id']; ?>">
                 Delete Task
            </button>
            <button type="button" class="btn btn-light" onclick="window.location.href='homepage.php'">Exit</button>
        </div>

    </div>

    
     <div class="modal fade" id="deleteModal<?php echo $todo['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark text-start">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete task <strong><?php echo $todo['task']; ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

