<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    protected $fillable = [
        'country_id',
        'section',
        'number',
        'name',
        'is_owned',
        'rarity',
        'is_special',
        'background_color',
        'image_url',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function users()
{
    return $this->belongsToMany(
        User::class,
        'user_stickers'
    )->withPivot('is_owned')
     ->withTimestamps();
}
}