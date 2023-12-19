<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use App\Models\DataOrangtua;
use Illuminate\Http\Request;

class DataAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataanak = DataAnak::orderBy('created_at', 'asc')->get();
        $dataorangtuas = DataOrangtua::all();

        return view('Admin.Pages.DataAnak.index', compact('dataanak', 'dataorangtuas'));
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
        $validatedData = $request->validate([
            'nik_anak' => 'required',
            'nama_anak' => 'required',
            'umur' => 'required',
            'berat_badan' => 'nullable',
            'tinggi_badan' => 'nullable',
            'bmi' => 'nullable',
            'IdOrangtua' => 'required',
        ]);

        DataAnak::create($validatedData);

        return redirect('/data-anak')->with('success', 'Data Anak berhasil ditambahkan!');
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
    public function edit($id)
    {
        $dataanak = DataAnak::find($id);

        $dataorangtuas = DataOrangtua::all();

        return view('Admin.Pages.DataAnak.edit', compact('dataanak', 'dataorangtuas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik_anak' => 'required',
            'nama_anak' => 'required',
            'umur' => 'required',
            'berat_badan' => 'nullable',
            'tinggi_badan' => 'nullable',
            'bmi' => 'nullable',
            'IdOrangtua' => 'required',
        ]);

        $dataanak = DataAnak::findOrFail($id);
        $dataanak->update($validatedData);

        return redirect('/data-anak')->with('success', 'Data Anak berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataanak = DataAnak::findOrFail($id);
        $dataanak->delete();

        return redirect('/data-anak')->with('success', 'Data Anak berhasil dihapus!');
    }
}
