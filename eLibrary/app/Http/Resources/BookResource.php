<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'data';

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => substr($this->description, 0, 20)."...",
            "book_number" => $this->book_number,
            "created_by" => $this->user ? $this->user->name." ".$this->user->surname : "/",
            "author" => $this->author ? $this->author->name." ".$this->author->surname : "/",
            "created_at" => $this->created_at->format("d-m-Y"),
            "updated_at" => $this->updated_at->format("d-m-Y"),
        ];
    }
}
