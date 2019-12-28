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
            'body' => $this->body,
            'created_at'=> $this->created_at->diffForHumans(),
            'user'=>$this->user->name
        );
    }
}
