<?php

namespace App\Http\Requests\Task;

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
            'title'   => 'required|string|min:3|max:100',
            'content' => 'nullable|string|max:255',
            'tags'    => 'nullable|array',
            'tags.*'  => [
                'required',
                'distinct',
                Rule::in(
                    auth()->user()->tags->pluck('id')->toArray()
                ),
            ],
            'status'  => [
                'required',
                Rule::in(
                    Task::getAvailableStatuses()
                ),
            ],
        ];
    }
}
