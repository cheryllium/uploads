<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class Image extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false; 

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }
}
