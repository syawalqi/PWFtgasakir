<?php

namespace Tests\Feature;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_all_complaints()
    {
        Complaint::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get('/admin/complaints');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_any_complaint_detail()
    {
        $complaint = Complaint::factory()->create();

        $response = $this->actingAs($this->admin)->get("/admin/complaints/{$complaint->id}");

        $response->assertStatus(200);
    }

    public function test_admin_can_update_complaint_status()
    {
        $complaint = Complaint::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($this->admin)->patch("/admin/complaints/{$complaint->id}/status", [
            'status' => 'diproses',
        ]);

        $response->assertRedirect();
        $this->assertEquals('diproses', $complaint->fresh()->status);
    }

    public function test_admin_can_filter_complaints_by_status()
    {
        Complaint::factory()->create(['status' => 'pending']);
        Complaint::factory()->create(['status' => 'selesai']);

        $response = $this->actingAs($this->admin)->get('/admin/complaints?status=pending');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_response()
    {
        $complaint = Complaint::factory()->create();

        $response = $this->actingAs($this->admin)->post("/admin/complaints/{$complaint->id}/responses", [
            'message' => 'Kami akan segera menindaklanjuti laporan Anda.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('responses', ['complaint_id' => $complaint->id]);
    }
}
