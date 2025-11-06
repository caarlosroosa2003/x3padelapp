<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_forbidden_on_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302); // redirect to login if auth middleware kicks in
    }

    public function test_non_admin_user_gets_403(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_user_access_dashboard(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }
}


