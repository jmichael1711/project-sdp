<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kurir;

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
        return $this->hasMany('App\Kendaraan');
    }

    public function kurir_customer() {
        return $this->hasMany('App\Kurir_customer');
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
        return $this->hasMany('App\Kurir_non_customer', 'kantor_1_id');
    }

    public function kurir_non_customer_2() {
        //Gets Kurir, IF the foreign key which references Kantor is kantor_2_id
        return $this->hasMany('App\Kurir_non_customer', 'kantor_2_id');
    }

    //static functions for query
    //get all cannot be used directly. ->get() must be used at the end of function chain.
    public static function getAll() {
        return Kantor::where("is_deleted", 0)->get();
    }

    public static function count() {
        return Kantor::getAll()->count();
    }

    public static function getNextId() {

        if (Kantor::count() > 0) {
            $lastObject = Kantor::getAll()
            ->select('id')
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

    public static function insert($request) {
        $request['id'] = Kantor::getNextId();
        Kantor::create($request);   
    }
}
