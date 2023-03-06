<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => ['required'],
            'extra' => ['nullable'],
            'title' => ['required','string','max:255'],
            'room_number' => ['required','unique:rooms','integer'],
            'meta_title' => ['nullable'],
            'meta_keywords' => ['nullable'],
            'meta_description' => ['nullable'],
            'image_1' => ['required'],
            'image_2' => ['nullable'],
            'image_3' => ['nullable'],
            'image_4' => ['nullable'],
            'image_5' => ['nullable'],
            'image_6' => ['nullable'],
            'tags' => ['required'],
            'category' => ['required'],
            'available' => ['required'],
            'clean' => ['required'],
            'price' => ['required','numeric','min:1'],
            'features' => ['required']
        ];
    }
}
