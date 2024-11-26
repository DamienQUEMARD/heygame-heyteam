<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderRepository {
    public function create(User $user): Order
    {
        return Order::create(
            [
                'user_id' => $user->id,
                'status' => 'pending',
                'price_without_vat' => 0,
                'price_with_vat' => 0
            ]
        );
    }

    /**
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Order
    {
        $product = Order::findOrFail($id);
        $product->update($data);
        return $product;
    }
}
