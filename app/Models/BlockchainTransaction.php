<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockchainTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'tx_hash',
        'user_id',
        'type',
        'status',
        'gas_used',
        'block_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
