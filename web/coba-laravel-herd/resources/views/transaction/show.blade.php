<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaction</title>
</head>
<body>
    <div>
        <h1>Transaction: {{ $transaction->description ?? 'No Description' }}</h1>
    </div>

    <div>
        <h3>Date:</h3>
        <p>{{ $transaction->transaction_date->format('d M Y, H:i') }}</p>
    </div>

    <div>
        <h3>Amount:</h3>
        <p>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
    </div>

    <div>
        <h3>Category:</h3>
        <p>{{ $transaction->category }}</p>
    </div>

    <div>
        <h3>Type:</h3>
        <p>{{ $transaction->type }}</p>
    </div>

    <div>
        <h3>Asset:</h3>
        <p>{{ $transaction->asset }}</p>
    </div>


    <div style="margin-top: 20px;">
        <a href="{{ route('transaction.edit', $transaction->id) }}">
            <button type="button">Edit Transaction</button>
        </a>
        <a href="{{ route('transaction.index') }}">
            <button type="button">Exit</button>
        </a>
    </div>

    <hr style="margin-top: 30px;">


    <div>
        <div style="border: 1px solid red; padding: 15px; width: fit-content;">
            <h3 style="color: red; margin-top: 0;">Delete Confirmation</h3>
            <p>Are you sure you want to delete transaction: <strong>{{ $transaction->description ?? 'this item' }}</strong>?</p>
            
            <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit" style="color: white; background-color: red;">Yes, Delete</button>
                <a href="{{ route('transaction.index') }}">
                    <button type="button">Cancel</button>
                </a>
            </form>
        </div>
    </div>
</body>
</html>