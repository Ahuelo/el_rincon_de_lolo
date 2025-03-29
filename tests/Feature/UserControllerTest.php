<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_create_user()
    {
        $data = [
            'name'=> 'Pedro Pérez',
            'email' => 'correo@correo.com',
            'password' => '12345678'
        ];

        $response = $this->post('/api/user', $data );
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(
            [ 
                'message',
                'data'=>
                [
                    'name',
                    'email',
                    'updated_at',
                    'created_at',
                    'id'
                ]

        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Pedro Pérez',
            'email' => 'correo@correo.com'
        ]);
    }

    public function test_user_create_error()
    {
        $data = 
        [
            'name' => fake()->name(),
            'email' =>  fake()->email(),
        ];
        
        $response = $this->post("/api/user", $data, ['Accept'=> 'application/json']);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}

