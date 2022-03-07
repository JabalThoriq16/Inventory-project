<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryFormRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        if ($this->method() == "PUT") {
            $imageRule = 'nullable';
        }else{
            $imageRule = 'required';
        }
        return [
            'category_name' => 'required|min:3',
            'parent_id' => 'nullable'
        ];
    }
}
