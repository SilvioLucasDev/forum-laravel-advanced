<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Replies\CreateReplyDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService,
        protected ReplySupportService $replySupportService
    ) {
    }

    public function index(string $id): JsonResource|JsonResponse
    {
        $support = $this->supportService->findOne($id);
        if (! $support) {
            return response()->json([
                'error' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }
        $replies = $this->replySupportService->getAllBySupportId($id);

        return ReplySupportResource::collection($replies);
    }

    public function store(StoreReplySupportRequest $request): JsonResponse
    {
        $reply = $this->replySupportService->create(CreateReplyDTO::makeFromRequest($request));

        return (new ReplySupportResource($reply))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(string $id): JsonResponse
    {
        $result = $this->replySupportService->delete($id);
        if (! $result) {
            return response()->json([
                'error' => 'Unauthorized',
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
