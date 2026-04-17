<?php

namespace App\Http\Controllers;

use App\Http\Requests\transaction\TransactionRequest;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Auth::user()->transactions;
        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $transaction = $user->transactions()->create($request->safe()->except("categories"));
        $transaction->categories()->attach($request->input('categories', []));
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);
        return view('transactions.show', [
            'transaction' => $transaction,
            'categories' => $transaction->categories()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        $transaction->update($request->safe()->except("categories"));
        $transaction->categories()->sync($request->input('categories', []));
        return redirect()->route('transactions.index')->with('success', 'Transacción actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transacción eliminada exitosamente.');
    }
}
