<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usulan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'deskripsi',
        'pengusul',
        'kode_wilayah',
        'latitude',
        'longitude',
        'skpd_id',
        'periode_id',
        'status_id'
    ];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function status()
    {
        return $this->belongsTo(Status_usulan::class);
    }

    public function gambar()
    {
        return $this->hasMany(Gambar_usulan::class);
    }
}
