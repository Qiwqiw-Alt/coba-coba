<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Finance Book</title>
</head>
<body>
    <div>
        <h1>Transaction History</h1>
        <h4><a href="add.php">Add New Transaction</a></h4>
    </div>

    <div>
        <?php
        require_once 'trx.php';


        $trxModel = new trx();
        $result = $trxModel->getAll();

        $no = 1;

        if($result && $result->num_rows >0) {
            while($trx = $result->fetch_assoc()) {
                ?>
                <h2><?php echo $no; ?>. <?php echo $trx['description']; ?></h2> 
                    <h4>Amount: <?php echo $trx['amount']; ?></h4>
                    <a href="detail.php?id=<?php echo $trx['id']; ?>">
                        Task Detail &raquo;
                    </a>
                    <br><br>

                <?php
                $no++;
            }
        } else {
            echo "<p> You dont have any transaction log </p>";
        }
        ?>
    </div>

</body>
</html>