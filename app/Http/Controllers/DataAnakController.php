<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use Illuminate\Http\Request;

class DataAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataanak = DataAnak::all();

        return view('Admin.Pages.DataAnak.index', compact('dataanak'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataAnak $dataAnak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataAnak $dataAnak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAnak $dataAnak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAnak $dataAnak)
    {
        //
    }
}
