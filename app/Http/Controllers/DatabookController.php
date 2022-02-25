<?php

namespace App\Http\Controllers;
use App\Models\Databook;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DatabookController extends Controller
{

    protected $frog;

    public function __construct(databook $databook)
    {
        $this->frog = $databook;
    }

    public function index(){
        $databook = $this->frog->with('categorybook', 'penerbit')->get();
        return response()->json(['List Data' => 'Databook', 'Data' => $databook]);
    }


    public function store (Request $request){
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'penerbit_id' => 'required',
            'categorybook_id' => 'required',
            'jumlah' => 'required'
        ]);
        $this->frog->create($request->all());
        return $this->index();
    }

    public function update (Request $request, $id){
        try {
            $data = $this->frog->with('categorybook', 'penerbit')->findOrFail($id);
            $data->update($request->all());
            return response()->json(['Message' => 'Data edited successfully', 'data' => $data]);
        }catch (ModelNotFoundException){
            return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }

    public function show($id){
        try{
            $data = $this->frog->with('categorybook','penerbit')->findOrFail($id);
            return response(['List Data' => $data]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }

    public function destroy($id){
        try {
            $data = $this->frog->with('categorybook','penerbit')->findOrFail($id);
            $data->category()->detach();
            $data->penerbit()->detach();
            $data->delete();
            return $this->index();
        }catch (ModelNotFoundException){
            return response(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }
}
