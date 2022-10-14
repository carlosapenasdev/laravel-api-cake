<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Services\LeadService;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    public function __construct(private LeadService $leadService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $leads = $this->leadService->getAll();
        } catch (Exception $e) {
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(
            [
                'success' => true,
                'message' => __('lead.index'),
                'data'    => $leads
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeadRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLeadRequest $request): JsonResponse
    {
        try {
            $payload    = $request->validated();
            $lead       = $this->leadService->create($payload);

        } catch (Exception $e) {
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(
            [
                'success' => true,
                'message' => __('lead.store'),
                'data'    => $lead
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $lead
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($lead): JsonResponse
    {
        try {
            $lead = $this->leadService->findOrFail($lead);
            return response()->json(
                [
                    'success' => true,
                    'message' => __('lead.show'),
                    'data'    => $lead
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
     * @param  \App\Http\Requests\UpdateLeadRequest  $request
     * @param  int  $lead
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLeadRequest $request, $lead): JsonResponse
    {
        try {
            $payload = $request->validated();
            $lead = $this->leadService->update($payload, $lead);
        } catch (Exception $e) {
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(
            [
                'success' => true,
                'message' => __('lead.update'),
                'data'    => $lead
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $lead
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($lead): JsonResponse
    {
        try {
            $lead = $this->leadService->delete($lead);
        } catch (Exception $e) {
            return response()->json([ 'success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(
            [
                'success' => true,
                'message' =>  __('lead.destroy'),
                'data'    => $lead
            ],
            200
        );
    }

}
