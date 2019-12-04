<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    public $table='materi';
    public $fillable=['file','keterangan'];
}
