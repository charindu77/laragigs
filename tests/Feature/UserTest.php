<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test* */
    public function user_can_register_with_valid_data()
    {
        $this->post(
            route('users.store'),
            [
                'name' => 'Jon',
                'email' => 'test@mail.com',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]
        )
            ->assertRedirect(route('listings'))
            ->assertSessionHas('success', 'User: Jon is created successfully and logged in');

        $user = User::where('email', 'test@mail.com')->first();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @dataProvider nameInputValidation
     * */
    public function Registration_form_fields_validation($name, $email, $password, $passwordConf)
    {
        $response = $this->post(
            route('users.store'),
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $passwordConf,
            ]
        )->assertInvalid();
    }

    public function nameInputValidation()
    {
        return [
            'Name is required' => [
                'name' => '',
                'email' => 'test@mail.com',
                'password' => 'password',
                'password)_confirmation' => 'password'
            ],
            'Email is required' => [
                'name' => 'Jon',
                'email' => '',
                'password' => 'password',
                'password_confirmation' => 'password'
            ],
            'Password is required' => [
                'name' => 'Jon',
                'email' => 'test@mail',
                'password' => '',
                'password_confirmation' => 'password'
            ],
            'Password confirmation is required' => [
                'name' => 'Jon',
                'email' => 'test@mail.com',
                'password' => 'password',
                'password_confirmation' => ''
            ],
            [
                'name' => 'Jon',
                'email' => 'test@mail.com',
                'password' => '123',
                'password_confirmation' => '123'
            ]
        ];
    }
    /** @test**/
    public function authenticate_user_with_valid_credentials()
    {
        $user = User::factory()->create([
            'name' => 'Joe',
            'email' => 'joe$@test.com',
            'password' => 'password'
        ]);

        $response = $this->post(route('users.authenticate'), [
            'email' => 'joe$@test.com',
            'password' => 'password'
        ])->assertStatus(302)
        ->assertRedirect('/')
        ->assertSessionHas('success');

        $this->assertAuthenticatedAs($user);
    }

/** @test */
public function Loggedin_user_can_logout()
{
    $user = User::factory()->create([
        'name' => 'Joe',
        'email' => 'joe$@test.com',
        'password' => 'password'
    ]);

    auth()->login($user);

    $this->post(route('users.logout'),[$user])
    ->assertStatus(302)
    ->assertRedirect('/');

    $this->assertNotTrue($this->isAuthenticated());
}
}