<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction Transaction</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Finance Book</span>
        </div>
    </nav>

    <div class="container mb-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dissmible fade show mb-4" role="alert">
                <strong>Error: </strong>
                <ul class="mb-0 mt-2 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold text-dark">Edit Transaction</h2>
                <p class="text-muted">Edit your financial record here</p>
            </div>
        </div>

        <div class="card border-0 bg-light">
            <div class="card-body p-0">
                <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <legend>Form Edit Transaction</legend>
                    </fieldset>

                    <div class="mb-3">
                        <label for="transaction_date" class="form-label fw-semibold">Date: </label>
                        <input 
                            type="datetime-local" 
                            name="transaction_date" 
                            id="transaction_date" 
                            value="{{ old('transaction_date', $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d\TH:i') : '') }}"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label fw-semibold">Amount: </label>
                        <input type="text" 
                                name="amount"   
                                id="amount" 
                                value="{{ old('amount', number_format($transaction->amount, 0, ',', '.')) }}"
                                class="form-control"
                                required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">Category: </label>
                        <select name="category" id="category" class="form-select" required>
                            @php $cat = old('category', $transaction->category); @endphp
                            <option value="education" {{ $cat == 'education' ? 'selected' : ''}}>Education</option>
                            <option value="gift" {{ $cat  == 'gift' ? 'selected' : ''}}>Gift</option>
                            <option value="food" {{ $cat == 'food' ? 'selected' : ''}}>Food</option>
                            <option value="other" {{ $cat == 'other' ? 'selected' : ''}} >Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label fw-semibold">Type: </label>
                        @php $type = old('type', $transaction->type); @endphp
                        
                        <div class="d-flex gap-2">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="type" value="Income" id="income" {{ $type == 'Income' ? 'checked' : ''}}>
                                <label for="income" class="form-check-label">Income</label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="type" value="Outcome" id="outcome" {{ $type == 'Outcome' ? 'checked' : ''}}>
                                <label for="outcome" class="form-check-label">Outcome</label>
                            </div>
                        </div>
                        
                    </div>

                    <div class="mb-3">
                        <label for="asset" class="form-label fw-semibold">Asset: </label>
                        <select name="asset" id="asset" class="form-select" required>
                            @php $asset = old('asset', $transaction->asset); @endphp
                            <option value="cash" {{ $asset == 'cash' ? 'selected' : ''}} >Cash</option>
                            <option value="credit"  {{ $asset  == 'credit' ? 'selected' : ''}} >Credit</option>
                            <option value="bank" {{ $asset == 'bank' ? 'selected' : ''}} >Bank</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description: </label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $transaction->description) }}</textarea>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" name="submit" class="btn btn-outline-success">Save</button>
                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $transaction->id }}">Detail</button>
                        <a href="{{ route ('transaction.index')}}"><button type="button" class="btn btn-outline-dark">Exit</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $transaction->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">

                <div class="modal-header bg-white border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="detailModalLabel{{ $transaction->id }}">Transaction Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h4 class="fw-bold mb-0 text-dark">{{ $transaction->description ?? 'No Description' }}</h4>
                        <span class="badge {{ $transaction->type == 'Income' ? 'bg-success' : 'bg-danger'}}">
                            {{ $transaction->type}}
                        </span>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-3">
                        <small class="text-muted d-block mb-1">Amount</small>
                        <h3 class="fw-bold {{ $transaction->type == 'Income' ? 'text-success' : 'text-danger'}} mb-0">
                            {{ $transaction->type == 'Income' ? '+' : '-'}} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <small class="text-muted d-block">Transaction Date</small>
                            <span class="fw-semibold text-dark">{{ $transaction->transaction_date}}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Category</small>
                            <span class="badge bg-secondary text-capitalize">{{ $transaction->category }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Asset</small>
                            <span class="fw-semibold text-capitalize text-dark">{{ $transaction->asset }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Transaction Id</small>
                            <span class="fw-semibold text-muted">#{{ $transaction->id }}</span>
                        </div>
                    </div>

                    <div class="modal-footer bg-light border-top-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('transaction.edit', $transaction->id)}}" class="btn btn-outline-warning text-white">Edit</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>