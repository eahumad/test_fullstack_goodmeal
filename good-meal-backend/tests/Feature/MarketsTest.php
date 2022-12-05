<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

use Illuminate\Http\UploadedFile;



class MarketsTest extends TestCase {
  use WithFaker;

  private $responseMustHaveArray = ['name', 'id', 'address', 'latitude', 'longitude', 'created_at', 'updated_at', 'deleted_at','logo','cover','logo_url','cover_url'];

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
        $json->hasAll( $this->responseMustHaveArray )
      )
    );
  }


  public function test_getExisting() {
    $payload = $this->createCorrectPayload();
    $responsePost = $this->postJson('/api/markets', $payload);

    $response = $this->getJson('/api/markets/'. $responsePost->original['id']);

    $response->assertStatus(200);
    $response->assertJson(
      fn (AssertableJson $json) =>
      $json->hasAll( $this->responseMustHaveArray )
        ->where('name', $payload['name'])
        ->etc()
    );
  }

  public function test_getNotExisting() {
    $payload = $this->createCorrectPayload();
    $responsePost = $this->postJson('/api/markets', $payload);

    $response = $this->getJson('/api/markets/'. $responsePost->original['id']+1);

    $response->assertStatus(404);
  }

  public function test_updateExisting() {
    $payload = $this->createCorrectPayload();
    $responsePost = $this->postJson('/api/markets', $payload);
    $payload = $this->createCorrectPayload();

    $response = $this->putJson('/api/markets/'.$responsePost->original['id'], $payload);

    $response->assertStatus(200);
  }

  public function test_updateNotPayload() {
    $payload = $this->createCorrectPayload();
    $responsePost = $this->postJson('/api/markets', $payload);
    $response = $this->putJson('/api/markets/'.$responsePost->original['id']);

    $response->assertStatus(422);
    $response->assertSee('The name field is required');
  }

  public function test_updateNotExisting() {
    $payload = $this->createCorrectPayload();
    $responsePost = $this->postJson('/api/markets', $payload);
    $payload['name'].= 'a';



    $response = $this->putJson('/api/markets/'.$responsePost->original['id']+1, $payload);

    $response->assertStatus(404);
  }


  private function createCorrectPayload() : Array {


    $logoName = 'logo_'.rand(1,3).'.png';
    $coverName = 'logo_'.rand(1,3).'.jpeg';
    $path = dirname(__FILE__).'/../files/';



    $payload = [
      'name'      => $this->faker->unique()->company,
      'address'   => $this->faker->address,
      'latitude'  => $this->faker->latitude(-35.79, -35.71),
      'longitude'  => $this->faker->longitude(-71.67, -71.47),
      'logo' => UploadedFile::fake()->create('file.png'),
      'cover' => UploadedFile::fake()->create('file.jpeg'),
    ];



    return $payload;
  }
}
