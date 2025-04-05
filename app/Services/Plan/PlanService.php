<?php

namespace App\Services\Plan;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class PlanService
{
    /**
     * Get all plans.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Plan::all();
    }

    public function getCurrentUserPlanId(User|Authenticatable $user): ?int
    {
        return $user->plan_id;
    }
}
