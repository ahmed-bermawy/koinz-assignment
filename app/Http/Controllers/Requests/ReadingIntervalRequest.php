<?php

namespace App\Http\Controllers\Requests;

use App\Repositories\BookRepository;
use App\Rules\ValidEndPage;
use Illuminate\Foundation\Http\FormRequest;

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

    public function getStartPage(): int
    {
        return $this->input('start_page');
    }

    public function getEndPage(): int
    {
        return $this->input('end_page');
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
            'end_page' => ['required', 'numeric', new ValidEndPage($this->getBookId(), $this->bookRepository)],
        ];
    }
}