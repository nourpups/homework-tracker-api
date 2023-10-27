<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'name' => $this->name,
            'start_time' => $this->start_time->format('H:i'),
            'end_time' => $this->end_time->format('H:i'),
            'created_at' => $this->created_at->format('d-m-Y'),
            'teacher' => new UserResource($this->whenLoaded('teacher', fn() => $this->teacher->first())),
            'students' => new UserCollection($this->whenLoaded('students')),
            'tasks' => new TaskCollection($this->whenLoaded('tasks'))
        ];
    }
}
