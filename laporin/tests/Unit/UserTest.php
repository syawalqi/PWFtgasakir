<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_admin_returns_true_for_admin_role()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->assertTrue($user->isAdmin());
    }

    public function test_is_admin_returns_false_for_user_role()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->assertFalse($user->isAdmin());
    }

    public function test_user_has_complaints_relationship()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $user->complaints());
    }

    public function test_user_has_responses_relationship()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $user->responses());
    }
}
