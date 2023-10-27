<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'file_name' => $this->file_name,
            'name' => $this->name,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'url' => $this->getFullUrl(),
        ];
    }
}
