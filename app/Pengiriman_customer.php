<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman_customer extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    public $primarykey = "id";
    //id has length 15
    //1 character of P
    //8 digit of id integer
    //6 digit of integer indicating time of creation (2digitdate,2digitmonth,2digityear)
    //P0000001131320

    public $incrementing = false;
    
    public function kantor() {
        return $this->belongsTo('App\Kantor');
    }

    public function kurir_customer() {
        return $this->belongsTo('App\Kurir_customer');
    }
    
    public function resis() {
        return $this->belongsToMany('App\Resi', 'd_pengiriman_customers')
        ->as('d_pengiriman_customer')
        ->withPivot('telah_sampai', 'is_deleted', 'user_created', 'user_updated', 'waktu_sampai_cust', 'password')
        ->withTimestamps()
        ;
    }

    public function resisOrderedBySampai() {
        return $this->belongsToMany('App\Resi', 'd_pengiriman_customers')
        ->as('d_pengiriman_customer')
        ->withPivot('telah_sampai', 'is_canceled', 'is_deleted', 'user_created', 'user_updated', 'waktu_sampai_cust', 'password')
        ->withTimestamps()
        ->orderBy('is_canceled', 'asc')
        ->orderBy('telah_sampai', 'asc')
        ;
    }

    public function resisOrderedByLastDate() {
        return $this->belongsToMany('App\Resi', 'd_pengiriman_customers')
        ->as('d_pengiriman_customer')
        ->withPivot('telah_sampai', 'is_canceled', 'is_deleted', 'user_created', 'user_updated', 'waktu_sampai_cust', 'password')
        ->withTimestamps()
        ->whereDate('d_pengiriman_customers.created_at', '>=', now()->subMonths(1))
        ->orderBy('d_pengiriman_customers.created_at', 'desc')
        ;
    }

    public function telahSampaiSemua() {
        $count = $this->belongsToMany('App\Resi', 'd_pengiriman_customers')
        ->as('d_pengiriman_customer')
        ->withPivot('telah_sampai', 'is_deleted', 'user_created', 'user_updated', 'waktu_sampai_cust', 'password')
        ->withTimestamps()
        ->where('telah_sampai', 0)
        ->count()
        ;

        return $count == 0;
    }
    

    //static functions for query
    public static function getAll() {
        return Pengiriman_customer::where("is_deleted", 0);
    }

    public static function count() {
        return Pengiriman_customer::getAll()->count();
    }

    public static function getNextId() {
        date_default_timezone_set("Asia/Jakarta");

        if (Pengiriman_customer::count() > 0) {
            $lastObject = Pengiriman_customer::select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;
    
            $lastId = intval(substr($lastObject->id, 1, 8));
            $lastId = str_pad(strval($lastId + 1), 8, "0", STR_PAD_LEFT);
    
            $newLastId = 'P' . $lastId . date('dmy');
            return $newLastId;
        } else {
            return 'P00000000' . date('dmy');
        }
    }

}
