<?php
    require_once 'trx.php';

    $trxModel = new trx();

    $id = $_GET['id'];
    $trx= $trxModel->getById($id);

    if (!$trx) {
        die ("Transaction is not found!");
    }

    if (isset($_POST['submit'])) {
        if($trxModel->update($id, $_POST)) {
            header("Location: homepage.php?status=updated");
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
    <title>Edit Transaction</title>
</head>
<body>
    <div>
        <form action="" method="POST">
            <div>
                <label for="transaction_date">Date: </label>
                <input type="datetime-local" name="transaction_date" id="transaction_date" 
                value="<?php echo date('Y-m-d\TH:1', strtotime($trx['transaction_date'])); ?>" >
            </div>

            <div>
                <label for="amount">Amount: </label>
                <input type="number" name="amount" id="amount" value="<?php echo $trx['amount']; ?>">
            </div>

            <div>
                <label for="category">Category: </label>
                <select name="category" id="category">
                    <option value="education" <?php echo $trx['category'] == 'education' ? 'selected' : ''; ?>>Education</option>
                    <option value="gift" <?php echo $trx['category'] == 'gift' ? 'selected' : ''; ?>>Gift</option>
                    <option value="food" <?php echo $trx['category'] == 'food' ? 'selected' : ''; ?>>Food</option>
                    <option value="other" <?php echo $trx['category'] == 'other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>

            <div>
                <label for="type">Type: </label>
                <input type="radio" name="type" value="Income" id="income" <?php echo $trx['type'] == 'Income' ? 'checked' : ''; ?>>
                <label for="income">Income</label>
                <input type="radio" name="type" value="Outcome" id="outcome" <?php echo $trx['type'] == 'Outcome' ? 'checked' : ''; ?>>
                <label for="outcome">Outcome</label>
            </div>

            <div>
                <label for="asset">Asset: </label>
                <select name="asset" id="asset">
                    <option value="cash" <?php echo $trx['asset'] == 'cash' ? 'selected' : ''; ?>>Cash</option>
                    <option value="credit" <?php echo $trx['asset'] == 'credit' ? 'selected' : ''; ?>>Credit</option>
                    <option value="bank" <?php echo $trx['asset'] == 'bank' ? 'selected' : ''; ?>>Bank</option>
                </select>
            </div>

            <div>
                <label for="description">Description: </label>
                <textarea name="description" id="description" rows="3"><?php echo $trx['description']; ?></textarea>
            </div>

            <div>
                <button type="submit" name="submit">Save</button>
                <button type="button"
                        onclick="window.location.href='detail.php?id=<?php echo $trx['id']; ?>'">Detail Transaction
                </button>
                <button
                    type="button"
                    onclick="window.location.href='homepage.php'">Exit
                </button>
            </div>
        </form>
    </div>
</body>
</html>