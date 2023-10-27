<?php

namespace App\Http\Resources;

use App\Http\Resources\Answer\AnswerCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'group' => new GroupResource($this->whenLoaded('group')),
            'answers' => new AnswerCollection($this->whenLoaded('answers'))
//            'teacher' => new UserResource($this->whenLoaded('group.teacher', $this->group->teacher()->first()),
        ];
    }
}
