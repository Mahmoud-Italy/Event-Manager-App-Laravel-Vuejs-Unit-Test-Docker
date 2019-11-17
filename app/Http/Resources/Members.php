<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;

class Members extends JsonResource
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
            'image' => Helper::hasImage($this->image),
            'name' => $this->name,
            'email' => $this->email,
            'status' => (isset($this->status)) ? $this->status : '',
            'suspend' => (isset($this->suspend)) ? $this->suspend : '',
            'created_at' => (isset($this->created_at)) ? explode(' ',$this->created_at)[0] : '',
            'active_loading' => false,
            'suspend_loading' => false,
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
