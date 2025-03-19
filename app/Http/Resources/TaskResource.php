<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(?Request $request): array
    {
        /**
         * Transforma o retorno da tarefa em um array.
         *
         * @param  \Illuminate\Http\Request|null  $request
         * @return array<string, mixed>
         */

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->due_date ? $this->due_date->format('Y-m-d') : null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
