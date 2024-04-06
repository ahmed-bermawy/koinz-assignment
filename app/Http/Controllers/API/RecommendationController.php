<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RecommendationController extends Controller
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getMostRecommended(): JsonResponse
    {
        $bookRecommended = $this->bookRepository->getMostRecommendedBooks();

        return response()->json($bookRecommended, Response::HTTP_OK);
    }
}