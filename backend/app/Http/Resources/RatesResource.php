<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RatesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        foreach ($this->collection as $item) {
            $data[] = [
                'id' => $item->id,
                'day' => $item->day()->first()->date,
                'name' => $item->name,
                'code' => $item->code,
                'value' => $item->value,
                'note' => $item->note,
            ];
        }
        return $data;
    }
}
