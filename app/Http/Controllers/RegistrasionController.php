<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegistrasionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Pages.register');
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
        $request->validate([
            'nama_kader' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama_kader' => $request->input('nama_kader'),
            'jabatan' => $request->input('jabatan'),
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
