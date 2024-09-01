<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShelterRequest;
use App\Http\Requests\UpdateShelterRequest;
use App\Models\Shelter;

class ShelterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShelterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shelter $shelter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShelterRequest $request, Shelter $shelter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shelter $shelter)
    {
        //
    }
}
