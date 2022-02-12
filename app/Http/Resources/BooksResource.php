<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
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
          'id'=>(string)$this->id,
          'type'=>'Books',
          'attributes'=>[
            'name'=>$this->name,
            'title'=>$this->title,
            'year'=>$this->year
          ]
        ];
    }
}
