<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_users_index_page()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $plan = Plan::factory()->create(['plan_name' => 'Basic']);

        User::factory()->count(3)->create(['plan_id' => $plan->id]);

        $response = $this->actingAs($admin)->get(route('users'));

        $response->assertStatus(200);
        $response->assertViewIs('user.index');
        $response->assertViewHas('users');
        $response->assertSee('Users');
    }

    /** @test */
    public function non_admin_user_is_redirected_from_user_index()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('users'));

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error', 'You are not authorized to view this page.');
    }

    /** @test */
    public function guests_cannot_access_user_index()
    {
        $response = $this->get(route('users'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function search_and_sorting_works()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $plan = Plan::factory()->create(['plan_name' => 'Premium']);

        $john = User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com', 'plan_id' => $plan->id]);
        $jane = User::factory()->create(['name' => 'Jane Smith', 'email' => 'jane@example.com']);

        // Search for "John"
        $response = $this->actingAs($admin)->get(route('users', [
            'search' => 'John',
            'sort_by' => 'name',
            'sort_direction' => 'asc',
        ]));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertDontSee('Jane Smith');
    }

    /** @test */
    public function validation_fails_for_invalid_search()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('users', [
            'search' => 'ab', // too short
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['search']);
    }
}
