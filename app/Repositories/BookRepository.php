<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookRepository
{
    public function getDetail(int $id)
    {
        return Book::find($id);
    }

    public function getMostRecommendedBooks()
    {
        return Book::select('id as book_id', 'title as book_name', 'num_of_read_pages')
            ->where('num_of_read_pages', '>', 0)
            ->orderBy('num_of_read_pages', 'desc')
            ->limit(5)
            ->get();
    }

    public function updateNumOfReadPages($book, $numOfReadPages): void
    {
        try {
            DB::transaction(function () use ($book, $numOfReadPages) {
                $book->num_of_read_pages = $numOfReadPages;
                $book->save();
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

}