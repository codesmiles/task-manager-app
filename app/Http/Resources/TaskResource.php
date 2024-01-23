<?php

namespace App\Http\Resources;

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
            "id" => $this["id"],
            "title" => $this["title"],
            "status" => $this["status"],
            "user_id" => $this["user_id"],
            "priority" => $this["priority"],
            "category" => $this["category"],
            "deadline" => $this["deadline"],
            "created_at" => $this["created_at"],
            "updated_at" => $this["updated_at"],
            "description" => $this["desctiption"],
            "is_successful" => $this["is_successful"] == true,
        ];
    }
}
