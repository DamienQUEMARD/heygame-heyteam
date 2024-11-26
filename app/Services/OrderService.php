<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
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
        $order =  $this->orderRepository->create($user);

        foreach($data['products'] as $product) {
            $foundProduct = $this->productService->find($product['id']);

            $order->orderLines()->create([
                'order_id' => $order->id,
                'product_id' => $foundProduct->id,
                'quantity' => $product['quantity']
            ]);

            $order->price_without_vat += $foundProduct->price_without_vat * $product['quantity'];
            $order->price_with_vat += $foundProduct->price_with_vat * $product['quantity'];
        };

        $order->save();

        return $order;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Order
    {
        return $this->orderRepository->update($data, $id);
    }
}
