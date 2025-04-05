<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\User\Dto\UserSearchDto;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    const DEFAULT_PER_PAGE = 20;

    /**
     * Get all users.
     *
     * @param UserSearchDto $dto
     * @return LengthAwarePaginator
     */
    public function getAllByDto(UserSearchDto $dto): LengthAwarePaginator
    {
        $query = User::with('plan')->orderBy($dto->sortBy, $dto->sortDirection);

        if ($dto->search) {
            $query->where(function ($query) use ($dto) {
                $query->where('name', 'like', "%{$dto->search}%")
                    ->orWhere('email', 'like', "%{$dto->search}%");
            });
        }

        return $query->paginate($dto->perPage);
    }
}
