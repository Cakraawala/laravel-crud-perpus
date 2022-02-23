<?php

namespace App\Http\Controllers;
use App\Models\Categorybook;
use App\Models\Databook;
use Illuminate\Http\Request;

class CategorybookController extends Controller
{
    public function index(){
        return  Categorybook::all();
    }
    public function store (){
        request()->validate([
            'nama_kategori' => 'required',
        ]);
        return Categorybook::create([
            'nama_kategori' => request('nama_kategori')
        ]);
    }

    public function update (Categorybook $id){
        request()->validate([
            'nama_kategori' => 'required'
        ]);

        $success = $id->update([
            'nama_kategori' => request('nama_kategori')
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(Categorybook $id){
        $success = $id->delete();

        return [
            'success' => $success
        ];
    }

}

