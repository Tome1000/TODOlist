<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Task;


class Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:tags,name',
            
          
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'name' => mb_strtolower($this->name, 'utf-8'),


        ]);


    }

   
}
