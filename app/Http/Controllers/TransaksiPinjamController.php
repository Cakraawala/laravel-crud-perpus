<?php

namespace App\Http\Controllers;
use App\Models\TransaksiPinjam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiPinjamController extends Controller
{
    public function index(){
        return  TransaksiPinjam::all();
    }

    public function store (Request $request){
      $transaksi = $this->validate($request,[
            'user_id' => ['required'],
            'databook_id' => ['required'],
            'jumlah' => ['required', 'integer','max:255'],
            'tanggal_pinjam' => ['required', 'date_format:Y-m-d'],
            'tanggal_kembali' => ['required', 'date'],
            'admin_id' => ['required'],
            'status' => ['required'],
        ]);

        return TransaksiPinjam::create([
            'user_id' => request('user_id'),
            'databook_id' => request('databook_id'),
            'jumlah' => request('jumlah'),
            'tanggal_pinjam' => request('tanggal_pinjam'),
            'tanggal_kembali' => request('tanggal_kembali'),
            'admin_id' => request('admin_id'),
            'status' => request('status')
        ]);

        $transaksi['tanggal_pinjam'] = Carbon::now();
        $transaksi['tanggal_kembali']->addDays(7);
    }

   public function update (TransaksiPinjam $id){
        request()->validate([
            'user_id' => ['required'],
            'databook_id' => ['required'],
            'jumlah' => ['required', 'integer','max:255'],
            'tanggal_pinjam' => ['required'],
            'tanggal_kembali' => ['required', 'date'],
            'admin_id' => ['required'],
            'status' => ['required']
        ]);

        $success = $id->update([
            'user_id' => request('user_id'),
            'databook_id' => request('databook_id'),
            'jumlah' => request('jumlah'),
            'tanggal_pinjam' => request('tanggal_pinjam'),
            'tanggal_kembali' => request('tanggal_kembali'),
            'admin_id' => request('admin_id'),
            'status' => request('status')
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(TransaksiPinjam $id){
        $success = $id->delete();

        return [
            'success' => $success
        ];
    }

}
