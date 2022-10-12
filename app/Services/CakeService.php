<?php

namespace App\Services;

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

    public function create(array $input): Model
    {
        return $this->repository->create($input);
    }
}
