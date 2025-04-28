<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('companies.index');
    }
    public function getDrivers($id)
    {   
        $company = Company::find($id);
        return view('companies.drivers')->with('company',$company);
    }
    public function getTrailers($id)
    {
        $company = Company::find($id);
        return view('companies.trailers')->with('company',$company);
    }
    public function getHorses($id)
    {
        $company = Company::find($id);
        return view('companies.horses')->with('company',$company);
    }

    public function getProfile(Company $company){
        return view('companies.profile')->with('company', $company);
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
    public function store(StoreCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show')->with('company',$company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
