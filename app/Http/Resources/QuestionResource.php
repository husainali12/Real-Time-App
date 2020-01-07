<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed user
 * @property mixed users
 */
class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'title' => $this->title,
            'path' => $this->path,
            'slug' => $this->slug,
            'body' => $this->body,
            'created_at'=> $this->created_at->diffForHumans(),
            'user'=>$this->user->name,
            'user_id'=>$this->user_id,
            'replies'=> ReplyResource::collection($this->replies),
            'replies_count'=>$this->replies->count()
        );
    }
}
