<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Requests\ReadingIntervalRequest;
use App\Models\ReadingInterval;
use App\Repositories\ReadingIntervalRepository;
use App\Resources\ReadingIntervalResource;
use App\Services\BookPagesCalculatorService;
use App\Services\SmsService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadingIntervalController extends Controller
{
    protected ReadingIntervalRepository $repository;

    private BookPagesCalculatorService $bookPagesCalculatorService;
    private SmsService $smsService;

    public function __construct(
        ReadingIntervalRepository $repository,
        BookPagesCalculatorService $bookPagesCalculatorService,
        SmsService $smsService,
    ) {
        $this->bookPagesCalculatorService = $bookPagesCalculatorService;
        $this->repository = $repository;
        $this->smsService = $smsService;
    }

    public function store(ReadingIntervalRequest $request): JsonResponse
    {
        $readingInterval = $this->repository->create($request->validated());
        if ($readingInterval instanceof ReadingInterval) {
            $this->bookPagesCalculatorService->calculatePagesForBook($request->getBookId());

            $this->smsService->send($request->getUserId());

            return response()->json(ReadingIntervalResource::make($readingInterval), Response::HTTP_CREATED);
        }

        return response()->json($readingInterval['message'], $readingInterval['code']);
    }
}
