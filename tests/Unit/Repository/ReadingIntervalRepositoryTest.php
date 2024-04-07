<?php

namespace Tests\Unit\Repository;

use App\Models\ReadingInterval;
use App\Repositories\ReadingIntervalRepository;
use Mockery;
use Tests\TestCase;

class ReadingIntervalRepositoryTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->readingIntervalModel = Mockery::mock(ReadingInterval::class);
        $this->readingIntervalRepository = Mockery::mock(ReadingIntervalRepository::class);
    }
    public function testReadingIntervalCreationReturnsModelOnSuccess(): void
    {
        $this->readingIntervalRepository->shouldReceive('create')->andReturn($this->readingIntervalModel);

        $result = $this->readingIntervalRepository->create(['book_id' => 1, 'start_page' => 1, 'end_page' => 100]);

        $this->assertInstanceOf(ReadingInterval::class, $result);
    }
}