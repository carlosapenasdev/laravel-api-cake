<?php

namespace Tests\Feature;

use App\Models\Cake;
use Database\Seeders\CakeSeeder;
use Database\Seeders\LeadSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CakeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_cake()
    {
        $cake = Cake::factory()->make()->toArray();

        $response = $this->postJson(
            'cake',
            $cake
        );

        $response->assertDontSee('errors')->assertStatus(201)
            ->assertJson(['success' => true]);
    }

    public function test_read_cake()
    {
        $cake = Cake::factory()->make();

        $this->postJson(
            'cake',
            $cake->toArray()
        );

        $response = $this->getJson(
            '/cake/'.$cake->id,
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_update_cake()
    {
        $cake = Cake::factory()->make();

        $editedCake = Cake::factory()->make()->toArray();

        $responsePost = $this->postJson(
            'cake',
            $cake->toArray(),

        );

        $cake = $responsePost['data'];

        $response = $this->putJson(
            '/cake/'.$cake['id'],
            $editedCake
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_delete_cake()
    {
        $cake = Cake::factory()->make();

        $responsePost = $this->postJson(
            'cake',
            $cake->toArray()
        );

        $cake = $responsePost['data'];

        $response = $this->deleteJson(
            '/cake/'.$cake['id'],
            [],
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_list_cake()
    {
        $cakes = Cake::factory(2)->create();

        $response = $this->get(
            'cake'
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_cake_has_lead()
    {
        $this->seed(CakeSeeder::class);

        $response = $this->get(
            'cake'
        );
        $this->assertGreaterThanOrEqual(1, $response->getOriginalContent()->first()->leads->count());
    }

    public function test_cake_validation()
    {
        $cake = Cake::factory()->make()->toArray();
        $cake['name'] = implode(' ', $this->faker->words(100));

        $response = $this->postJson(
            'cake',
            $cake
        );

        $response
            ->assertSee('errors')
            ->assertStatus(422);
    }
}
