<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Finance Book</title>
</head>
<body>
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif
    
    <div>
        <h1>Transaction History</h1>
        <h4><a href="{{ route('transaction.create')}}">Add New Transaction</a></h4>
    </div>

    <div>
        <p><strong>Total Income:</strong> Rp {{number_format($totalIncome, 0, ',', '.')}}</p>
        <p><strong>Total Outcome:</strong> Rp {{number_format($totalOutcome, 0, ',', '.')}}</p>
    </div>

    @if($transactions->count() > 0)
        <div style="margin-bottom: 20px;">
            <form action="{{ route('transaction.destroyAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete All transactions?')">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red;">Delete All Transactions</button>
            </form>
        </div>
    @endif

    <hr>

    <div>
        @forelse($transactions as $index => $trx)
            <h2>
                {{ $loop->iteration }}. {{ $trx->description ?? 'No Description' }}
                <span style="font-size: 14px; color: gray;">
                    ({{ $trx->type }}) - {{ $trx->transaction_date->format('d M Y, H:i') }}
                </span>
            </h2> 

            <h4>Amount: Rp {{ number_format($trx->amount, 0, ',', '.') }}</h4>
            <p>Category: {{ $trx->category }} | Asset: {{ $trx->asset }}</p>

            <a href="{{ route('transaction.show', $trx->id) }}">Transaction Detail &raquo;</a> | 
            <a href="{{ route('transaction.edit', $trx->id) }}">Edit</a> |

            <form action="{{ route('transaction.destroy', $trx->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this transaction?')">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>

            <br><br>
            <hr style="border-top: 1px dashed #ccc;">

        @empty
            <p>You don't have any transaction log</p>
        @endforelse
    </div>

</body>
</html>