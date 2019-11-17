<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class AuthTest extends TestCase
{
    /**
     * @test
     *  Test registration
    */
    public function test_register_api()
    {
        // Create User
        $data = [
            'name' => 'Test',
            'email' => 'test@auth.com',
            'password' => 'password'
        ];

        // Send post request
        $register = $this->json('POST', 'api/v1/register', $data);

        // Assert it was successful
        $register->assertStatus(200);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($register->json()['statusCode'], 200);
    }

    /**
     * @test
     *  Test Login
    */
    public function test_login_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@auth.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($login->json()['statusCode'], 200);
    }


    /**
     * @test
     *  Test Fetch User
    */
    public function test_fetch_user_api()
    {
        // Attempt login
        $register = $this->json('POST', 'api/v1/login', [
            'email' => 'test@auth.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $register->assertStatus(200);

        // Store accessToken from register
        $data = ['accessToken'=>$register->json()['accessToken']];

        // Check fetch User api
        $fetch = $this->json('POST', 'api/v1/fetch/user',  $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($fetch->json()['statusCode'], 200);

        // Delete User
        User::where('email','test@auth.com')->delete();
    }
}
