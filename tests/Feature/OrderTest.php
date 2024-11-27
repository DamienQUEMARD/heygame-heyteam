<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_an_order(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/api/orders', [
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => 1,
                ],
            ]]);

        $response->assertStatus(201);
    }

    public function test_a_user_cannot_update_an_order(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(
            [
                'user_id' => $user->id,
            ]
        );

        $this->actingAs($user);

        $response = $this->put("/api/orders/{$order->id}/status", [
            'status' => 'completed',
        ]);

        $response->assertStatus(401);
    }

    public function test_a_admin_can_update_an_order(): void
    {
        $user = User::factory()->create();
        $admin = User::factory()->create(
            [
                'role' => 'admin',
            ]
        );

        $order = Order::factory()->create(
            [
                'user_id' => $user->id,
            ]
        );

        $this->actingAs($admin);

        $response = $this->put("/api/orders/{$order->id}/status", [
            'status' => 'completed',
        ]);

        $response->assertStatus(200);
    }
}
