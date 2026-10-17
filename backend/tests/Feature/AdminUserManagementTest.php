<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
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

        Schema::connection('sqlite')->create('users', function ($table): void {
            $table->id();
            $table->string('member_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('city')->nullable();
            $table->string('plan')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('profiles', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
        });
        Schema::connection('sqlite')->create('user_subscriptions', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id');
        });
        Schema::connection('sqlite')->create('interests', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
        });

        $this->actingAs((new Admin)->forceFill(['id' => 99]), 'admin');
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

    public function test_index_excludes_admin_accounts_and_displays_email_and_status(): void
    {
        $member = $this->createMember([
            'name' => 'Active Member',
            'email' => 'active@example.com',
            'status' => 1,
        ]);
        $this->createMember([
            'name' => 'Admin Account',
            'email' => 'admin@example.com',
            'role' => 'ADMIN',
        ]);

        $this->get(route('users.index'))
            ->assertOk()
            ->assertSee('Active Member')
            ->assertSee('active@example.com')
            ->assertSee('Active')
            ->assertDontSee('Admin Account')
            ->assertSeeInOrder([
                '<tbody id="usersTableBody" class="fs-13">',
                'Active Member',
                'active@example.com',
                '</tbody>',
            ], false);

        $this->assertSame($member->id, User::where('email', 'active@example.com')->value('id'));
    }

    public function test_empty_member_list_displays_an_empty_state_instead_of_a_blank_table_body(): void
    {
        $this->get(route('users.index'))
            ->assertOk()
            ->assertSee('No members found in database.');
    }

    public function test_store_requires_email_and_saves_a_lowercase_email_with_a_random_password(): void
    {
        $this->postJson(route('users.store'), $this->validMemberPayload(['email' => '']))
            ->assertUnprocessable()
            ->assertJsonValidationErrors('email');

        $response = $this->postJson(route('users.store'), $this->validMemberPayload([
            'email' => 'New.Member@Example.com',
        ]));

        $response->assertCreated()
            ->assertJsonPath('data.email', 'new.member@example.com')
            ->assertJsonPath('data.status', 'Pending')
            ->assertJsonPath('counts.all', 1)
            ->assertJsonMissingPath('data.password');

        $this->postJson(route('users.store'), $this->validMemberPayload([
            'email' => 'NEW.MEMBER@example.com',
        ]))
            ->assertUnprocessable()
            ->assertJsonValidationErrors('email');

        $user = User::where('email', 'new.member@example.com')->firstOrFail();
        $this->assertFalse(Hash::check('not-the-password', $user->password));
    }

    public function test_update_changes_member_details_and_returns_refreshed_counts(): void
    {
        $user = $this->createMember([
            'email' => 'old@example.com',
            'status' => 0,
        ]);

        $this->putJson(route('users.update', $user->id), $this->validMemberPayload([
            'name' => 'Updated Member',
            'email' => 'UPDATED@example.com',
            'status' => 'Active',
        ]))
            ->assertOk()
            ->assertJsonPath('data.name', 'Updated Member')
            ->assertJsonPath('data.email', 'updated@example.com')
            ->assertJsonPath('data.status', 'Active')
            ->assertJsonPath('counts.pending', 0)
            ->assertJsonPath('counts.active', 1);
    }

    public function test_delete_preserves_related_members_and_deletes_unlinked_members(): void
    {
        $linkedMember = $this->createMember(['email' => 'linked@example.com']);
        DB::table('profiles')->insert(['user_id' => $linkedMember->id]);

        $this->deleteJson(route('users.destroy', $linkedMember->id))
            ->assertStatus(409)
            ->assertJsonPath('success', false);
        $this->assertDatabaseHas('users', ['id' => $linkedMember->id]);

        $unlinkedMember = $this->createMember(['email' => 'unlinked@example.com']);
        $this->deleteJson(route('users.destroy', $unlinkedMember->id))
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('counts.all', 1);
        $this->assertDatabaseMissing('users', ['id' => $unlinkedMember->id]);
    }

    public function test_export_applies_search_and_protects_formula_values(): void
    {
        $this->createMember([
            'name' => '=HYPERLINK("https://example.com")',
            'email' => 'formula@example.com',
            'city' => 'Chennai',
        ]);
        $this->createMember([
            'name' => 'Different Member',
            'email' => 'different@example.com',
            'city' => 'Salem',
        ]);

        $response = $this->get(route('users.export', ['search' => 'formula@example.com']));
        $response->assertOk();
        $csv = $response->streamedContent();

        $this->assertStringContainsString("'=HYPERLINK", $csv);
        $this->assertStringContainsString('formula@example.com', $csv);
        $this->assertStringNotContainsString('different@example.com', $csv);
        $this->assertStringContainsString("\xEF\xBB\xBF", $csv);
    }

    private function createMember(array $overrides = []): User
    {
        return User::create(array_merge([
            'member_id' => 'TM-'.random_int(10000, 99999),
            'name' => 'Test Member',
            'email' => 'member-'.random_int(10000, 99999).'@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'gender' => 'Female',
            'age' => 25,
            'city' => 'Chennai',
            'plan' => 'Free',
            'status' => 0,
        ], $overrides));
    }

    private function validMemberPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'New Member',
            'email' => 'new@example.com',
            'gender' => 'Female',
            'age' => 25,
            'city' => 'Chennai',
            'status' => 'Pending',
            'plan' => 'Free',
        ], $overrides);
    }
}
