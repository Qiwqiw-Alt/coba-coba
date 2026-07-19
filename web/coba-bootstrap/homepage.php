<?php
    require_once 'todo.php';

    $todoModel = new todo();

    if(isset($_POST['delete'])) {
        $id = (int)$_POST['id'];
        if($todoModel->delete($id)) {
            header("Location: homepage.php?status=deleted");
            exit;
        } else {
            echo "Error: ". $todoModel->getError();
        }
    }

    if (isset($_POST['delete-all'])) {
        if ($todoModel->deleteAll()) {
            header("Location: homepage.php?status=deleted-all");
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
    <title>Your Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container bg-dark">
    <div class="">
         <div class="container bg-dark mt-5 text-white p-5 text-center d-flex flex-column">
            <h1 class="display-1"><strong>Task List</strong></h1>
            <h4><a href="add.php" style="text-decoration: none; color: white">Add New Task</a></h4>
        </div>

        <div class="container p-5 border border-white border-3 rounded-4 d-flex flex-column gap-4">
            <?php
            require_once 'todo.php';


            $todoModel = new todo();
            $result = $todoModel->getAll();

            $no = 1;

            if($result && $result->num_rows >0) {
                while($todo = $result->fetch_assoc()) {
                    ?>
                        <div class="card rounded-4">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $no; ?>. <?php echo $todo['task']; ?></h2> 
                                <h4 class="card-text">Status: <?php echo $todo['is_completed'] == 1 ? 'complete': 'incomplete'; ?></h4>
                                <div class="d-flex gap-1 justify-content-end">
                                    <button class="btn btn-dark"><a href="detail.php?id=<?php echo $todo['id']; ?>" style="text-decoration: none; color: white;" >Task Detail</a></button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $todo['id']; ?>">
                                        Delete Task
                                    </button>
                                </div>
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
                    <?php
                    
                    $no++;
                }
            } else {
                echo "<h3 class='card-title text-center' style='color: white;'> You dont have any task left </h3>";
            }
            ?>
        </div>

        <div class="text-center mt-5">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllModal">
                    Delete All Task
            </button>
        </div>

        <div class="modal fade" id="deleteAllModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark text-start">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete All Task Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to delete all task?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="" method="POST">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="delete-all" class="btn btn-danger">Yes, Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>