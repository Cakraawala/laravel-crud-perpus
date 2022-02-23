<?php

namespace App\Http\Controllers;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index(){
        return  Penerbit::all();
    }
    public function store (){
        request()->validate([
            'nama_penerbit' => 'required',
            'alamat' => 'required',
            'email' => 'required'
        ]);
        return Penerbit::create([
            'nama_penerbit' => request('nama_penerbit'),
            'alamat' => request('alamat'),
            'email' => request('email')
        ]);
    }

    public function update (Penerbit $id){
        request()->validate([
            'nama_penerbit' => 'required',
            'alamat' => 'required',
            'email' => 'required'
        ]);

        $success = $id->update([
            'nama_penerbit' => request('nama_penerbit'),
            'alamat' => request('alamat'),
            'email' => request('email')
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(Penerbit $id){
        $success = $id->delete();

        return [
            'success' => $success
        ];
    }
}
