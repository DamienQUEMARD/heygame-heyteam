<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function create(CreateOrderRequest $request)
    {
        $order = $this->orderService->create($request->all());
        return response()->json(['order' => $order], 201);
    }

    public function update(UpdateOrderRequest $request, int $id)
    {
        try {
            $order = $this->orderService->update($request->all(), $id);
            return response()->json(['order' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }
}
