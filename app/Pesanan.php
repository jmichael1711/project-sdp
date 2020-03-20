<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 15
    //1 character of O
    //8 digit of id integer
    //6 digit of integer indicating time of creation (2digitdate,2digitmonth,2digityear)
    //O0000001131320
    public $incrementing = false;

    public function resi() {
        return $this->belongsTo('App\Resi');
    }

    public function kurir_customer() {
        return $this->belongsTo('App\Kurir_customer');
    }

    //static functions for query
    public static function getAll() {
        return Pesanan::where("is_deleted", 0);
    }

    public static function count() {
        return Pesanan::getAll()->count();
    }

    public static function getNextId() {
        date_default_timezone_set("Asia/Jakarta");

        if (Pesanan::count() > 0) {
            $lastObject = Pesanan::getAll()
            ->select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;

            $lastId = intval(substr($lastObject->id, 1, 8));
            $lastId = str_pad(strval($lastId + 1), 8, "0", STR_PAD_LEFT);

            $newLastId = 'O' . $lastId . date('dmy');
            return $newLastId;
        } else {
            return 'O00000000' . date('dmy');
        }
    }
}
