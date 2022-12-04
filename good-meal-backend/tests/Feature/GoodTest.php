<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Support\Facades\Log;

class GoodTest extends TestCase {
  use WithFaker;


  public function test_saveNoData() {
    $response = $this->json('post', '/api/goods');

    $response->assertStatus(422);
    $response->assertSee('The name field is required');
  }

  public function test_saveDuplicatedName() {
    $payload = $this->createCorrectPayload();
    $this->postJson('/api/goods',$payload);

    $response = $this->postJson('/api/goods',$payload);

    $response->assertStatus(422);
    $response->assertSee('The name has already been taken');
  }

  public function test_saveCorrect() {
    $payload = $this->createCorrectPayload();
    $response = $this->postJson('/api/goods',$payload);

    $response->assertStatus(201);
  }

  public function test_list() {
    $payload = $this->createCorrectPayload();
    $response = $this->postJson('/api/goods',$payload);

    $response = $this->getJson('/api/goods');

    $response->assertStatus(200);

    $response->assertJson(
      fn (AssertableJson $json) =>
      $json->first(
        fn (AssertableJson $json) =>
        $json->hasAll(['id', 'name', 'brand', 'category','created_at','updated_at','deleted_at'])
      )
    );
  }

  private function createCorrectPayload() : Array {
    $categories = ['Snack','Lácteos y quesos','Congelados','Bebidas y jugos','Alcohol','Ropa'];;
    return [
      'name' => $this->faker->unique()->words(rand(1,4),true),
      'brand' => $this->faker->words(rand(1,2), true),
      'category' => $categories[ rand(0, count($categories) - 1) ],
    ];
  }
}
