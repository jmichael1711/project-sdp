<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 8
    //2 character of PE
    //6 digit of id integer
    //PE000001
    public $incrementing = true;

    public function kantor() {
        return $this->belongsTo('App\Kantor');
    }

    //static functions for query
    public static function getAll() {
        return Pegawai::where("is_deleted", 0);
    }

    public static function count() {
        return Pegawai::getAll()->count();
    }

    public static function getNextId() {

        if (Pegawai::count() > 0) {
            $lastObject = Pegawai::getAll()
            ->select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;
    
            $lastId = intval(substr($lastObject->id, 2, 6));
            $lastId = str_pad(strval($lastId + 1), 6, "0", STR_PAD_LEFT);
    
            $newLastId = 'PE' . $lastId;
            return $newLastId;
        } else {
            return 'PE000000';
        }
    }

}
