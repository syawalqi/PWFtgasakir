<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = ['required', 'string', 'min:3', 'max:100'];
        $category = $this->route('category');
        if ($category) {
            $rules[] = 'unique:complaint_categories,name,' . $category->id;
        } else {
            $rules[] = 'unique:complaint_categories,name';
        }
        return ['name' => $rules];
    }
}
