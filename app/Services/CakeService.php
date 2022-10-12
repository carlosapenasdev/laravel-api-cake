<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Cake;
use Illuminate\Database\Eloquent\Collection;

class CakeService
{

    public function create(array $input): Model
    {
        dd('asd', $input);
    }
}
