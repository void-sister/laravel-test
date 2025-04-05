<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domain extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'domain',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * Get the user that owns the domain.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
