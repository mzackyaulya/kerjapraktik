<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class sopir extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'sopirs';
    protected $keyType = 'string';
    protected $fillable =
    [
        'nama','nohp','alamat','nosim','status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
