<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadingIntervalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'book_id' => $this->book_id,
            'start_page' => $this->start_page,
            'end_page' => $this->end_page,
        ];
    }
}