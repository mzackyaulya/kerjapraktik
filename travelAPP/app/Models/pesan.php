<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'pesans';
    protected $keyType = 'string';
    protected $fillable =
    [
        'user_id','jadwal_id','nama_pemesan','nohp','alamat','seet','jumlah_orang','harga_total','status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(jadwal::class,'jadwal_id','id');
    }
}
