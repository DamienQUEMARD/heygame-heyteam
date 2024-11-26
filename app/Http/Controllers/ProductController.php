<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function list(): JsonResponse
    {
        /** @var Product[] $products */
        $products = $this->productService->all();

        return response()->json(['products' => $products], 200);
    }

    public function create(CreateProductRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        if (! $user->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $product = $this->productService->create($request->all());

        return response()->json(['product' => $product], 201);
    }

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        if (! $user->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $product = $this->productService->update($request->all(), $id);
            return response()->json(['product' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function delete(int $id): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        if (! $user->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $this->productService->delete($id);
            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json([
        ], 204);
    }
}
