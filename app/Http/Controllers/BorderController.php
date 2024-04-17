<?php

namespace App\Http\Controllers;

use App\Models\Border;
use App\Http\Requests\StoreBorderRequest;
use App\Http\Requests\UpdateBorderRequest;

class BorderController extends Controller
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
    public function store(StoreBorderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Border $border)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Border $border)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorderRequest $request, Border $border)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Border $border)
    {
        //
    }
}
