<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class MeetingTest extends TestCase
{
    /**
     * @test
     *  Test Meetings api
    */
    public function test_meetings_api()
    {
        // Create User
        $data = [
            'name' => 'Test',
            'email' => 'test@meetings.com',
            'password' => 'password'
        ];

        // Send register request
        $register = $this->json('POST', 'api/v1/register', $data);

        // Assert it was successful
        $register->assertStatus(200);

        // Store accessToken from register
        $array = ['accessToken'=>$register->json()['accessToken']];

        // Check api with accessToken
        $response = $this->json('POST', 'api/v1/meetings', $array);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }


    /*
     * @test
     *  Test Create Meetings api
    */
    public function test_create_meeting_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@meetings.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'title' => 'Test meeting title',
            'content' => 'Test meeting content',
            'location' => 'Cairo, Egypt',
            'start_dateTime' => '12/1/2019 9:00:00',
            'end_dateTime' => '12/1/2019 10:00:00',
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/meeting/create', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 201);
    }


     /*
     * @test
     *  Test Edit Meetings api
    */
    public function test_edit_meeting_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@meetings.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get meeting_id random from his data
        $rows = $this->json('POST', 'api/v1/meetings', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'meeting_id' => $rows->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/meeting/edit', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }

     /*
     * @test
     *  Test Update Meetings api
    */
    public function test_update_meeting_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@meetings.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get meeting_id random from his data
        $rows = $this->json('POST', 'api/v1/meetings', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'meeting_id' => $rows->json()['data'][0]['id'],
            'title' => 'Test meeting title',
            'content' => 'Test meeting content',
            'location' => 'Cairo, Egypt',
            'start_dateTime' => '12/1/2019 9:00:00',
            'end_dateTime' => '12/1/2019 10:00:00',
        ];

        // check api with accessToken
        $response = $this->json('PUT', 'api/v1/meeting/update', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 201);
    }


     /*
     * @test
     *  Test Invite members to Meetings api
    */
    public function test_invite_members_to_meeting_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@meetings.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get meeting_id random from his data
        $rows = $this->json('POST', 'api/v1/meetings', ['accessToken' => $login->json()['accessToken']]);

        // Get user_id random
        $members = $this->json('POST', 'api/v1/list/members', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'meeting_id' => $rows->json()['data'][0]['id'],
            'user_id' => $members->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/meeting/invite/member', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 201);
    }


     /*
     * @test
     *  Test remove members from Meetings api
    */
    public function test_remove_members_from_meeting_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@meetings.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get meeting_id random from his data
        $rows = $this->json('POST', 'api/v1/meetings', ['accessToken' => $login->json()['accessToken']]);

        // Get user_id random
        $members = $this->json('POST', 'api/v1/list/members', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'meeting_id' => $rows->json()['data'][0]['id'],
            'user_id' => $members->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('POST', 'api/v1/meeting/remove/member', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }

    /*
     * @test
     *  Test Destroy Meetings api
    */
    public function test_destroy_meeting_api()
    {
        // Attempt login
        $login = $this->json('POST', 'api/v1/login', [
            'email' => 'test@meetings.com',
            'password' => 'password',
        ]);

        // Assert it was successful and a token was received
        $login->assertStatus(200);

        // Get meeting_id random from his data
        $rows = $this->json('POST', 'api/v1/meetings', ['accessToken' => $login->json()['accessToken']]);

        // Store accessToken from login
        $data = [
            'accessToken'=> $login->json()['accessToken'],
            'meeting_id' => $rows->json()['data'][0]['id']
        ];

        // check api with accessToken
        $response = $this->json('DELETE', 'api/v1/meeting/destroy', $data);

        // Check if statusCode equal 200 then everything fine 
        $this->assertEquals($response->json()['statusCode'], 200);
    }

}
