<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primaryKey = "nama";
    //

    public $incrementing = false;

    public function kantor(){
        return $this->hasMany('App\Kantor', 'kota', 'nama');
    }

    public static function cek($nama){
        $kota = kota::All();
        $boleh = true;
        foreach ($kota as $city){
            if($city['nama'] == $nama){
                $boleh = false;
            }
        }
        return $boleh;
    }

    public static function getAll(){
        return Kota::where('is_deleted',0);
    }

    public static function count(){
        return Kota::getAll()->count();
    }
}
