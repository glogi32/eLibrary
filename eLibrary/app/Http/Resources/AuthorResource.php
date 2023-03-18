<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            "name" => $this->name,
            "surname" => $this->surname,
            "src" => $this->src,
            "alt" => $this->alt,
            "created_by" => $this->user->name." ".$this->user->surname,
            "created_at" => $this->created_at->format("d:m:Y"),
            "updated_at" => $this->updated_at->format("d:m:Y"),
        ];
    }

    
}
