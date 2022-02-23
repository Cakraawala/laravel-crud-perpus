<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databook extends Model
{
    use HasFactory;
    protected $table = 'databook';
    protected $guarded = ['id'];

    public function penerbit(){
            return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

    public function categorybook(){
        return $this->belongsTo(Categorybook::class, 'categorybook_id');
    }
}
