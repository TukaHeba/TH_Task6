<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            // 'category' => new CategoryResource($this->category),
            // 'user' => new UserResource($this->user),
            'category' => $this->category->name,
            'user' => $this->user->name,    
            'date:' => $this->created_at->format('Y-m-d'),
        ];
    }
}
