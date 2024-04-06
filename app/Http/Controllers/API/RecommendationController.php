<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class RecommendationController extends Controller
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/recommendations",
     *     tags={"Recommendations"},
     *     summary="Get the most recommended books",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(
     *              type="array",
     *
     *              @OA\Items(
     *                  type="object",
     *
     *                  @OA\Property(property="book_id",type="integer",description="The book ID"),
     *                  @OA\Property(property="book_name", type="string", description="The book name"),
     *                  @OA\Property(property="num_of_read_pages",type="string",description="The book Number of pages")
     *                  )
     *          )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *
     *         @OA\JsonContent(type="string")
     *     )
     * )
     */
    public function getMostRecommended(): JsonResponse
    {
        $bookRecommended = $this->bookRepository->getMostRecommendedBooks();

        return response()->json($bookRecommended, Response::HTTP_OK);
    }
}
