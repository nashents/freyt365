<?php

namespace App\Http\Controllers;

use App\Models\FuelStation;
use App\Http\Requests\StoreFuelStationRequest;
use App\Http\Requests\UpdateFuelStationRequest;

class FuelStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fuel_stations.index');
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
    public function store(StoreFuelStationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelStation $fuelStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelStation $fuelStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelStationRequest $request, FuelStation $fuelStation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelStation $fuelStation)
    {
        //
    }
}
