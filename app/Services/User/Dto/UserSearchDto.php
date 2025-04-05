<?php

namespace App\Services\User\Dto;

class UserSearchDto
{
    public function __construct(
        public string $sortBy,
        public string $sortDirection,
        public ?string $search,
        public int $perPage
    ) {}
}
