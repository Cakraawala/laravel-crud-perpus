<?php

namespace App\Http\Controllers;
use App\Models\Categorybook;
use App\Models\Databook;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategorybookController extends Controller
{
    protected $frog;
    public function __construct(Categorybook $category)
    {
        $this->frog = $category;
    }


    public function index(){
        $category = $this->frog->get();
        return  response()->json(['List Data' => 'Category Book',
                                    'Data' => $category]);
    }


    public function store (Request $request){
        $request->validate([
            'nama_kategori' => 'required',
        ]);
        $this->frog->create($request->all());
        return $this->index();
    }


    public function update ($id, Request $request){
        try {
            $data = $this->frog->findOrFail($id);
            $data->update($request->all());
            return response()->json(['Message' => 'Data edited successfully', 'data' => $data]);
        }catch (ModelNotFoundException){
            return response()->json(['Error' => '404','Message' => 'Item not found or not created yet!']);
        }
    }

    public function destroy($id){
        try{
            $data = $this->frog->findOrFail($id);
            $data->delete();
            return response()->json([
                'Message' => 'Data Successfully deleted'
            ]);
        }catch (ModelNotFoundException) {
            return response()->json(['Error' => '404','Message' => 'Item not found or not created yet!']);
        }
    }

    public function show ($id){
            try{
                $data = $this->frog->findOrFail($id);
                return response(['List Data' => $data]);
            } catch (ModelNotFoundException) {
                return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
            }
        }


}

