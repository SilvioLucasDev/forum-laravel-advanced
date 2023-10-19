<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplySupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource = (object) $this->resource;

        return [
            'id' => $this->id,
            'content' => $this->content,
            'user_id' => $this->user_id,
            'support_id' => $this->support_id,
            'dt_created' => $this->created_at,
        ];
    }
}
