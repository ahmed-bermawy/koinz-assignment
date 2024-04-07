<?php

namespace Tests\Unit\Repository;

use App\Repositories\BookRepository;
use Database\Factories\BookFactory;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;

class BookRepositoryTest extends TestCase
{
    private BookRepository $repository;
    private BookFactory $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new BookFactory();
        $this->repository = new BookRepository();
    }
    public function testMostRecommendedBooksReturnsExpectedBooks(): void
    {
        $repository = Mockery::mock(BookRepository::class);
        $repository->shouldReceive('getMostRecommendedBooks')->andReturn([
            ['book_id' => 1, 'book_name' => 'Book 1', 'num_of_read_pages' => 100],
            ['book_id' => 2, 'book_name' => 'Book 2', 'num_of_read_pages' => 90],
            ['book_id' => 3, 'book_name' => 'Book 3', 'num_of_read_pages' => 80],
            ['book_id' => 4, 'book_name' => 'Book 4', 'num_of_read_pages' => 70],
            ['book_id' => 5, 'book_name' => 'Book 5', 'num_of_read_pages' => 60],
        ]);

        $books = $repository->getMostRecommendedBooks();

        $this->assertCount(5, $books);
        $this->assertEquals(1, $books[0]['book_id']);
        $this->assertEquals('Book 1', $books[0]['book_name']);
        $this->assertEquals(100, $books[0]['num_of_read_pages']);
    }

    public function testMostRecommendedBooksReturnsEmptyWhenNoBooks(): void
    {
        $repository = Mockery::mock(BookRepository::class);
        $repository->shouldReceive('getMostRecommendedBooks')->andReturn([]);

        $books = $repository->getMostRecommendedBooks();

        $this->assertCount(0, $books);
    }

    public function testUpdateNumOfReadPagesSuccessfullyUpdatesBook(): void
    {
        $book = $this->factory->make();
        $this->repository->updateNumOfReadPages($book, 100);
        $this->assertEquals(100, $book->getAttribute('num_of_read_pages'));
    }

    public function testUpdateNumOfReadPagesRollsBackOnException(): void
    {
        $book = $this->factory->make();
        $numOfReadPages = $book->getAttribute('num_of_read_pages');

        DB::shouldReceive('rollBack')->once();

        $repository = new BookRepository();
        $repository->updateNumOfReadPages($book, 100);

        $this->assertEquals($numOfReadPages, $book->getAttribute('num_of_read_pages'));
    }
}