<?php
    require_once 'trx.php';

    if (isset($_POST['submit'])) {
        $trxModel = new trx();

        if ($trxModel->create($_POST)) {
            header("Location: homepage.php?status=success");
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
    <title>Add Transaction</title>
</head>
<body>
    <div>
        <h1>Add New Transaction</h1>
    </div>

    <div>
        <form action="" method="POST">
            <div>
                <label for="transaction_date">Date: </label>
                <input type="datetime-local" name="transaction_date" id="transaction_date" required>
            </div>

            <div>
                <label for="amount">Amount: </label>
                <input type="number" name="amount" id="amount" required>
            </div>

            <div>
                <label for="category">Category: </label>
                <select name="category" id="category" required>
                    <option value="education">Education</option>
                    <option value="gift">Gift</option>
                    <option value="food">Food</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div>
                <label for="type">Type: </label>
                <input type="radio" name="type" value="Income" id="income" checked>
                <label for="income">Income</label>
                <input type="radio" name="type" value="Outcome" id="outcome">
                <label for="outcome">Outcome</label>
            </div>

            <div>
                <label for="asset">Asset: </label>
                <select name="asset" id="asset" required>
                    <option value="cash">Cash</option>
                    <option value="credit">Credit</option>
                    <option value="bank">Bank</option>
                </select>
            </div>

            <div>
                <label for="description">Description: </label>
                <textarea name="description" id="description" rows="3" required></textarea>
            </div>

            <div>
                <button type="submit" name="submit">Save</button>
                  <button
                    type="button"
                    onclick="window.location.href='homepage.php'">Exit
                </button>
            </div>
        </form>
    </div>
</body>
</html>