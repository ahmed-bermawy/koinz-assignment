<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *     schema="ReadingIntervalResource",
 *     type="object",
 *     required={"id", "user_id", "book_id", "start_page", "end_page"},
 *     @OA\Property(property="id", type="integer", description="The reading interval ID"),
 *     @OA\Property(property="user_id", type="integer", description="The user ID"),
 *     @OA\Property(property="book_id", type="integer", description="The book ID"),
 *     @OA\Property(property="start_page", type="integer", description="The start page"),
 *     @OA\Property(property="end_page", type="integer", description="The end page"),
 *     )
 */
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
