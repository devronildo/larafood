<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Order;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     *  Test Error Create New Evaluation
     *
     * @return void
     */
    public function TestErrorCreateEvaluation()
    {
        $order = 'fake_value';

        $response = $this->getJson("/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }

     /**
     *  Test Create New Evaluation
     *
     * @return void
     */
    public function TestCreateEvaluation()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $order = $client->orders()->save(factory(Order::class)->make());

        $payload = [
            'stars' => 5,
            'comment' => Str::random(10)
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->getJson("/auth/v1/orders/{$order}/evaluations", $payload, $headers);

        $response->assertStatus(200);
    }
}
