<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurir_customer extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 8
    //2 character of KC
    //6 digit of id integer
    //KC000001
    public $incrementing = false;

    public function kantor() {
        return $this->belongsTo('App\Kantor');
    }

    //static functions for query
    public static function getAll() {
        return Kurir_customer::where("is_deleted", 0);
    }

    public static function getKurKantor($id) {
        return Kurir_customer::where("kantor_id", $id);
    }

    public static function count() {
        return Kurir_customer::getAll()->count();
    }

    public static function getNextId() {

        if (Kurir_customer::all()->count() > 0) {
            $lastObject = Kurir_customer::select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;

            $lastId = intval(substr($lastObject->id, 2, 6));
            $lastId = str_pad(strval($lastId + 1), 6, "0", STR_PAD_LEFT);

            $newLastId = 'KC' . $lastId;
            return $newLastId;
        } else {
            return 'KC000000';
        }
    }

}
