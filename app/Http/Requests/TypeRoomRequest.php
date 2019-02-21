<?php

namespace App\Http\Requests;

class TypeRoomRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
            'people' => 'required|integer|min:0|max:5',
            'bed' => 'required|integer|min:0|max:2',
            'number_room' => 'required|integer',
            'acreage' => 'required|integer',
            'price' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên loại phòng không được để trống',
            'people.required' => 'Số người/phòng không được để trống',
            'people.integer' => 'Số người/phòng là số nguyên dương',
            'people.min' => 'Số người/phòng phải lớn hơn 0',
            'people.max' => 'Số người/phòng phải nhỏ hơn 5',
            'bed.required' => 'Số giường chính không được để trống',
            'bed.integer' => 'Số giường là số nguyên dương',
            'bed.min' => 'Số giường phải lớn hơn 0',
            'bed.max' => 'Số giường phải nhỏ hơn 5',
            'number_room.required' => 'Số phòng không được để trống',
            'number_room.integer' => 'Số phòng là số nguyên dương',
            'acreage.required' => 'Diện tích không được để trống',
            'acreage.integer' => 'Diện tích là số nguyên dương',
            'price.required' => 'Giá phòng không được để trống',
            'price.integer' => 'Giá phòng là số nguyên dương',
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
