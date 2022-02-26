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
        $pinjam = $this->frog->with('databook',
        'user')->get();
        return response()->json(['List Data' =>
         'Transaction Pinjam', 'Data'=>$pinjam]);
    }

    public function store (Request $request){
      $request->validate([
            'user_id' => ['required'],
            'databook_id' => ['required'],
            'jumlah' => ['required', 'integer','max:255'],
            'status' => ['required'],
        ]);
        $jamal = $request['tanggal_pinjam'] = Carbon::now();
        $request['tanggal_pinjam'] = Carbon::now();
        $request['tanggal_kembali']= $jamal->addDays(7);
        $this->frog->create($request->all());
        return $this->index();
    }

   public function update (Request $request, $id){
    try {
        $data = $this->frog->with( 'databook',
        'user','admin')->findOrFail($id);
        $data->update($request->all());
        return response()->json(['Message' =>
        'Data edited successfully', 'data' => $data]);
    }catch (ModelNotFoundException){
        return response()->json(['Error' =>
         '404', 'Message' => 'Item not found or not created yet!']);
    }
    }

    public function destroy($id){
        try{
            $data = $this->frog->with( 'databook',
             'user','admin')->findOrFail($id);
            $data->delete();
            $data->databook()->detach();
            $data->admin()->detach();
            $data->user()->detach();
            return response()->json([
                'Message' => 'Data Successfully deleted'
            ]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404',
            'Message' => 'Item not found or not created yet!']);
        }
    }

    public function show($id){
        try{
            $data = $this->frog->with( 'databook',
             'user','admin')->findOrFail($id);
            return response(['List Data' => $data]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404',
            'Message' => 'Item not found or not created yet!']);
        }
    }
}
