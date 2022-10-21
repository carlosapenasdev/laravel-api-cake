<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CakeRequest;
use App\Http\Resources\CakeCollection;
use App\Http\Resources\CakeResource;
use App\Models\Cake;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\CakeCollection
     */
    public function index(): CakeCollection
    {
        $cakes = Cake::with('leads')->get();

        return CakeCollection::make($cakes)
        ->additional([
            'success' => true,
            'message' => __('cake.index')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CakeRequest  $request
     * @return App\Http\Resources\CakeResource
     */
    public function store(CakeRequest $request): CakeResource
    {
        $payload    = $request->validated();
        $cake       = Cake::create($payload);

        return CakeResource::make($cake)
        ->additional([
            'success' => true,
            'message' => __('cake.store')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Cake $cake
     * @return App\Http\Resources\CakeResource
     */
    public function show(Cake $cake)
    {
        return CakeResource::make($cake->load('leads'))
        ->additional([
            'success' => true,
            'message' => __('cake.store')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CakeRequest  $request
     * @param  App\Models\Cake $cake
     * @return App\Http\Resources\CakeResource
     */
    public function update(CakeRequest $request, Cake $cake): CakeResource
    {
        $payload = $request->validated();
        $cake->update($payload);

        return CakeResource::make($cake)
        ->additional([
            'success' => true,
            'message' => __('cake.update')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Cake $cake
     * @return App\Http\Resources\CakeResource
     */
    public function destroy(Cake $cake): CakeResource
    {
        $cake->delete();
        return CakeResource::make($cake)
        ->additional([
            'success' => true,
            'message' => __('cake.destroy')
        ]);
    }

}
