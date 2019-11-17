<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;

class Meetings extends JsonResource
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
            'id' => $this->id,
            'image' => $this->image,
            'title' => $this->title,
            'content' => $this->content,
            'location' => $this->location,
            'start_dateTime' => date('m-d-Y H:i:s', strtotime($this->start_dateTime)),
            'end_dateTime' => date('m-d-Y H:i:s', strtotime($this->end_dateTime)),
            'start_date' => date('Y-m-d', strtotime($this->start_dateTime)),
            'start_time' => date('h:i A', strtotime($this->start_dateTime)),
            'end_date' => date('Y-m-d', strtotime($this->end_dateTime)),
            'end_time' => date('h:i A', strtotime($this->end_dateTime)),
            'total_members' => Helper::getMembersCount($this->id, 'meeting_members'),
            'status' => $this->status,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,

            'active_loading' => false,
            'edit_loading' => false,
            'del_loading' => false,
        ];
    }

    public function with($request) 
    {
        return [
            'version' => '1.0.0',
            'author' => '',
        ];
    }
}
