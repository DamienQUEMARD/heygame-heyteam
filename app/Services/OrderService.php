<?php

namespace App\Services;

use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class OrderService {
    public function __construct(
        protected OrderRepository $orderRepository,
        protected ProductService $productService,
        protected Auth $auth
    )
    {
    }

    public function create(array $data): Order
    {
        $user = $this->auth::user();

        // Create order
        $order =  $this->orderRepository->create($user);

        // Create orderlines
        foreach($data['products'] as $product) {
            $foundProduct = $this->productService->find($product['id']);

            $order->orderLines()->create([
                'order_id' => $order->id,
                'product_id' => $foundProduct->id,
                'quantity' => $product['quantity']
            ]);

            // Update prices
            $order->price_without_vat += $foundProduct->price_without_vat * $product['quantity'];
            $order->price_with_vat += $foundProduct->price_with_vat * $product['quantity'];
        };

        // Save
        $order->save();

        return $order;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Order
    {
        // Update order
        $order =  $this->orderRepository->update($data, $id);

        // Create a notification
        $owner =  $order->user;
        $owner->notify(new OrderStatusNotification($order));

        return $order;
    }
}
