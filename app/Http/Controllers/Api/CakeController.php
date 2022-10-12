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
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Bolos recuperados com sucesso',
                'data'    => $cakes
            ],
            200
        );
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
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Bolo salvo com sucesso',
                'data'    => $cake
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $cake
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($cake): JsonResponse
    {
        try {
            $cake = $this->cakeService->findOrFail($cake);
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Bolo recuperado com sucesso',
                    'data'    => $cake
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
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
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Bolo atualizado com sucesso',
                'data'    => $cake
            ],
            200
        );
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
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return $this->sendSuccess('Bolo deletado com sucesso');
    }

}