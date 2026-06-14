<?php

namespace App\Models;
use App\Models\Sticker;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'total_stickers',
    ];

    public function stickers()
    {
        return $this->hasMany(Sticker::class);
    }
}