<?php

namespace App\Http\Controllers\Api;

use App\Models\Cake;
use Illuminate\Http\Request;
use App\Services\CakeService;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCakeRequest;
use App\Http\Requests\UpdateCakeRequest;
use Illuminate\Http\JsonResponse;

class CakeController extends Controller
{
    public function __construct(private CakeService $cakeService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $cakes = $this->cakeService->getAll($request);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
        return $this->sendResponse($cakes, 'Bolos recuperados com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCakeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCakeRequest $request): JsonResponse
    {
        try {
            $payload    = $request->validated();
            $cake       = $this->cakeService->create($payload);

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
        return $this->sendResponse($cake, 'Bolo salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Cake $cake): JsonResponse
    {
        try {
            return $this->sendResponse($cake, 'Bolo recuperado com sucesso');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCakeRequest  $request
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCakeRequest $request, Cake $cake): JsonResponse
    {
        try {
            $payload = $request->validated();
            $cake = $this->cakeService->update($payload, $cake->id);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }

        return $this->sendResponse($cake, 'Bolo atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Cake $cake): JsonResponse
    {
        try {
            $this->cakeService->delete($cake);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }

        return $this->sendSuccess('Bolo deletado com sucesso');
    }

}
