<?php

namespace App\Http\Resources\Answer;

use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $image = $this->getMedia('images') ?? false;
        $file = $this->getMedia('files') ?? false;

        return [
            'id' => $this->id,
            'text' => $this->text ?? null,
            'image' => $this->when($image, new AnswerMediaCollection($image)),
            'file' => $this->when($file, new AnswerMediaCollection($file)),
            'task' => new TaskResource($this->whenLoaded('task')),
            'student' => new UserResource($this->whenLoaded('student')),
        ];
    }
}
