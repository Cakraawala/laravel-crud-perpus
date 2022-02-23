<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPinjam extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pinjam';
    protected $guarded = ['id'];
}
