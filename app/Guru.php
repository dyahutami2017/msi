<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama', 'alamat', 'avatar', 'user_id'];
    
    public function user(){
        return $this->hasOne(User::class,'user_id')->withTimestamps();;
    }
}
