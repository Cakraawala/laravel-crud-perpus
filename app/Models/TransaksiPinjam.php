<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPinjam extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pinjam';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function databook(){
        return $this->belongsTo(Databook::class, 'databook_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
