<?php
    require_once 'trx.php';

    $trxModel = new trx();

    $id = $_GET['id'];
    $trx = $trxModel->getById($id);

    if (!$trx) {
        die ("task is not found");
    }

    if(isset($_POST['delete'])) {
        if($trxModel->delete($id)) {
            header("Location: homepage.php?status=deleted");
            exit;
        } else {
            echo "Error: ". $trxModel->getError();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaction</title>
</head>
<body>
    <div>
        <h1>Transaction: <?php echo $trx['description']; ?></h1>
    </div>

    <div>
        <h1>Date: </h1>
        <h4><?php echo $trx['transaction_date']; ?></h4>
    </div>

    <div>
        <h1>Amount: </h1>
        <h4><?php echo $trx['amount']; ?></h4>
    </div>

    <div>
        <h1>Category: </h1>
        <h4><?php echo $trx['category']; ?></h4>
    </div>

    <div>
        <h1>Type: </h1>
        <h4><?php echo $trx['type']; ?></h4>
    </div>

    <div>
        <h1>Asset:</h1>
        <h4><?php echo $trx['asset']; ?></h4>
    </div>

    <div>
        <button type="button" onclick="window.location.href='edit.php?id=<?php echo $trx['id']; ?>'">Edit Transaction</button>
        <button type="button" onclick="window.location.href='homepage.php'">Exit</button>
    </div>

    <hr>

    <div>
        <div>
            <h3>Delete Confirmation</h3>
            <p>Are you sure to delete task <?php echo $trx['task']; ?></p>
            <form action="" method="POST">
                <button type="submit" name="delete">Yes</button>
                <button type="button" name="cancel-delete"> Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>