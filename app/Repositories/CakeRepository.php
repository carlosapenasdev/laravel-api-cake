<?php

namespace App\Repositories;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Model;

class CakeRepository
{
    protected $model = Cake::class;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function create(array $input): Model
    {
        return $this->model->create($input);
    }

    public function findOrFail(int $cake): Model
    {
        return $this->model->findOrFail($cake);
    }
}
