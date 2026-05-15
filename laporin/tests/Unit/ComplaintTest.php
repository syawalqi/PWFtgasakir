<?php

namespace Tests\Unit;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComplaintTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_pending_returns_true_when_status_is_pending()
    {
        $complaint = new Complaint(['status' => 'pending']);
        $this->assertTrue($complaint->isPending());
    }

    public function test_is_pending_returns_false_when_status_is_not_pending()
    {
        $complaint = new Complaint(['status' => 'diproses']);
        $this->assertFalse($complaint->isPending());
    }

    public function test_get_status_badge_returns_correct_class()
    {
        $pending = new Complaint(['status' => 'pending']);
        $diproses = new Complaint(['status' => 'diproses']);
        $selesai = new Complaint(['status' => 'selesai']);

        $this->assertStringContainsString('yellow', $pending->status_badge);
        $this->assertStringContainsString('blue', $diproses->status_badge);
        $this->assertStringContainsString('green', $selesai->status_badge);
    }

    public function test_complaint_has_relationships()
    {
        $user = User::factory()->create();
        $category = ComplaintCategory::factory()->create();
        $complaint = Complaint::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $complaint->user());
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $complaint->category());
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $complaint->responses());
    }
}
