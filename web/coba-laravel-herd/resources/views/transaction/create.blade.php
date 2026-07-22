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

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf

            <div>
                <label for="transaction_date">Date: </label>
                <input type="datetime-local" name="transaction_date" id="transaction_date" value="{{ old('transaction_date')}}" required>
            </div>

            <div>
                <label for="amount">Amount: </label>
                <input type="number" name="amount" id="amount" value="{{ old('amount')}}" required>
            </div>

            <div>
                <label for="category">Category: </label>
                <select name="category" id="category" required>
                    <option value="education" {{ old('category') == 'education' ? 'selected' : ''}}>Education</option>
                    <option value="gift" {{ old('category') == 'gift' ? 'selected' : ''}}>Gift</option>
                    <option value="food" {{ old('category') == 'food' ? 'selected' : ''}}>Food</option>
                    <option value="other" {{ old('category') == 'other' ? 'selected' : ''}} >Other</option>
                </select>
            </div>

            <div>
                <label for="type">Type: </label>
                <input type="radio" name="type" value="Income" id="income" {{ old('type', 'Income') == 'Income' ? 'checked' : ''}}>
                <label for="income">Income</label>
                <input type="radio" name="type" value="Outcome" id="outcome" {{ old('type', 'Outcome') == 'Outcome' ? 'checked' : ''}}>
                <label for="outcome">Outcome</label>
            </div>

            <div>
                <label for="asset">Asset: </label>
                <select name="asset" id="asset" required>
                    <option value="cash" {{ old('asset') == 'cash' ? 'selected' : ''}} >Cash</option>
                    <option value="credit"  {{ old('asset') == 'credit' ? 'selected' : ''}} >Credit</option>
                    <option value="bank" {{ old('asset') == 'bank' ? 'selected' : ''}} >Bank</option>
                </select>
            </div>

            <div>
                <label for="description">Description: </label>
                <textarea name="description" id="description" rows="3" {{ old('description') }} required></textarea>
            </div>

            <div>
                <button type="submit" name="submit">Save</button>
                <a href="{{ route ('transaction.index')}}"><button type="button">Exit</button></a>
            </div>
        </form>
    </div>
</body>
</html>