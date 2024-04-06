<?php

namespace App\Rules;

use App\Repositories\BookRepository;
use Illuminate\Contracts\Validation\Rule;

class ValidEndPage implements Rule
{
    protected int $bookId;
    private BookRepository $bookRepository;

    public function __construct(int $bookId, BookRepository $bookRepository)
    {
        $this->bookId = $bookId;
        $this->bookRepository = $bookRepository;
    }

    public function passes($attribute, $value): bool
    {
        $book = $this->bookRepository->getDetail($this->bookId);
        if (!$book) {
            return false;
        }
        return $value <= $book->pages;
    }

    public function message(): string
    {
        return 'The end page must be less than or equal to the total number of pages in the book.';
    }
}