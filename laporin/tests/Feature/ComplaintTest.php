<?php

namespace Tests\Feature;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComplaintTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'user']);
    }

    public function test_user_can_create_complaint()
    {
        $category = ComplaintCategory::factory()->create();

        $response = $this->actingAs($this->user)->post('/user/complaints', [
            'title' => 'Jalan Rusak di Lingkungan Saya',
            'category_id' => $category->id,
            'description' => 'Jalan di depan gang 3 sudah berlubang parah dan membahayakan pengendara.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('complaints', ['title' => 'Jalan Rusak di Lingkungan Saya']);
    }

    public function test_user_can_view_own_complaints()
    {
        Complaint::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get('/user/complaints');

        $response->assertStatus(200);
    }

    public function test_user_can_view_own_complaint_detail()
    {
        $complaint = Complaint::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get("/user/complaints/{$complaint->id}");

        $response->assertStatus(200);
    }

    public function test_user_can_edit_own_pending_complaint()
    {
        $complaint = Complaint::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user)->get("/user/complaints/{$complaint->id}/edit");

        $response->assertStatus(200);
    }

    public function test_user_cannot_edit_complaint_with_status_diproses()
    {
        $complaint = Complaint::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'diproses',
        ]);

        $response = $this->actingAs($this->user)->get("/user/complaints/{$complaint->id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_cannot_delete_complaint_with_status_diproses()
    {
        $complaint = Complaint::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'diproses',
        ]);

        $response = $this->actingAs($this->user)->delete("/user/complaints/{$complaint->id}");

        $response->assertStatus(403);
    }

    public function test_user_cannot_view_other_user_complaint()
    {
        $otherUser = User::factory()->create();
        $complaint = Complaint::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user)->get("/user/complaints/{$complaint->id}");

        $response->assertStatus(403);
    }

    public function test_complaint_creation_fails_with_invalid_data()
    {
        $response = $this->actingAs($this->user)->post('/user/complaints', [
            'title' => 'No',
            'category_id' => 999,
            'description' => 'Short',
        ]);

        $response->assertSessionHasErrors(['title', 'category_id', 'description']);
    }
}
