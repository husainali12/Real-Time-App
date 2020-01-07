<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed created_at
 * @property mixed body
 * @property mixed user
 * @property mixed id
 */
class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id ,
            'reply' => $this->body,
            'user'  => $this->user->name,
            'user_id' => $this->user_id,
            'question_slug'=> $this->question->slug,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
