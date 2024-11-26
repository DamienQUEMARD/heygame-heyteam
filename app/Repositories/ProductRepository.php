<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository {

    /**
     * @return Collection<Product>
     */
    public function all(): Collection {
        return Product::all();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    /**
     * @throws ModelNotFoundException
     */
    public function find(int $id): Product
    {
        return Product::findOrFail($id);
    }
}
