<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kantor;

class Kendaraan extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 8
    //2 character of KE
    //6 digit of id integer
    //KE000001
    public $incrementing = false;

    public function bon_muats() {
        return $this->hasMany('App\Bon_muat');
    }

    public function kantor_1() {
        return $this->belongsTo('App\Kantor', 'kantor_1_id');
    }

    public function kantor_2() {
        return $this->belongsTo('App\Kantor', 'kantor_2_id');
    }

    //static functions for query
    public static function getAll() {
        return Kendaraan::where("is_deleted", 0);
    }

    public static function count() {
        return Kendaraan::getAll()->count();
    }

    public static function sortKendaraan($kantorAsalId,$kantorTujuanId){
        return Kendaraan::getAll()
        ->where('posisi_di_kantor_1', '=', 1)
        ->where('kantor_1_id', '=', $kantorAsalId)
        ->where('kantor_2_id', '=', $kantorTujuanId)
        ->where('is_deleted',0)
        ->where('status',1)
        ->orWhere('posisi_di_kantor_1', '=', 0)
        ->where('kantor_1_id', '=', $kantorTujuanId)
        ->where('kantor_2_id', '=', $kantorAsalId)
        ->where('is_deleted',0)
        ->where('status',1)
        ->get();
    }  

    public static function getNextId() {
        if (Kendaraan::count() > 0) {
            $lastObject = Kendaraan::getAll()
            ->select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;

            $lastId = intval(substr($lastObject->id, 2, 6));
            $lastId = str_pad(strval($lastId + 1), 6, "0", STR_PAD_LEFT);

            $newLastId = 'KE' . $lastId;
            return $newLastId;
        } else {
            return 'KE000000';
        }
    }

}
