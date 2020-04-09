<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public $primaryKey = "id";

    public $incrementing = true;

    public $timestamps = false;

    public function resi() {
        return $this->belongsTo('App\Resi','resi_id', 'id');
    }
}
