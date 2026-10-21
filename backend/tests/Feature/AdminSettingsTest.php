<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminSettingsTest extends TestCase
{
    private string $originalConnection;

    private array $originalSqliteConfig;

    protected function setUp(): void
    {
        parent::setUp();

        $this->originalConnection = config('database.default');
        $this->originalSqliteConfig = config('database.connections.sqlite');
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');

        Schema::connection('sqlite')->create('app_settings', function ($table): void {
            $table->id();
            $table->string('setting_key', 100)->unique();
            $table->longText('setting_value')->nullable();
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('admin', function ($table): void {
            $table->id();
            $table->string('name');
            $table->string('mailid')->unique();
            $table->string('role')->default('admin');
            $table->string('password');
            $table->string('reset_token')->nullable();
            $table->timestamp('reset_token_created_at')->nullable();
            $table->rememberToken();
            $table->timestamp('created_date')->nullable();
            $table->timestamp('updated_date')->nullable();
        });
        Schema::connection('sqlite')->create('admin_audit_logs', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('admin_name');
            $table->string('admin_email');
            $table->string('action');
            $table->string('module');
            $table->text('description');
            $table->string('ip_address')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    protected function tearDown(): void
    {
        DB::purge('sqlite');
        config([
            'database.default' => $this->originalConnection,
            'database.connections.sqlite' => $this->originalSqliteConfig,
        ]);

        parent::tearDown();
    }

    public function test_settings_page_loads_defaults_and_saves_validated_values(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->get(route('admin.setting'))
            ->assertOk()
            ->assertSee('Admin Users')
            ->assertSee('Security & Login')
            ->assertSee('Privacy & Retention')
            ->assertSee('name="settings[minimum_password_length]"', false);

        $this->get(route('admin.settings.index'))
            ->assertOk()
            ->assertSee('Admin Users')
            ->assertSee('Security & Login')
            ->assertSee('Privacy & Retention')
            ->assertSee('name="settings[minimum_password_length]"', false);

        $this->post(route('admin.setting.update'), [
            'settings' => [
                'shop_name' => 'GenZ Matrimonial',
                'support_email' => 'support@example.test',
                'primary_color' => '#561325',
                'accent_color' => '#22c55e',
                'currency' => 'INR',
                'stripe_key' => 'private-test-key',
            ],
        ])
            ->assertRedirect(route('admin.setting'))
            ->assertSessionHas('success');

        $this->assertSame(
            'GenZ Matrimonial',
            json_decode(DB::table('app_settings')->where('setting_key', 'shop_name')->value('setting_value'), true)
        );
        $this->assertTrue((bool) json_decode(
            DB::table('app_settings')->where('setting_key', 'stripe_enabled')->value('setting_value'),
            true
        ));

        $encryptedSecret = DB::table('app_settings')
            ->where('setting_key', 'stripe_key')
            ->value('setting_value');
        $this->assertStringNotContainsString('private-test-key', $encryptedSecret);
        $this->assertSame('private-test-key', json_decode(Crypt::decryptString($encryptedSecret), true));
        $this->assertDatabaseHas('admin_audit_logs', ['action' => 'settings_updated']);
    }

    public function test_settings_backup_excludes_secrets_and_restore_preserves_saved_credentials(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        DB::table('app_settings')->insert([
            [
                'setting_key' => 'shop_name',
                'setting_value' => json_encode('GenZ Matrimonial'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'support_email',
                'setting_value' => json_encode('support@example.test'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'stripe_key',
                'setting_value' => Crypt::encryptString(json_encode('private-test-key')),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $backupResponse = $this->post(route('admin.setting.backup'));
        $backupResponse->assertOk();
        $backup = json_decode($backupResponse->streamedContent(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertSame('application-settings', $backup['scope']);
        $this->assertArrayNotHasKey('stripe_key', $backup['settings']);

        $restoreSettings = [
            'shop_name' => 'Restored Name',
            'support_email' => 'restored@example.test',
            'primary_color' => '#561325',
            'accent_color' => '#22c55e',
            'currency' => 'INR',
        ];
        $json = json_encode([
            'version' => 1,
            'scope' => 'application-settings',
            'settings' => $restoreSettings,
        ], JSON_THROW_ON_ERROR);

        $this->post(route('admin.setting.restore'), [
            'backup_file' => UploadedFile::fake()->createWithContent('settings.json', $json),
        ])
            ->assertRedirect(route('admin.setting'))
            ->assertSessionHas('success');

        $this->assertSame(
            'Restored Name',
            json_decode(DB::table('app_settings')->where('setting_key', 'shop_name')->value('setting_value'), true)
        );
        $this->assertSame(
            'private-test-key',
            json_decode(Crypt::decryptString(
                DB::table('app_settings')->where('setting_key', 'stripe_key')->value('setting_value')
            ), true)
        );
    }

    public function test_invalid_settings_are_reported_without_flashing_api_credentials(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->from(route('admin.setting'))
            ->post(route('admin.setting.update'), [
                'settings' => [
                    'shop_name' => '',
                    'support_email' => 'not-an-email',
                    'primary_color' => 'red',
                    'accent_color' => '#22c55e',
                    'currency' => 'INR',
                    'stripe_key' => 'temporary-secret',
                ],
            ])
            ->assertRedirect(route('admin.setting'))
            ->assertSessionHasErrors([
                'settings.shop_name',
                'settings.support_email',
                'settings.primary_color',
            ])
            ->assertSessionMissing('_old_input.settings.stripe_key');
    }

    public function test_admin_accounts_can_be_created_updated_and_deleted_without_removing_last_admin(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->post(route('admin.setting.admins.store'), [
            'name' => 'Support Operator',
            'email' => 'support@example.test',
            'role' => 'support',
            'password' => 'StrongPass1',
            'password_confirmation' => 'StrongPass1',
        ])->assertRedirect(route('admin.setting', ['section' => 'admin-users-roles']));

        $supportId = DB::table('admin')->where('mailid', 'support@example.test')->value('id');
        $this->assertNotNull($supportId);
        $this->assertNotSame('StrongPass1', DB::table('admin')->where('id', $supportId)->value('password'));

        $this->put(route('admin.setting.admins.update', $supportId), [
            'name' => 'Support Manager',
            'email' => 'manager@example.test',
            'role' => 'manager',
            'password' => '',
            'password_confirmation' => '',
        ])->assertRedirect(route('admin.setting', ['section' => 'admin-users-roles']));

        $this->assertDatabaseHas('admin', [
            'id' => $supportId,
            'name' => 'Support Manager',
            'mailid' => 'manager@example.test',
            'role' => 'manager',
        ]);

        $this->delete(route('admin.setting.admins.destroy', $supportId))
            ->assertRedirect(route('admin.setting', ['section' => 'admin-users-roles']));
        $this->assertDatabaseMissing('admin', ['id' => $supportId]);
        $this->assertDatabaseHas('admin_audit_logs', ['action' => 'admin_created']);
        $this->assertDatabaseHas('admin_audit_logs', ['action' => 'admin_updated']);
        $this->assertDatabaseHas('admin_audit_logs', ['action' => 'admin_deleted']);
    }

    public function test_saved_role_permissions_are_applied_to_admin_routes(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->post(route('admin.setting.update', ['section' => 'permissions', 'role' => 'manager']), [
            'section' => 'permissions',
            'role' => 'manager',
            'settings' => [
                'role_permissions' => [
                    'manager' => [
                        'user_management' => [
                            'view' => false,
                            'create' => false,
                            'edit' => false,
                            'delete' => false,
                        ],
                    ],
                ],
            ],
        ])->assertRedirect(route('admin.setting', ['section' => 'permissions', 'role' => 'manager']));

        $manager = (new Admin)->forceFill([
            'id' => 100,
            'name' => 'Manager',
            'email' => 'manager@example.test',
            'role' => 'manager',
        ]);
        $this->actingAs($manager, 'admin')
            ->get(route('users.index'))
            ->assertForbidden();

        $this->assertDatabaseHas('app_settings', ['setting_key' => 'role_permissions']);
    }

    public function test_security_notification_and_privacy_preferences_are_persisted(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->post(route('admin.setting.update', ['section' => 'security-login']), [
            'section' => 'security-login',
            'settings' => [
                'minimum_password_length' => 12,
                'require_uppercase' => 1,
                'require_lowercase' => 1,
                'require_number' => 1,
                'require_special_character' => 1,
                'two_factor_enabled' => 1,
                'two_factor_authenticator' => 1,
                'two_factor_sms' => 0,
                'max_login_attempts' => 3,
                'lockout_duration_minutes' => 30,
                'session_timeout_minutes' => 120,
            ],
        ])->assertRedirect(route('admin.setting', ['section' => 'security-login']));

        $this->post(route('admin.setting.update', ['section' => 'notifications']), [
            'section' => 'notifications',
            'settings' => [
                'notification_channels' => ['email' => 1, 'sms' => 0, 'push' => 1],
                'notification_events' => [
                    'new_user_registration' => ['email' => 1, 'sms' => 0, 'push' => 1],
                    'profile_verification' => ['email' => 0, 'sms' => 0, 'push' => 1],
                    'payment_received' => ['email' => 1, 'sms' => 1, 'push' => 1],
                    'membership_expiry' => ['email' => 1, 'sms' => 0, 'push' => 0],
                    'new_match_found' => ['email' => 0, 'sms' => 0, 'push' => 1],
                ],
            ],
        ])->assertRedirect(route('admin.setting', ['section' => 'notifications']));

        $this->post(route('admin.setting.update', ['section' => 'privacy-retention']), [
            'section' => 'privacy-retention',
            'settings' => [
                'user_data_retention_years' => 3,
                'message_data_retention_years' => 2,
                'audit_log_retention_years' => 5,
                'deleted_record_retention_months' => 12,
                'data_export_enabled' => 1,
                'data_export_csv' => 1,
                'data_export_pdf' => 0,
                'inactive_account_days' => 365,
                'user_deletion_enabled' => 0,
                'privacy_consent_required' => 1,
                'privacy_policy_visible' => 1,
            ],
        ])->assertRedirect(route('admin.setting', ['section' => 'privacy-retention']));

        $this->assertSame(12, json_decode(DB::table('app_settings')->where('setting_key', 'minimum_password_length')->value('setting_value'), true));
        $this->assertSame(120, json_decode(DB::table('app_settings')->where('setting_key', 'session_timeout_minutes')->value('setting_value'), true));
        $this->assertTrue(json_decode(DB::table('app_settings')->where('setting_key', 'notification_channels')->value('setting_value'), true)['email']);
        $this->assertSame(3, json_decode(DB::table('app_settings')->where('setting_key', 'user_data_retention_years')->value('setting_value'), true));
    }

    public function test_password_policy_is_used_when_creating_an_admin_account(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        DB::table('app_settings')->insert([
            'setting_key' => 'minimum_password_length',
            'setting_value' => json_encode(12),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->from(route('admin.setting', ['section' => 'admin-users-roles']))
            ->post(route('admin.setting.admins.store'), [
                'name' => 'Weak Password User',
                'email' => 'weak@example.test',
                'role' => 'support',
                'password' => 'StrongPass1',
                'password_confirmation' => 'StrongPass1',
            ])
            ->assertRedirect(route('admin.setting', ['section' => 'admin-users-roles']))
            ->assertSessionHasErrors('password');
    }

    public function test_configured_failed_login_limit_blocks_further_attempts(): void
    {
        DB::table('app_settings')->insert([
            [
                'setting_key' => 'max_login_attempts',
                'setting_value' => json_encode(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'lockout_duration_minutes',
                'setting_value' => json_encode(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $payload = ['login' => 'missing-admin@example.test', 'password' => 'wrong'];
        $this->post(route('login.submit'), $payload)
            ->assertSessionHasErrors('login');

        $this->post(route('login.submit'), $payload)
            ->assertSessionHasErrors('login')
            ->assertSessionHas('errors', fn ($errors) => str_contains($errors->first('login'), 'Too many login attempts'));
    }
}
