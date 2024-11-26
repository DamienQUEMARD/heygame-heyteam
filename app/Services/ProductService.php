<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductService {
    public function __construct(protected ProductRepository $productRepository)
    {
    }

    public function create(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Product
    {
        return $this->productRepository->update($data, $id);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function delete(int $id): void
    {
        $this->productRepository->delete($id);
    }

    /**
     * @return Collection<Product>
     */
    public function all(): Collection
    {
        return $this->productRepository->all();
    }
}
