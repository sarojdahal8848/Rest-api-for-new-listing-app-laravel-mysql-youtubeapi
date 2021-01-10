<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YoutubeVideo extends JsonResource
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
            // 'id' => $this->id,
            'title' => $this->titile,
            'thumbnail' => $this->thumbnails,
            'video_id' => $this->id,
            'updated_at' => $this->updated_at,
        ];
    }
}
