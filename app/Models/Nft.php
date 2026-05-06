<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_id',
        'name',
        'metadata_uri',
        'price_akwaba',
        'supply_total',
        'rarity',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_nfts')->withPivot('quantity');
    }
}
