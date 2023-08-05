<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => asset('storage/'.$this->image),
            'title' => $this->title,
            'detil' => $this->detil,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comment' => $this->comment,
        ];
    }
    
}
