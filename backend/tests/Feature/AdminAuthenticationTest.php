<?php

namespace Tests\Feature;

use App\Models\Admin;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    public function test_admin_profile_login_redirect_returns_to_the_requested_page(): void
    {
        $this->get(route('admin.profile-verification.index'))
            ->assertRedirect(route('login'));

        $this->actingAs((new Admin())->forceFill(['id' => 1]), 'admin');

        $this->get(route('login'))
            ->assertRedirect(route('admin.profile-verification.index'));
    }

    public function test_authenticated_user_visiting_login_is_sent_to_admin_dashboard(): void
    {
        $this->actingAs((new Admin())->forceFill(['id' => 1]), 'admin')
            ->get(route('login'))
            ->assertRedirect(route('dashboard'));
    }
}
