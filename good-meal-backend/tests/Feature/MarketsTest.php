<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
      'name'      => $this->faker->unique()->company ,
      'address'   => $this->faker->address,
      'latitude'  => 123,
      'longitude'  => 123,
    ];

    $response = $this->postJson('/api/markets', $payload);

    $response->assertStatus(422);
    $response->assertSee('The latitude format is invalid.');
  }

  public function test_saveCorrect() {
    $payload = [
      'name'      => $this->faker->unique()->company ,
      'address'   => $this->faker->address,
      'latitude'  => $this->faker->latitude(-35.79,-35.71),
      'longitude'  => $this->faker->longitude(-71.67, -71.47),
    ];

    $response = $this->postJson('/api/markets', $payload);

    $response->assertStatus(201);
  }
}