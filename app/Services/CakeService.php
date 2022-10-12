<?php

namespace App\Services;

use App\Http\Resources\CakeResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Cake;
use App\Repositories\CakeRepository;
use Illuminate\Database\Eloquent\Collection;

class CakeService
{

    public function __construct(private CakeRepository $repository)
    {
    }

    public function create(array $input): CakeResource
    {
        return new CakeResource($this->repository->create($input));
    }

    public function findOrFail(int $cake): CakeResource
    {
        return new CakeResource($this->repository->findOrFail($cake));
    }
}
