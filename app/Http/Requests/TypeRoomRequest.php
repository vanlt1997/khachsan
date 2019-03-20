<?php

namespace App\Http\Requests;

class TypeRoomRequest extends Request
{
    public function rules()
    {
        $id = $this->typeRoom ? $this->typeRoom->id : null;

        return [
            'name' => 'required|unique:type_rooms,name,'.$id,
            'people' => 'required|integer|min:0|max:5',
            'bed' => 'required|integer|min:0|max:2',
            'acreage' => 'required|integer',
            'price' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'name',
            'people',
            'bed',
            'number_room',
            'acreage',
            'price'
        ];
    }
}
