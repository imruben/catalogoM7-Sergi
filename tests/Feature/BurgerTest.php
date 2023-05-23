<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class BurgerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getAll()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->get('http://localhost:8000/api/burgir');

        $response->assertOk();
    }
    public function test_store()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->post('http://localhost:8000/api/burgir', [
            'name' => 'burgir',
            'price' => 2,
        ]);

        $response->assertOk();
    }
    public function test_update()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->put('http://localhost:8000/api/burgir', [
            'id' => '2',
            'name' => 'burgir',
        ]);

        $response->assertOk();
    }
    public function test_delete()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->delete('http://localhost:8000/api/burgir/2');

        $response->assertOk();
    }
}
