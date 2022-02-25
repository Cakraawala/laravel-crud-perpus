<?php

namespace App\Http\Controllers;
use App\Models\Penerbit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    protected $frog;
    public function __construct(penerbit $penerbit)
    {
        $this->frog = $penerbit;
    }

    public function index(){
       $penerbit = $this->frog->get();
       return response()->json(['List Data' => 'Penerbit', 'Data' => $penerbit]);
    }

    public function store (Request $request){
        $request->validate([
            'nama_penerbit' => 'required',
            'alamat' => 'required',
            'email' => 'required'
        ]);
       $this->frog->create($request->all());
       return $this->index();
    }

    public function update (Request $request, $id){
       try {
           $data = $this->frog->findOrFail($id);
           $data->update($request->all());
           return response()->json(['Message' => 'Data edited successfully', 'data' => $data]);
        }catch (ModelNotFoundException){
            return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }

    public function destroy($id){
        try {
            $data = $this->frog->findOrFail($id);
            $data->delete();
            return $this->index();
        }catch (ModelNotFoundException){
            return response(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }
    public function show($id){
        try{
            $data = $this->frog->findOrFail($id);
            return response(['List Data' => $data]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }
}
