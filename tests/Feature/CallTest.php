<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class CallTest extends TestCase
{
    /**
     * @test
     *  Test Calls api
    */
    public function test_calls_api()
    {
        // Create User
        $data = [
            'name' => 'Test',
            'email' => 'test@calls.com',
            'password' => 'password'
        ];

        // Send register request
        $register = $this->json('POST', 'api/v1/register', $data);

        // Assert it was successful
        $register->assertStatus(200);

        // Store accessToken from register
        $array = ['accessToken'=>$register->json()['accessToken']];

        // Check api with accessToken
        $response = $this->json('POST', 'api/v1/calls', $array);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }


    /*
     * @test
     *  Test Create Calls api
    */
    public function test_create_call_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@calls.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'title' => 'Test call title',
            'content' => 'Test call content',
            'start_dateTime' => '12/1/2019 9:00:00',
            'end_dateTime' => '12/1/2019 10:00:00',
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/call/create', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 201);
    }


     /*
     * @test
     *  Test Edit Calls api
    */
    public function test_edit_call_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@calls.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get call_id random from his data
        $rows = $this->json('POST', 'api/v1/calls', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'call_id' => $rows->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/call/edit', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }

     /*
     * @test
     *  Test Update Calls api
    */
    public function test_update_call_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@calls.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get call_id random from his data
        $rows = $this->json('POST', 'api/v1/calls', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'call_id' => $rows->json()['data'][0]['id'],
            'title' => 'Test call title',
            'content' => 'Test call content',
            'start_dateTime' => '12/1/2019 9:00:00',
            'end_dateTime' => '12/1/2019 10:00:00',
        ];

        // check api with accessToken
        $response = $this->json('PUT', 'api/v1/call/update', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 201);
    }


     /*
     * @test
     *  Test Invite members to Calls api
    */
    public function test_invite_members_to_call_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@calls.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get call_id random from his data
        $rows = $this->json('POST', 'api/v1/calls', ['accessToken' => $login->json()['accessToken']]);

        // Get user_id random
        $members = $this->json('POST', 'api/v1/list/members', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'call_id' => $rows->json()['data'][0]['id'],
            'user_id' => $members->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/call/invite/member', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 201);
    }


     /*
     * @test
     *  Test remove members from Calls api
    */
    public function test_remove_members_from_call_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@calls.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get call_id random from his data
        $rows = $this->json('POST', 'api/v1/calls', ['accessToken' => $login->json()['accessToken']]);

        // Get user_id random
        $members = $this->json('POST', 'api/v1/list/members', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'call_id' => $rows->json()['data'][0]['id'],
            'user_id' => $members->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/call/remove/member', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }

    /*
     * @test
     *  Test Destroy Calls api
    */
    public function test_destroy_call_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@calls.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get call_id random from his data
        $rows = $this->json('POST', 'api/v1/calls', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'call_id' => $rows->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('DELETE', 'api/v1/call/destroy', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }

}
