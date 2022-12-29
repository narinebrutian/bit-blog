<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:150',
            'subtitle' => 'required|max:100',
            'slug' => 'required|max:100',
            'body' => 'required',
            'image' => 'nullable|image'
        ];
    }
}
