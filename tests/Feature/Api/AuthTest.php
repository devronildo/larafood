<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Str;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     *  Test Validation Auth
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     *  Test Auth with  client fake
     *
     * @return void
     */
    public function testAuthClientFake()
    {
        $payload = [
             'email'  => 'faketeste@gmail.com',
             'password' => '123456',
             'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
                         ->assertExactJson([
                              'message' => trans('messages.invalid_credentials')
                         ]);
    }

     /**
     *  Test Auth Success
     *
     * @return void
     */
    public function testAuthSuccess()
    {
        $client = factory(Client::class)->create();

         $payload = [
            'email'  => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);

    }

     /**
     *   Error Get Me
     *
     * @return void
     */
    public function testErrorGetMe()
    {

        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);


    }

     /**
     *   Error Get Me
     *
     * @return void
     */
    public function testGetMe()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}",
        ]);



        $response->assertStatus(200)
                      ->assertExactJson([
                          'data' => [
                              'name' => $client->name,
                              'email' => $client->email
                          ]
                      ]);


    }

      /**
     *    Logout
     *
     * @return void
     */
    public function testLogout()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);



        $response->assertStatus(204);



    }


}
