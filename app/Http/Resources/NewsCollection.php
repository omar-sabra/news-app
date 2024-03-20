<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use function League\Flysystem\map;

class NewsCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
                return [
                    'id' => $this->id,
                    'title' => $this->title,
                    'description' => $this->description,
                    'custom_date' => $this->custom_date,
                    'category' => $this->category->title,
//                    'media' =>  count($this->media) > 0 ? url($this->media->image) : 'No image',
                    'media' => count($this->media) > 0 ? $this->media->map(function($data , $key){
                        return [
                            'index' => $key,
                            'image' => url($data->image),
                        ];
                    }) : 'No data found',
                    'tags' =>  TagsCollection::collection($this->news_tags),
                ];

//        return $arr;
//        return [
//            'id' => $this->id,
//            'title' => $this->title,
//            'description' => $this->description,
//            'custom_date' => $this->custom_date,
//            'category' => $this->category->title,
//            'media' => count($this->media) > 0 ? $this->media->map(function($data , $key){
//                return [
//                    'index' => $key,
//                    'image' => url($data->image),
//                ];
//            }) : 'No data found',
////            'tags' => map(function ($item1, $key) {
////                $item1->tags->map(function ($item2, $index) {
////                    return [
////                        'id' => $index,
////                        'title' => $item2->title,
////                    ];
////                });
////            })
//        'tags' =>  $arr,
//        ];
    }
}
