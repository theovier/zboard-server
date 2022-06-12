<?php

namespace Tests\Feature\Auth;

use App\Models\AllowedDomain;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SignUpTest extends TestCase {
    use RefreshDatabase;

    public function setUp(): void {
        parent::setUp();
        Storage::fake('local');
    }

    public function tearDown(): void {
        //remove faked files from disk, see https://stackoverflow.com/a/56678482/6516194
        Storage::fake('local');
    }

    public function test_user_is_created_after_signup() {
        $data = [
            'email' => 'example@theovier.de',
            'password' => 'password',
            'name' => 'TestUser',
        ];

        $response = $this->postJson('/api/signup', $data);

        $response->assertSuccessful();
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'email_verified_at' => null
        ]);
    }

    /**
     * Faker's Image Service is down, so faker can't create fake images. skip this test for now :(
     */
    /*
    public function test_uploaded_picture_is_stored() {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'email' => 'example@example.com',
            'password' => 'password',
            'name' => 'TestUser',
            'picture' => $image
        ];

        $this->postJson('/api/signup', $data);

        Storage::disk('local')->assertExists('images/' . $image->hashName());
    }
    */

    /**
     * Faker's Image Service is down, so faker can't create fake images. skip this test for now :(
     */
    /*
    public function test_uploaded_picture_is_associated_with_user() {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'email' => 'example@example.com',
            'password' => 'password',
            'name' => 'TestUser',
            'picture' => $image
        ];

        $this->postJson('/api/signup', $data);

        $user = User::where('email', $data['email'])
            ->first();
        $this->assertNotNull($user->image);
    }
    */

    /**
     * @dataProvider invalidInputs
     */
    public function test_invalid_inputs($data) {
        User::create([
            'email' => 'alreadyTakenEmail@example.com',
            'password' => 'password',
            'name' => 'dummy']);
        $this
            ->postJson('/api/signup', $data)
            ->assertUnprocessable();
    }

    /**
     * @dataProvider validInputs
     */
    public function test_valid_inputs($data) {
        $this
            ->postJson('/api/signup', $data)
            ->assertSuccessful();
    }

    private function invalidInputs(): array {
        return [
            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => 'Test$$$User',
                ]
            ],

            [
                [
                    'email' => 'alreadyTakenEmail@example.com',
                    'password' => 'password',
                    'name' => 'TestUser',
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => 'Test User',
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => '1234',
                    'name' => 'TestUser',
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => '',
                    'name' => 'TestUser',
                ]
            ],

            [
                [
                    'email' => 'example@subdomain.example.com',
                    'password' => 'password',
                    'name' => 'TestUser',
                ]
            ],

            [
                [
                    'email' => 'example@notAllwoed.com',
                    'password' => 'password',
                    'name' => 'TestUser',
                ]
            ],

            [
                [
                    'email' => '',
                    'password' => 'password',
                    'name' => 'TestUser',
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => '',
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'name' => 'testUser'
                ]
            ],

            [
                [
                    'password' => 'password',
                    'name' => 'testUser'
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => 'TestUser',
                    'picture' => UploadedFile::fake()->create('wrongType', '500', 'application/x-tar')
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => 'TestUser',
                    'picture' => UploadedFile::fake()->create('tooBig', '50000', 'image/png')
                ]
            ],

            [
                [

                ]
            ],

        ];
    }

    private function validInputs(): array {
        return [
            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => 'Test-User',
                    //'picture' => UploadedFile::fake()->image('avatar.jpg')
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => 'Test-User',
                    //'picture' => UploadedFile::fake()->image('avatar.png')
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'password',
                    'name' => 'Test_User',
                ]
            ],

            [
                [
                    'email' => 'example@example.com',
                    'password' => 'p455$3$!11/3_word',
                    'name' => 'TestUser',
                ]
            ],

            [
                [
                    'email' => 'randomStuff@example.com',
                    'password' => 'p455$3$!11/3_word',
                    'name' => 'TestUser',
                ]
            ],

        ];
    }
}
