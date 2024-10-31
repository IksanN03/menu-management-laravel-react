<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $fillable = [
        'id',
        'menu_id',
        'name',
        'depth',
    ];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        // Mengatur UUID saat model dibuat
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
