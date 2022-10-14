<?php

namespace App\Repositories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class LeadRepository
{
    protected $model = Lead::class;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function getAll(): Collection
    {
        return $this->model->with('cakes')->get();
    }

    public function create(array $input): Model
    {
        $lead = $this->findByAtt('email', $input['email']);

        if(empty($lead)) {
            $lead = $this->model->create($input);
        }
        elseif ($lead->trashed()) {
            $lead->restore();
            $lead->cakes()->detach();
        }

        return $lead;
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->with('cakes')->findOrFail($id);
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

    public function findByAtt($att, $value): ?Model
    {
        return $this->model->where($att, $value)->withTrashed()->first();
    }
}
