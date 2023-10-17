<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Supports\CreateSupportDTO;
use App\Dtos\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supports = $this->supportService->paginate(
            $request->get('page', 1),
            $request->get('per_page', 1),
            $request->get('filter', null),
        );

        return SupportResource::collection($supports->items())
            ->additional([
                'meta' => pagination($supports),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupportRequest $request)
    {
        $support = $this->supportService->create(CreateSupportDTO::makeFromRequest($request));

        return new SupportResource($support);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $support = $this->supportService->findOne($id);
        if (! $support) {
            return response()->json([
                'error' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupportRequest $request)
    {
        $support = $this->supportService->update(UpdateSupportDTO::makeFromRequest($request));
        if (! $support) {
            return response()->json([
                'error' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $support = $this->supportService->findOne($id);
        if (! $support) {
            return response()->json([
                'error' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->supportService->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
