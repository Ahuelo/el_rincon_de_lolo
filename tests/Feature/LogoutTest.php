<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_logout()
    {
        $user = User::factory()->create();
        $data = 
        [
            'email' => $user->email,
            'password' => 'password'
        ];
        $response = $this->post('/api/login' , $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(
            [
                'message',
                'data' =>[
                    'token'
                ]
            ]);

        $token = $response['data']['token'];
        //dd($token);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->post('/api/logout');
        //dd($response);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(
            [
                'message',
                //'data' => null
            ]);        
    }

    public function test_logout_sin_token()
    {
        $response = $this->post('/api/logout');
        $response->assertStatus( Response::HTTP_UNAUTHORIZED);
        //dd($response);
        $response->assertJsonStructure(
            [
                'message'
                //'data' => null
            ]);
    }
}