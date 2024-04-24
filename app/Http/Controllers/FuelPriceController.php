<?php

namespace App\Http\Controllers;

use App\Models\FuelPrice;
use App\Http\Requests\StoreFuelPriceRequest;
use App\Http\Requests\UpdateFuelPriceRequest;

class FuelPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fuel_prices.index');
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
    public function store(StoreFuelPriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelPrice $fuelPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelPrice $fuelPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelPriceRequest $request, FuelPrice $fuelPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelPrice $fuelPrice)
    {
        //
    }
}
