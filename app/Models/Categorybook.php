<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorybook extends Model
{
    use HasFactory;
    protected $table = 'categorybook';
    protected $guarded = ['id'];
    public function databook(){
        return $this->hasMany(Databook::class);
    }
}
