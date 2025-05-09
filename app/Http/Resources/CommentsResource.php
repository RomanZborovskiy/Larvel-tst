<?php

namespace App\Http\Resources;

use Auth;use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'user_id'=>Auth::id(),
            'content'=>$this->content,
            'product_id'=>$this->product->id,
            
        ];
    }
}
