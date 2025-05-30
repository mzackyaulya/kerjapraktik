<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class rute extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'rutes';
    protected $keyType = 'string';
    protected $fillable =
    [
        'asal','tujuan','metode','harga','estimasi_waktu'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
