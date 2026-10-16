<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    public function test_admin_profile_login_redirect_returns_to_the_requested_page(): void
    {
        $this->get(route('admin.profile-verification.index'))
            ->assertRedirect(route('login'));

        $this->actingAs(User::factory()->make(['id' => 1]));

        $this->get(route('login'))
            ->assertRedirect(route('admin.profile-verification.index'));
    }

    public function test_authenticated_user_visiting_login_is_sent_to_admin_dashboard(): void
    {
        $this->actingAs(User::factory()->make(['id' => 1]))
            ->get(route('login'))
            ->assertRedirect(route('dashboard'));
    }
}
