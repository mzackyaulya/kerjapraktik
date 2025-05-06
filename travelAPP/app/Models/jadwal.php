<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'rute_id', 'kendaraan_id', 'sopir_id', 'tanggal_berangkat', 'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function rute()
    {
        return $this->belongsTo(rute::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(kendaraan::class);
    }

    public function sopir()
    {
        return $this->belongsTo(sopir::class);
    }
}
