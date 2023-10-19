<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Supports\CreateSupportDTO;
use App\Dtos\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
    public function index(Request $request): JsonResource
    {
        $supports = $this->supportService->paginate(
            $request->get('page', 1),
            $request->get('per_page', 10),
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
    public function store(StoreUpdateSupportRequest $request): JsonResponse
    {
        $support = $this->supportService->create(CreateSupportDTO::makeFromRequest($request));

        return (new SupportResource($support))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResource|JsonResponse
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
    public function update(StoreUpdateSupportRequest $request): JsonResource|JsonResponse
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
    public function destroy(string $id): JsonResponse
    {
        $support = $this->supportService->findOne($id);
        if (! $support) {
            return response()->json([
                'error' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        $result = $this->supportService->delete($id);
        if (! $result) {
            return response()->json([
                'error' => 'Unauthorized',
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
