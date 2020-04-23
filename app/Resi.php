<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resi extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 15
    //1 character of R
    //8 digit of id integer
    //6 digit of integer indicating time of creation (2digitdate,2digitmonth,2digityear)
    //R0000001131320
    public $incrementing = false;

    public function pengiriman_customers() {
        return $this->belongsToMany('App\Pengiriman_Customer', 'd_pengiriman_customers')
        ->as('d_pengiriman_customer')
        ->withTimestamps()
        ;
    }

    public function bon_muats() {
        return $this->belongsToMany('App\Bon_Muat', 'surat_jalans')
        ->as('surat_jalan')
        ->withTimestamps()
        ;
    }

    //static functions for query
    public static function getAll() {
        return Resi::where("is_deleted", 0);
    }

    public static function count() {
        return Resi::getAll()->count();
    }

    public static function getNextId() {
        date_default_timezone_set("Asia/Jakarta");

        if (Resi::count() > 0) {
            $lastObject = Resi::getAll()
            ->select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;
    
            $lastId = intval(substr($lastObject->id, 1, 8));
            $lastId = str_pad(strval($lastId + 1), 8, "0", STR_PAD_LEFT);
    
            $newLastId = 'R' . $lastId . date('dmy');
            return $newLastId;
        } else {
            return 'R00000000' . date('dmy');
        }
    }

    public function sejarahs() {
        return $this
        ->hasMany('App\Sejarah')
        ->orderBy('waktu', 'desc')
        ;
    }

    public function getKotaAsal() {
        return $this->belongsTo('App\Kota','kota_asal','nama');
    }

    public function getKotaTujuan() {
        return $this->belongsTo('App\Kota','kota_tujuan','nama');
    }
}
