<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('admin.registrasi');
    }

    public function store(Request $request)     
    {
        $validasiData = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        $validasiData['password'] = Hash::make($request->password);

        User::create([
            'nama' => $validasiData['nama'],
            'email' => $validasiData['email'],
            'password' => $validasiData['password']
        ]);
        
        return redirect('/login')->with('success', 'Berhasil Registrasi');
    }
}