<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 8
    //2 character of KE
    //6 digit of id integer
    //KE000001
    public $incrementing = false;

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
