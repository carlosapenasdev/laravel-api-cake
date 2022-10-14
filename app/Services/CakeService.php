<?php

namespace App\Services;

use App\Http\Resources\CakeResource;
use App\Repositories\CakeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CakeService
{

    public function __construct(private CakeRepository $repository)
    {
    }

    public function getAll(): AnonymousResourceCollection
    {
        return CakeResource::collection($this->repository->getAll());
    }

    public function create(array $input): CakeResource
    {
        return new CakeResource($this->repository->create($input));
    }

    public function findOrFail(int $id): CakeResource
    {
        return new CakeResource($this->repository->findOrFail($id));
    }

    public function update($input, $id): CakeResource
    {
        return new CakeResource($this->repository->update($input, $id));
    }

    public function delete($id): CakeResource
    {
        return new CakeResource($this->repository->delete($id));
    }
}
