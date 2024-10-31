<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'id',
        'name',
    ];

    // Menggunakan UUID sebagai primary key
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        // Mengatur UUID saat model dibuat
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

}
