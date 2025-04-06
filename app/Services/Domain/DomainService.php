<?php

namespace App\Services\Domain;

use App\Models\Domain;
use App\Models\User;
use App\Services\Domain\Dto\DomainDto;
use App\Services\Domain\Exceptions\DomainAlreadyExistsException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class DomainService
{
    /**
     * Get domains for the given user.
     */
    public function getUserDomains(User $user): Collection
    {
        return $user->domains()->latest()->get();
    }

    /**
     * Create a new domain for the given user.
     *
     * @throws DomainAlreadyExistsException|ValidationException
     */
    public function createForUser(DomainDto $dto, User $user): Domain
    {
        $parsedDomain = $this->parseDomain($dto->domain);

        if (!$parsedDomain) {
            throw ValidationException::withMessages([
                'domain' => 'Invalid domain format.',
            ]);
        }

        if ($this->isDomainTaken($parsedDomain)) {
            throw DomainAlreadyExistsException::withMessages([
                'domain' => 'This domain is already taken by another user.',
            ]);
        }

        return $this->storeUserDomain($user, $parsedDomain);
    }

    public function parseDomain(string $input): ?string
    {
        return parse_domain($input);
    }

    public function isDomainTaken(string $domain): bool
    {
        return Domain::where('domain', $domain)->exists();
    }

    public function storeUserDomain(User $user, string $domain): Domain
    {
        return $user->domains()->create(['domain' => $domain]);
    }
}
