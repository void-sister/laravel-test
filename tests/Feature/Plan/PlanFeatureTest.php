<?php

namespace Tests\Feature\Plan;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_plans_page()
    {
        $user = User::factory()->create();
        $plans = Plan::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('plans'));

        $response->assertStatus(200);
        foreach ($plans as $plan) {
            $response->assertSeeText($plan->plan_name);
        }
    }

    /** @test */
    public function plans_page_disables_button_for_current_user_plan()
    {
        $plan = Plan::factory()->create();
        $user = User::factory()->create(['plan_id' => $plan->id]);

        $this->actingAs($user)
            ->get(route('plans'))
            ->assertSee('Current Plan')
            ->assertSee('disabled');
    }

    /** @test */
    public function user_can_subscribe_to_new_plan()
    {
        $oldPlan = Plan::factory()->create();
        $newPlan = Plan::factory()->create();
        $user = User::factory()->create(['plan_id' => $oldPlan->id]);

        $this->actingAs($user)
            ->post(route('plans.subscribe', $newPlan))
            ->assertRedirect()
            ->assertSessionHas('success', 'Plan updated successfully!');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'plan_id' => $newPlan->id
        ]);
    }

    /** @test */
    public function user_cannot_subscribe_to_same_plan()
    {
        $plan = Plan::factory()->create();
        $user = User::factory()->create(['plan_id' => $plan->id]);

        $this->actingAs($user)
            ->post(route('plans.subscribe', $plan))
            ->assertRedirect()
            ->assertSessionHas('message', 'You already have this plan.');

        $this->assertEquals($user->fresh()->plan_id, $plan->id);
    }
}
