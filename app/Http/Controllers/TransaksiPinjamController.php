<?php

namespace App\Http\Controllers;
use App\Models\TransaksiPinjam;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class TransaksiPinjamController extends Controller
{
    protected $frog;

    public function __construct(TransaksiPinjam $pinjam)
    {
        $this->frog = $pinjam;
    }

    public function index(){
        $pinjam = $this->frog->with('databook', 'admin')->get();
        return response()->json(['List Data' => 'Transaction Pinjam', 'data'=>$pinjam]);
    }

    public function store (Request $request){
      $request->validate([
            'user_id' => ['required'],
            'databook_id' => ['required'],
            'jumlah' => ['required', 'integer','max:255'],
            'admin_id' => ['required'],
            'status' => ['required'],
        ]);

        $request['tanggal_pinjam'] = Carbon::now();
        $request['tanggal_kembali']= $request['tanggal_pinjam']->addDays(7);
        $this->frog->create($request->all());
        return $this->index();
    }

   public function update (Request $request, $id){
    try {
        $data = $this->frog->with( 'databook', 'admin')->findOrFail($id);
        $data->update($request->all());
        return response()->json(['Message' => 'Data edited successfully', 'data' => $data]);
    }catch (ModelNotFoundException){
        return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
    }
    }

    public function destroy($id){
        try{
            $data = $this->frog->with( 'databook', 'admin')->findOrFail($id);
            $data->delete();
            $data->databook()->detach();
            $data->admin()->detach();
            return response()->json([
                'Message' => 'Data Successfully deleted'
            ]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404','Message' => 'Item not found or not created yet!']);
        }
    }

    public function show($id){
        try{
            $data = $this->frog->with( 'databook', 'admin')->findOrFail($id);
            return response(['List Data' => $data]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }
}
