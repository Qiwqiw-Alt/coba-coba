<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Finance Book</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
</head>
<body class="bg-light">
    

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Finance Book</span>
            <a href="{{ route('transaction.create') }}" class="btn btn-light font-weight-semibold"> Add Transaction</a>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h2 class=fw-bold text-secondary>Transaction History</h2>
                <p class="text-muted">Manage all your financial records here.</p>
            </div>

            <div class="col-md-4">
                <div class="card border-1  bg-white">
                    <div class="card-body p-3">
                        <small class="text-dark">Total Income</small>
                        <h4 class="mb-0 fw-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }} </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                 <div class="card border-1 bg-white">
                    <div class="card-body p-3">
                        <small class="text-dark ">Total Outcome</small>
                        <h4 class="mb-0 fw-bold">Rp {{ number_format($totalOutcome, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

         @if($transactions->count() > 0)
            <div class="d-flex justify-content-end mb-5">
                <form action="{{ route('transaction.destroyAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete All transactions?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete All Transactions</button>
                </form>
            </div>
        @endif

        <div class="card border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 border-1">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th class="pe-3 ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $index => $trx)
                                <tr>
                                    <td class="ps-3 fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <small>{{ $trx->transaction_date->format('d M Y') }}</small>
                                        <small>{{ $trx->transaction_date->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <span>Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $trx->type == 'Income' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $trx->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-capitalize">{{$trx->category}}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('transaction.show', $trx->id) }}" class="btn btn-sm btn-outline-info text-white">Detail</a>
                                            <a href="{{ route('transaction.edit', $trx->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                            <form action="{{ route('transaction.destroy', $trx->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                        
                                    </td>

                                </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <h5>You don't have any transaction log</h5>
                                    <p>Click Add Transaction to create first log</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>