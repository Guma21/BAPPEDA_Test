<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar_usulan extends Model
{
    protected $fillable = ['usulan_id', 'path'];

    public function usulan()
    {
        return $this->belongsTo(Usulan::class);
    }
}
