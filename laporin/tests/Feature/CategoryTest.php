<?php

namespace Tests\Feature;

use App\Models\ComplaintCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Infrastruktur',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('complaint_categories', ['name' => 'Infrastruktur']);
    }

    public function test_admin_cannot_create_duplicate_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        ComplaintCategory::factory()->create(['name' => 'Infrastruktur']);

        $response = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Infrastruktur',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_user_cannot_access_category_management()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/categories');

        $response->assertStatus(403);
    }
}
