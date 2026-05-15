<?php

namespace Tests\Feature;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_gets_403_accessing_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_user_gets_403_accessing_admin_complaints()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/complaints');

        $response->assertStatus(403);
    }

    public function test_user_gets_403_updating_complaint_status()
    {
        $user = User::factory()->create(['role' => 'user']);
        $complaint = Complaint::factory()->create();

        $response = $this->actingAs($user)->patch("/admin/complaints/{$complaint->id}/status", [
            'status' => 'diproses',
        ]);

        $response->assertStatus(403);
    }

    public function test_guest_gets_redirected_to_login()
    {
        $response = $this->get('/user/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_gets_403_accessing_admin_categories_as_non_admin_api()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->post('/admin/categories', [
            'name' => 'Test',
        ]);

        $response->assertStatus(403);
    }
}
