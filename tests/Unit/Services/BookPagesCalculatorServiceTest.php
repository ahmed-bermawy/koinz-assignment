<?php

namespace Tests\Unit\Services;

use App\Models\Book;
use App\Models\ReadingInterval;
use App\Repositories\BookRepository;
use App\Repositories\ReadingIntervalRepository;
use App\Services\BookPagesCalculatorService;
use Mockery;
use Tests\TestCase;

class BookPagesCalculatorServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->bookModel = Mockery::mock(Book::class);
        $this->bookRepository = Mockery::mock(BookRepository::class);

        $this->readingIntervalModel = Mockery::mock(ReadingInterval::class);
        $this->readingIntervalRepository = Mockery::mock(ReadingIntervalRepository::class);
    }

    /**
     * @test
     */
    public function pagesCalculationForBookWithUnreadPages(): void
    {
        $this->bookModel->shouldReceive('getAttribute')->with('pages')->andReturn(100);
        $this->bookModel->shouldReceive('getAttribute')->with('num_of_read_pages')->andReturn(50);
        $this->bookRepository->shouldReceive('getDetail')->andReturn($this->bookModel);
        $this->bookRepository->shouldReceive('updateNumOfReadPages')->once();
        $this->readingIntervalModel->shouldReceive('getAttribute')->with('start_page')->andReturn(1);
        $this->readingIntervalModel->shouldReceive('getAttribute')->with('end_page')->andReturn(100);
        $this->readingIntervalRepository->shouldReceive('getBookPagesReadInterval')->andReturn([$this->readingIntervalModel]);

        $service = new BookPagesCalculatorService($this->bookRepository, $this->readingIntervalRepository);
        $service->calculatePagesForBook(1);
    }

    /**
     * @test
     */
    public function pagesCalculationForBookWithAllPagesRead(): void
    {
        $this->bookModel->shouldReceive('getAttribute')->with('pages')->andReturn(100);
        $this->bookModel->shouldReceive('getAttribute')->with('num_of_read_pages')->andReturn(100);
        $this->bookRepository->shouldReceive('getDetail')->andReturn($this->bookModel);
        $this->bookRepository->shouldNotReceive('updateNumOfReadPages');

        $service = new BookPagesCalculatorService($this->bookRepository, $this->readingIntervalRepository);
        $service->calculatePagesForBook(1);
    }
}
