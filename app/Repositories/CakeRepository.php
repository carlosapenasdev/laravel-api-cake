<?php

namespace App\Repositories;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class CakeRepository
{
    protected $model = Cake::class;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function getAll(): Collection
    {
        return $this->model->with('leads')->get();
    }

    public function create(array $input): Model
    {
        return $this->model->create($input);
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function update($input, $id): Model
    {
        $model = $this->findOrFail($id);
        $model->update($input);
        return $model;
    }

    public function delete($id): Model
    {
        $model = $this->findOrFail($id);
        $model->destroy($id);
        return $model;
    }
}
