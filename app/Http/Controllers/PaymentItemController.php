<?php

namespace App\Http\Controllers;

use App\Models\PaymentItem;
use App\Http\Requests\StorePaymentItemRequest;
use App\Http\Requests\UpdatePaymentItemRequest;

class PaymentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentItemRequest $request, PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentItem $paymentItem)
    {
        //
    }
}
