<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error: </strong>
                <ul class="mb-0 mt-2 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold text-dark">Add New Transaction</h2>
                <p class="text-muted">Create your new financial records here.</p>
            </div>
        </div>

        <div class="card border-0 bg-light">
            <div class="card-body p-0">
                <form action="{{ route('transaction.store') }}" method="POST">
                    @csrf
                    <fieldset>
                        <legend>Form Add New Transaction</legend>
                    </fieldset>

                    <div class="mb-3">
                        <label for="transaction_date" class="form-label fw-semibold">Date: </label>
                        <input type="datetime-local"  class="form-control" name="transaction_date" id="transaction_date" value="{{ old('transaction_date')}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label fw-semibold">Amount: </label>
                        <input type="number" class="form-control" name="amount" id="amount" value="{{ old('amount')}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">Category: </label>
                        <select name="category" id="category" class="form-select" required>
                            <option value="education" {{ old('category') == 'education' ? 'selected' : ''}}>Education</option>
                            <option value="gift" {{ old('category') == 'gift' ? 'selected' : ''}}>Gift</option>
                            <option value="food" {{ old('category') == 'food' ? 'selected' : ''}}>Food</option>
                            <option value="other" {{ old('category') == 'other' ? 'selected' : ''}} >Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label fw-semibold">Type: </label>

                        <div class="d-flex gap-2">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="type" value="Income" id="income" {{ old('type', 'Income') == 'Income' ? 'checked' : ''}}>
                                <label for="income" class="form-check-label">Income</label>
                            </div>

                            <div>
                                <input type="radio" class="form-check-input" name="type" value="Outcome" id="outcome" {{ old('type', 'Outcome') == 'Outcome' ? 'checked' : ''}}>
                                <label for="outcome" class="form-check-label" >Outcome</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="asset" class="form-label fw-semibold">Asset: </label>
                        <select name="asset" id="asset" class="form-select" required>
                            <option value="cash" {{ old('asset') == 'cash' ? 'selected' : ''}} >Cash</option>
                            <option value="credit"  {{ old('asset') == 'credit' ? 'selected' : ''}} >Credit</option>
                            <option value="bank" {{ old('asset') == 'bank' ? 'selected' : ''}} >Bank</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description: </label>
                        <textarea name="description" id="description" class="form-control" rows="3" {{ old('description') }} required></textarea>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" name="submit" class="btn  btn-outline-success">Save</button>
                        <a href="{{ route ('transaction.index')}}" ><button type="button" class="btn btn-outline-secondary">Exit</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>