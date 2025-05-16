<?php

namespace App\Http\Controllers;

use App\Models\Overdraft;
use App\Http\Requests\StoreOverdraftRequest;
use App\Http\Requests\UpdateOverdraftRequest;

class OverdraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          return view('overdrafts.index');
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
    public function store(StoreOverdraftRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Overdraft $overdraft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Overdraft $overdraft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOverdraftRequest $request, Overdraft $overdraft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Overdraft $overdraft)
    {
        //
    }
}
