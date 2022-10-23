<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Http\Resources\LeadCollection;
use App\Http\Resources\LeadResource;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\LeadCollection
     */
    public function index(): LeadCollection
    {
        $leads = Lead::with('cakes')->get();

        return LeadCollection::make($leads)
        ->additional([
            'success' => true,
            'message' => __('lead.index')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LeadRequest  $request
     * @return App\Http\Resources\LeadResource
     */
    public function store(LeadRequest $request): LeadResource
    {
        $payload        = $request->validated();

        $lead           = Lead::whereEmail($payload['email'])->withTrashed()->first();

        if(empty($lead)) {
            $lead       = Lead::create($payload);
        }
        elseif ($lead->trashed()) {
            $lead->restore();
        }

        if(isset($payload['cakes'])) {
            $lead->cakes()->syncWithoutDetaching($payload['cakes']);
        }

        return LeadResource::make($lead)
        ->additional([
            'success' => true,
            'message' => __('lead.store')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Lead $lead
     * @return App\Http\Resources\LeadResource
     */
    public function show(Lead $lead)
    {
        return LeadResource::make($lead->load('cakes'))
        ->additional([
            'success' => true,
            'message' => __('lead.store')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LeadRequest  $request
     * @param  App\Models\Lead $lead
     * @return App\Http\Resources\LeadResource
     */
    public function update(LeadRequest $request, Lead $lead): LeadResource
    {
        $payload = $request->validated();
        $lead->update($payload);

        if(isset($payload['cakes'])) {
            $lead->cakes()->sync($payload['cakes']);
        }

        return LeadResource::make($lead->load('cakes'))
        ->additional([
            'success' => true,
            'message' => __('lead.update')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Lead $lead
     * @return App\Http\Resources\LeadResource
     */
    public function destroy(Lead $lead): LeadResource
    {
        $lead->delete();
        return LeadResource::make($lead)
        ->additional([
            'success' => true,
            'message' => __('lead.destroy')
        ]);
    }

}
