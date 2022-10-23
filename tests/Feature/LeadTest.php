<?php

namespace Tests\Feature;

use App\Models\Lead;
use Database\Seeders\LeadSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_lead()
    {
        $lead           = Lead::factory()->make()->toArray();

        $response = $this->postJson(
            'lead',
            $lead
        );

        $response->assertDontSee('errors')->assertStatus(201)
            ->assertJson(['success' => true]);
    }

    public function test_read_lead()
    {
        $lead = Lead::factory()->make();

        $this->postJson(
            'lead',
            $lead->toArray()
        );

        $response = $this->getJson(
            '/lead/'.$lead->id,
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_update_lead()
    {
        $lead = Lead::factory()->make();

        $editedLead = Lead::factory()->make()->toArray();

        $responsePost = $this->postJson(
            'lead',
            $lead->toArray(),

        );

        $lead = $responsePost['data'];

        $response = $this->putJson(
            '/lead/'.$lead['id'],
            $editedLead
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_delete_lead()
    {
        $lead = Lead::factory()->make();

        $responsePost = $this->postJson(
            'lead',
            $lead->toArray()
        );

        $lead = $responsePost['data'];

        $response = $this->deleteJson(
            '/lead/'.$lead['id'],
            [],
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_list_lead()
    {
        $leads = Lead::factory(2)->create();

        $response = $this->get(
            'lead'
        );

        $response->assertDontSee('errors')->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_lead_has_cake()
    {
        $this->seed(LeadSeeder::class);

        $response = $this->get(
            'lead'
        );

        $this->assertGreaterThanOrEqual(1, $response->getOriginalContent()->first()->cakes->count());
    }

    public function test_lead_validation()
    {
        $lead = Lead::factory()->make()->toArray();
        $lead['name'] = implode(' ', $this->faker->words(300));

        $response = $this->postJson(
            'lead',
            $lead
        );

        $response
            ->assertSee('errors')
            ->assertStatus(422);
    }
}
