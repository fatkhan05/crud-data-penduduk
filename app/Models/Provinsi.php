<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';
    protected $primaryKey = 'id';
    protected  $guarded = ['id'];

    public function kabupaten(){
        return  $this->hasMany(Kabupaten::class, 'provinsi_id', 'id');
    }
}
