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
                                            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $trx->id }}">Detail</button>
                                            <a href="{{ route('transaction.edit', $trx->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $trx->id }}">
                                                Delete
                                            </button>
                                        </div>

                                        <div class="modal fade" id="detailModal{{ $trx->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $trx->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0">

                                                    <div class="modal-header bg-white border-bottom-0 pb-0">
                                                        <h5 class="modal-title fw-bold text-dark" id="detailModalLabel{{ $trx->id }}">Transaction Detail</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body p-4">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <h4 class="fw-bold mb-0 text-dark">{{ $trx->description ?? 'No Description' }}</h4>
                                                            <span class="badge {{ $trx->type == 'Income' ? 'bg-success' : 'bg-danger'}}">
                                                                {{ $trx->type}}
                                                            </span>
                                                        </div>

                                                        <div class="p-3 bg-light rounded-3 mb-3">
                                                            <small class="text-muted d-block mb-1">Amount</small>
                                                            <h3 class="fw-bold {{ $trx->type == 'Income' ? 'text-success' : 'text-danger'}} mb-0">
                                                                {{ $trx->type == 'Income' ? '+' : '-'}} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                                            </h3>
                                                        </div>

                                                        <div class="row g-3">
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Transaction Date</small>
                                                                <span class="fw-semibold text-dark">{{ $trx->transaction_date}}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Category</small>
                                                                <span class="badge bg-secondary text-capitalize">{{ $trx->category }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Asset</small>
                                                                <span class="fw-semibold text-capitalize text-dark">{{ $trx->asset }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Transaction Id</small>
                                                                <span class="fw-semibold text-muted">#{{ $trx->id }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer bg-light border-top-0">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="{{ route('transaction.edit', $trx->id)}}" class="btn btn-outline-warning text-white">Edit</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="modal fade" id="deleteModal{{ $trx->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $trx->id}}">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start py-4">
                                                        Are you sure you want to delete transaction <strong>"{{ $trx->description ?? 'this item' }}"</strong>?
                                                        <p class="text-muted small mb-0 mt-2">This action cannot be undone.</p>
                                                    </div>
                                                    <div class="modal-footer bg-light gap-2">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        
                                                        <form action="{{ route('transaction.destroy', $trx->id) }}" method="POST" class="m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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