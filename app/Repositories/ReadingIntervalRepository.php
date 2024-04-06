<?php

namespace App\Repositories;


use App\Models\ReadingInterval;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ReadingIntervalRepository
{
    public function create(array $data)
    {
        try {
            return ReadingInterval::create($data);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                Log::error($e->getMessage());
                return [
                    'message' =>[
                        'error' => 'Duplicate entry.'
                    ],
                    'code' => Response::HTTP_CONFLICT];
            }
            throw $e;
        }
    }
}