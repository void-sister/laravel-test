<?php

namespace Tests\Feature\Domain;

use App\Models\Domain;
use App\Models\User;
use App\Services\Domain\Exceptions\DomainAlreadyExistsException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DomainFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        app()->bind('App\Services\DomainService', function ($app) {
            return new class {
                public function parseDomain($input)
                {
                    // Basic validation, e.g. 'https://example.com' => 'example.com'
                    return filter_var($input, FILTER_VALIDATE_DOMAIN) ? $input : null;
                }

                public function isDomainTaken($domain)
                {
                    return Domain::where('domain', $domain)->exists();
                }

                public function storeUserDomain($user, $domain)
                {
                    return $user->domains()->create(['domain' => $domain]);
                }

                public function getUserDomains($user)
                {
                    return $user->domains()->latest()->get();
                }

                public function createForUser($dto, $user)
                {
                    $domain = $this->parseDomain($dto->domain);

                    if (!$domain) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'domain' => 'Invalid domain format.',
                        ]);
                    }

                    if ($this->isDomainTaken($domain)) {
                        throw DomainAlreadyExistsException::withMessages([
                            'domain' => 'This domain is already taken by another user.',
                        ]);
                    }

                    return $this->storeUserDomain($user, $domain);
                }
            };
        });
    }

    public function test_dashboard_page_displays_user_domains()
    {
        $user = User::factory()->create();
        $user->domains()->create(['domain' => 'example.com']);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSeeText('example.com');
    }

    public function test_user_can_add_valid_domain()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('domains.store'), [
            'domain' => 'validexample.com',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('domains', [
            'domain' => 'validexample.com',
            'user_id' => $user->id,
        ]);
    }

    public function test_it_fails_validation_with_empty_domain()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('domains.store'), [
            'domain' => '',
        ]);

        $response->assertSessionHasErrors('domain');
    }

    public function test_it_fails_validation_if_domain_is_not_unique()
    {
        $user = User::factory()->create();
        Domain::create([
            'user_id' => $user->id,
            'domain' => 'duplicate.com',
        ]);

        $newUser = User::factory()->create();

        $response = $this->actingAs($newUser)->post(route('domains.store'), [
            'domain' => 'duplicate.com',
        ]);

        $response->assertSessionHasErrors('domain');
    }

    public function test_it_fails_if_invalid_domain_format_is_used()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('domains.store'), [
            'domain' => 'not a valid domain',
        ]);

        $response->assertSessionHasErrors('domain');
    }

    public function test_success_flash_message_is_set_on_successful_add()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('domains.store'), [
            'domain' => 'success.com',
        ]);

        $response->assertSessionHas('success', 'Domain added successfully.');
    }
}
