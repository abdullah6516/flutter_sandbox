<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TransactionResource::collection(transaction::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        //return new TransactionResource(Transaction::create($request->validated()));
        $transaction = auth()->user()->transactions()->create($request->validated());

        return new TransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTransactionRequest $request, transaction $transaction)
    {
        $transaction->update($request->validated());
        return new TransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        $transaction->delete();

        return response()->noContent();
    }
}