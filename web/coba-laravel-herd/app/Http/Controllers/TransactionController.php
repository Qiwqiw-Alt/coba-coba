<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->get();

        $totalIncome = $this->getTotalIncome();
        $totalOutcome = $this->getTotaOutcome();

        return view('transaction.index', compact('transactions', 'totalIncome', 'totalOutcome'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'type' => 'required|in:Income,Outcome',
            'asset' => 'required|string',
            'description' => 'required|string',
        ]);

        Transaction::create($validated);

        return redirect()->route('transaction.index')->with('success', 'Transaction succesfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'type' => 'required|in:Income,Outcome',
            'asset' => 'required|string',
            'description' => 'required|string',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($validated);

        return redirect()->route('transaction.index')->with('success', 'Transaction sucessfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transaction.index')->with('success', 'Transaction sucessfully deleted');
    }

    public function destroyAll()
    {
        Transaction::query()->delete();

        return redirect()->route('transaction.index')->with('success', 'All Transactions sucessfully deleted');
    }

    public function getTotalIncome()
    {
        return Transaction::where('type', 'Income')->sum('amount');
    }

    public function getTotaOutcome()
    {
        return Transaction::where('type', 'Outcome')->sum('amount');
    }
}
