<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Requests\ReadingIntervalRequest;
use App\Models\ReadingInterval;
use App\Repositories\ReadingIntervalRepository;
use App\Resources\ReadingIntervalResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ReadingIntervalController extends Controller
{

    protected ReadingIntervalRepository $repository;

    public function __construct(
        ReadingIntervalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(ReadingIntervalRequest $request): JsonResponse
    {
        $readingInterval = $this->repository->create($request->validated());
        if ($readingInterval instanceof ReadingInterval) {
            return response()->json(ReadingIntervalResource::make($readingInterval), Response::HTTP_CREATED);
        }

        return response()->json($readingInterval['message'], $readingInterval['code']);
    }

}