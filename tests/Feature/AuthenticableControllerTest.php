<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthenticableControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_logins_users()
    {
        $user = User::factory()->create();
        $data = 
        [
            'email' => $user->email,
            'password' => "password"
        ];
        $response = $this->post('/api/login', $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(
            [
                'message',
                'data' =>[
                    'token'
                ]
        ]);
    }
}
