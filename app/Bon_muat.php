<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bon_muat extends Model
{

    protected $guarded = ['created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 15
    //1 character of B
    //8 digit of id integer
    //6 digit of integer indicating time of creation (2digitdate,2digitmonth,2digityear)
    //B0000001131320

    public $incrementing = false;

    public function kendaraan() {
        return $this->belongsTo('App\Kendaraan');
    }

    public function kurir_non_customer() {
        return $this->belongsTo('App\Kurir_non_customer');
    }

    public function kantor_asal() {
        return $this->belongsTo('App\Kantor','kantor_asal_id');
    }

    public function kantor_tujuan() {
        return $this->belongsTo('App\Kantor','kantor_tujuan_id');
    }

    public function kota_asal(){
        return kantor_asal()->kota;  
    }

    public function resis() {
        return $this->belongsToMany('App\Resi', 'surat_jalans')
        ->as('surat_jalan')
        ->withPivot('telah_sampai', 'is_deleted', 'user_created', 'user_updated','waktu_sampai')
        ->withTimestamps()
        ;
    }

    //static functions for query
    public static function getAll() {
        return Bon_muat::where("is_deleted", 0);
    }

    public static function count() {
        return Bon_muat::getAll()->count();
    }

    public static function getNextId() {
        date_default_timezone_set("Asia/Jakarta");

        if (Bon_muat::all()->count() > 0) {
            $lastObject = Bon_muat::select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;
    
            $lastId = intval(substr($lastObject->id, 1, 8));
            $lastId = str_pad(strval($lastId + 1), 8, "0", STR_PAD_LEFT);
    
            $newLastId = 'B' . $lastId . date('dmy');
            return $newLastId;
        } else {
            return 'B00000000' . date('dmy');
        }
    }
}
