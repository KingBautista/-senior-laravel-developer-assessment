<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected UserService $userService;
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
        $this->faker = Faker::create();
    }

    /**
     * A basic unit test example.
     */
    public function test_can_return_a_paginated_list_of_users()
    {
        User::factory()->count(25)->create();

        $perPage = 10;
        $paginatedUsers = $this->userService->list($perPage);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $paginatedUsers);
        $this->assertCount($perPage, $paginatedUsers->items());
        $this->assertEquals(25, $paginatedUsers->total());
        $this->assertEquals(3, $paginatedUsers->lastPage());
    }

    public function test_can_store_a_user_to_database() 
    {
        $name = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;

        $data =  [
            'username' => $name,
            'firstname' => $this->faker->firstName,
            'middlename' => 'L',
            'lastname' => $this->faker->lastName,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];

        $user = $this->userService->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    public function test_can_find_and_return_an_existing_user() 
    {
        $user = User::factory()->create();

        $testUser = $this->userService->find($user->id);

        $this->assertEquals($user->id, $testUser->id);
    }

    public function test_can_update_an_existing_user() 
    {
        $user = User::factory()->create();

        $data =  [
            'username' => 'Test Update',
            'firstname' => 'Test Update',
            'middlename' => 'L',
            'lastname' => 'Test Update',
            'email' => 'testemail@gmail.com'
        ];
        $updatedUser = $this->userService->update($data, $user->id);

        $this->assertEquals('Updated User', $updatedUser->username);
        $this->assertTrue($updatedUser->username);
    }

    public function test_can_soft_delete_an_existing_user() 
    {
        $user = User::factory()->create();
        $result = $this->userService->destroy($user->id);

        $this->assertTrue($result);
        $this->assertNull(User::find($user->id));
    }

    public function test_can_return_a_paginated_list_of_trashed_users() 
    {
        $user = User::factory()->create();
        $result = $this->userService->destroy($user->id);

        $restored = $this->userService->restore($user->id);

        $this->assertTrue($restored);
        $this->assertNull(User::find($user->id));
    }
    
    public function test_can_restore_a_soft_deleted_user() 
    {
        $user = User::factory()->create();
        $result = $this->userService->destroy($user->id);

        $restored = $this->userService->restore($user->id);

        $this->assertTrue($restored);
        $this->assertNull(User::find($user->id));
    }

    public function test_can_permanently_delete_a_soft_deleted_user() 
    {
        $user = User::factory()->create();
        $result = $this->userService->destroy($user->id);

        $forceDeleteUser = $this->userService->forceDelete($user->id);

        $this->assertTrue($forceDeleteUser);
        $this->assertNull(User::find($user->id));
    }

}
