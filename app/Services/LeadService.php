<?php

namespace App\Services;

use App\Http\Resources\LeadResource;
use App\Repositories\LeadRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LeadService
{

    public function __construct(private LeadRepository $repository)
    {
    }

    public function getAll(): AnonymousResourceCollection
    {
        return LeadResource::collection($this->repository->getAll());
    }

    public function create(array $input): LeadResource
    {
        return new LeadResource($this->repository->create($input));
    }

    public function findOrFail(int $id): LeadResource
    {
        return new LeadResource($this->repository->findOrFail($id));
    }

    public function update($input, $id): LeadResource
    {
        return new LeadResource($this->repository->update($input, $id));
    }

    public function delete($id): LeadResource
    {
        return new LeadResource($this->repository->delete($id));
    }
}
