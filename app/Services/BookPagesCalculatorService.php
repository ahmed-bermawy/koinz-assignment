<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Repositories\ReadingIntervalRepository;

class BookPagesCalculatorService
{
    private BookRepository $bookRepository;
    private ReadingIntervalRepository $readingIntervalRepository;

    public function __construct(
        BookRepository $bookRepository,
        ReadingIntervalRepository $readingIntervalRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->readingIntervalRepository = $readingIntervalRepository;
    }

    public function calculatePagesForBook($bookId): void
    {
        $book = $this->bookRepository->getDetail($bookId);

        if ($book->pages !== $book->num_of_read_pages) {
            $bookPagesReadInterval = $this->readingIntervalRepository->getBookPagesReadInterval($bookId);
            $pages = [];

            foreach ($bookPagesReadInterval as $readingInterval) {
                for ($i = $readingInterval->start_page; $i < $readingInterval->end_page; $i++) {
                    if (! in_array($i, $pages)) {
                        $pages[] = $i;
                    }
                }
            }

            $this->bookRepository->updateNumOfReadPages($book, count($pages));
        }
    }
}
