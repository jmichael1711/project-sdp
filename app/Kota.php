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
        //1. nama yg dituju
        //2. foreign key
        //3. primary key model ini
        return $this->hasMany('App\Kantor', 'kota', 'nama')->where('is_deleted',0);
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

    public static function getAll2($nama){
        return Kota::where('nama','<>',$nama);
    }

    public static function count(){
        return Kota::getAll()->count();
    }

    public static function cekedit($nama){
        $kota = kota::getAll2($nama);
        $boleh = true;
        foreach ($kota as $city){
            if($city['nama'] == $nama){
                $boleh = false;
            }
        }
        return $boleh;
    }


}
