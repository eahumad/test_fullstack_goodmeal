<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Support\Facades\Log;


class MarketsTest extends TestCase {
  use WithFaker;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function test_saveNoData() {

    $response = $this->json('post', '/api/markets');

    $response->assertStatus(422);
    $response->assertSee('The name field is required');
  }

  public function test_saveIncorrectLatitudeLongitude() {
    $payload = [
      'name'      => $this->faker->unique()->company,
      'address'   => $this->faker->address,
      'latitude'  => 123,
      'longitude'  => 123,
    ];

    $response = $this->postJson('/api/markets', $payload);

    $response->assertStatus(422);
    $response->assertSee('The latitude format is invalid.');
  }

  public function test_saveCorrect() {
    $payload = $this->createCorrectPayload();

    $response = $this->postJson('/api/markets', $payload);

    $response->assertStatus(201);
  }


  public function test_list() {
    $response = $this->getJson('/api/markets');

    $response->assertStatus(200);

    $response->assertJson(
      fn (AssertableJson $json) =>
      $json->first(
        fn (AssertableJson $json) =>
        $json->hasAll(['name', 'id', 'address', 'latitude', 'longitude', 'created_at', 'updated_at', 'deleted_at'])
      )
    );
  }


  public function test_getExisting() {
    $payload = $this->createCorrectPayload();
    $responsePost = $this->postJson('/api/markets', $payload);

    $response = $this->getJson('/api/markets/'. $responsePost->original->id);

    $response->assertStatus(200);
    $response->assertJson(
      fn (AssertableJson $json) =>
      $json->hasAll(['name', 'id', 'address', 'latitude', 'longitude', 'created_at', 'updated_at', 'deleted_at'])
        ->where('name', $payload['name'])
        ->etc()
    );
  }

  public function test_getNotExisting() {
    $payload = $this->createCorrectPayload();
    $responsePost = $this->postJson('/api/markets', $payload);

    $response = $this->getJson('/api/markets/'. $responsePost->original->id+1);

    $response->assertStatus(404);
  }


  private function createCorrectPayload() : Array {
    $payload = [
      'name'      => $this->faker->unique()->company,
      'address'   => $this->faker->address,
      'latitude'  => $this->faker->latitude(-35.79, -35.71),
      'longitude'  => $this->faker->longitude(-71.67, -71.47),
    ];

    return $payload;
  }
}
