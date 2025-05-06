<?php

namespace App\Http\Controllers;

use App\Models\HorseMake;
use App\Http\Requests\StoreHorseMakeRequest;
use App\Http\Requests\UpdateHorseMakeRequest;

class HorseMakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('horse_makes.index');
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
    public function store(StoreHorseMakeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HorseMake $horseMake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HorseMake $horseMake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHorseMakeRequest $request, HorseMake $horseMake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HorseMake $horseMake)
    {
        //
    }
}
