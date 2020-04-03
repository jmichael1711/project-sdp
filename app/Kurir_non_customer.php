<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurir_non_customer extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 8
    //2 character of KN
    //6 digit of id integer
    //KN000001
    public $incrementing = false;

    public function kantor_1() {
        return $this->belongsTo('App\Kantor', 'kantor_1_id')->where('is_deleted',0);
    }

    public function kantor_2() {
        return $this->belongsTo('App\Kantor', 'kantor_2_id')->where('is_deleted',0);
    }

    //static functions for query
    public static function getAll() {
        return Kurir_non_customer::where("is_deleted", 0);
    }

    public static function count() {
        return Kurir_non_customer::getAll()->count();
    }

    public static function sortKurir($kantorAsalId,$kantorTujuanId){
        return Kurir_non_customer::getAll()
        ->where('posisi_di_kantor_1', '=', 1)
        ->where('kantor_1_id', '=', $kantorAsalId)
        ->where('kantor_2_id', '=', $kantorTujuanId)
        ->where('is_deleted',0)
        ->orWhere('posisi_di_kantor_1', '=', 0)
        ->where('kantor_1_id', '=', $kantorTujuanId)
        ->where('kantor_2_id', '=', $kantorAsalId)
        ->where('is_deleted',0)
        ->get();
    }

    public static function getNextId() {

        if (Kurir_non_customer::count() > 0) {
            $lastObject = Kurir_non_customer::getAll()
            ->select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;

            $lastId = intval(substr($lastObject->id, 2, 6));
            $lastId = str_pad(strval($lastId + 1), 6, "0", STR_PAD_LEFT);

            $newLastId = 'KN' . $lastId;
            return $newLastId;
        } else {
            return 'KN000000';
        }
    }
}
