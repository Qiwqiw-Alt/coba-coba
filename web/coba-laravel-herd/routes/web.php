<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('transaction.index');
});

Route::resource('transaction', TransactionController::class);
Route::delete('/transaction-delete-all', [TransactionController::class, 'destroyAll'])->name('transaction.destroyAll');
