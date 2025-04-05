<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'plan_name',
        'price',
        'features',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'features' => 'array',
    ];

    /**
     * Users subscribed to this plan.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
