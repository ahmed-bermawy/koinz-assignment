<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function getDetail(int $id)
    {
        return Book::find($id);
    }

}