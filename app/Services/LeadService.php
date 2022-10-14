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
        $lead = $this->repository->create($input);

        $lead->cakes()->syncWithoutDetaching($input['cakes']);

        return new LeadResource($lead);
    }

    public function findOrFail(int $id): LeadResource
    {
        return new LeadResource($this->repository->findOrFail($id));
    }

    public function update($input, $id): LeadResource
    {
        $lead = $this->repository->update($input, $id);
        $lead->cakes()->sync($input['cakes']);
        return new LeadResource($lead);
    }

    public function delete($id): LeadResource
    {
        return new LeadResource($this->repository->delete($id));
    }
}
