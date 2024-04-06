<?php

namespace App\Http\Controllers\Requests;

use App\Repositories\BookRepository;
use App\Rules\ValidEndPage;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ReadingIntervalRequest",
 *     type="object",
 *     required={"user_id", "book_id", "start_page", "end_page"},
 *     @OA\Property(property="user_id", type="integer", description="The user ID"),
 *     @OA\Property(property="book_id", type="integer", description="The book ID"),
 *     @OA\Property(property="start_page", type="integer", description="The start page"),
 *     @OA\Property(property="end_page", type="integer", description="The end page"),
 * )
 */
class ReadingIntervalRequest extends FormRequest
{
    private BookRepository $bookRepository;

    public function __construct(
        BookRepository $bookRepository,
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null,

    ) {
        $this->bookRepository = $bookRepository;
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function getBookId(): int
    {
        return $this->input('book_id');
    }

    public function getUserId(): int
    {
        return $this->input('user_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'start_page' => 'required|numeric|min:1',
            'end_page' => ['required', 'numeric', 'gte:start_page', new ValidEndPage($this->getBookId(), $this->bookRepository)],
        ];
    }
}
