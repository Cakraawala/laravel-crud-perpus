<?php

namespace App\Http\Controllers;
use App\Models\Databook;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class DatabookController extends Controller
{
    public function index(){
        return Databook::all();
    }
    public function store (){
        request()->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'penerbit_id' => 'required',
            'categorybook_id' => 'required',
            'jumlah' => 'required'
        ]);
        return Databook::create([
            'judul' => request('judul'),
            'pengarang' => request('pengarang'),
            'tahun_terbit' => request('tahun_terbit'),
            'penerbit_id' => request('penerbit_id'),
            'categorybook_id' => request('categorybook_id'),
            'jumlah' => request('jumlah')
        ]);
    }

    public function update (Databook $id){
        request()->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'penerbit_id' => 'required',
            'categorybook_id' => 'required',
            'jumlah' => 'required'
        ]);

        $success = $id->update([
            'judul' => request('judul'),
            'pengarang' => request('pengarang'),
            'tahun_terbit' => request('tahun_terbit'),
            'penerbit_id' => request('penerbit_id'),
            'categorybook_id' => request('categorybook_id'),
            'jumlah' => request('jumlah')
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(Databook $id){
        $success = $id->delete();

        return [
            'success' => $success
        ];
    }


    }
