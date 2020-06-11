<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kurir;
use Illuminate\Support\Facades\Session;

class Kantor extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primarykey = "id";
    //id has length 8
    //2 character of KA
    //6 digit of id integer
    //KA000001
    public $incrementing = false;

    public function kendaraans() {
        return $this->hasMany('App\Kendaraan')->where('is_deleted',0);
    }
    
    public function getKota(){
        return $this->belongsTo('App\Kota','kota', 'nama');
    }

    public function kurir_customer() {
        return $this->hasMany('App\Kurir_customer')->where('is_deleted',0);
    }

    public function kurir_non_customer() {
        //select * from kurir_non_customer where is_deleted = 0 and (kantor_1_id = THIS->id OR kantor_2_id = THIS->id)
        return Kurir_non_customer::where('is_deleted', 0)
        ->where(function($query) {
            $query->where('kantor_1_id', $this->id)
            ->orWhere('kantor_2_id', $this->id);
        })
        ->get()
        ;
    }

    public function kurir_non_customer_1() {
        //Gets Kurir, IF the foreign key which references Kantor is kantor_1_id
        return $this->hasMany('App\Kurir_non_customer', 'kantor_1_id')->where('is_deleted',0);
    }

    public function kurir_non_customer_2() {
        //Gets Kurir, IF the foreign key which references Kantor is kantor_2_id
        return $this->hasMany('App\Kurir_non_customer', 'kantor_2_id')->where('is_deleted',0);
    }

    //static functions for query
    //get all cannot be used directly. ->get() must be used at the end of function chain.
    public static function getAll() {
        return Kantor::where("is_deleted", 0);
    }

    public static function count() {
        return Kantor::getAll()->count();
    }

    public static function getNextId() {

        if (Kantor::all()->count() > 0) {
            $lastObject = Kantor::select('id')
            ->orderBy('created_at', 'desc')
            ->first()
            ;
    
            $lastId = intval(substr($lastObject->id, 2, 6));
            $lastId = str_pad(strval($lastId + 1), 6, "0", STR_PAD_LEFT);
    
            $newLastId = 'KA' . $lastId;
            return $newLastId;
        } else {
            return 'KA000000';
        }
    }


    // kondisi 1 : jika dari kantor cabang maka
    //         -> hanya munculkan warehouse

    // kondisi 2 : jika berasal dari warehouse maka
    //         ->munculkan kantor cabang jika dipilih kota yang sama
    //         ->hanya munculkan warehouse jika dipilih kota yang berbeda 
    public static function sortKantor($kotaPilihan,$kotaSekarang,$warehouse,$kantorini){
        if($warehouse == 0 || ($warehouse == 1 && $kotaSekarang != $kotaPilihan)){
            return Kantor::getAll()
            ->where("kota",$kotaPilihan)
            ->where("is_warehouse",1)
            ->where("id","<>",$kantorini)
            ->get();
        }else if($warehouse == 1){
            if($kotaSekarang == $kotaPilihan){    
                return Kantor::getAll()
                ->where("kota",$kotaPilihan)
                ->where("is_warehouse",0)
                ->where("id","<>",$kantorini)
                ->get();
            }
        }
    }


}
