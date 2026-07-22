<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction Transaction</title>
</head>
<body>
    <div>
        <h1>Edit Transaction</h1>
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
        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="transaction_date">Date: </label>
                <input 
                    type="datetime-local" 
                    name="transaction_date" 
                    id="transaction_date" 
                    value="{{ old('transaction_date', $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d\TH:i') : '') }}"
                    required>
            </div>

            <div>
                <label for="amount">Amount: </label>
                <input type="number" 
                        name="amount"   
                        id="amount" 
                        value="{{ old('amount', $transaction->amount) }}"
                        required>
            </div>

            <div>
                <label for="category">Category: </label>
                <select name="category" id="category" required>
                    @php $cat = old('category', $transaction->category); @endphp
                    <option value="education" {{ $cat == 'education' ? 'selected' : ''}}>Education</option>
                    <option value="gift" {{ $cat  == 'gift' ? 'selected' : ''}}>Gift</option>
                    <option value="food" {{ $cat == 'food' ? 'selected' : ''}}>Food</option>
                    <option value="other" {{ $cat == 'other' ? 'selected' : ''}} >Other</option>
                </select>
            </div>

            <div>
                <label for="type">Type: </label>
                @php $type = old('type', $transaction->type); @endphp
                <input type="radio" name="type" value="Income" id="income" {{ $type == 'Income' ? 'checked' : ''}}>
                <label for="income">Income</label>
                <input type="radio" name="type" value="Outcome" id="outcome" {{ $type == 'Outcome' ? 'checked' : ''}}>
                <label for="outcome">Outcome</label>
            </div>

            <div>
                <label for="asset">Asset: </label>
                <select name="asset" id="asset" required>
                    @php $asset = old('asset', $transaction->asset); @endphp
                    <option value="cash" {{ $asset == 'cash' ? 'selected' : ''}} >Cash</option>
                    <option value="credit"  {{ $asset  == 'credit' ? 'selected' : ''}} >Credit</option>
                    <option value="bank" {{ $asset == 'bank' ? 'selected' : ''}} >Bank</option>
                </select>
            </div>

            <div>
                <label for="description">Description: </label>
                <textarea name="description" id="description" rows="3" required>{{ old('description', $transaction->description) }}</textarea>
            </div>

            <div>
                <button type="submit" name="submit">Save</button>
                <a href="{{ route ('transaction.show', $transaction->id)}}"><button type="button">Detail Task</button></a>
                <a href="{{ route ('transaction.index')}}"><button type="button">Exit</button></a>
            </div>
        </form>
    </div>
</body>
</html>