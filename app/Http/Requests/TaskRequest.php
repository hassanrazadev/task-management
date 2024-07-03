<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest {
    public function rules(): array {
        $rules = ['name' => ['required'],
            'priority' => ['required', 'integer'],
            'project_id' => ['required', 'exists:projects,id'],
        ];

        if ($this->route('task')) {
            $rules['project_id'] = ['nullable', 'exists:projects,id'];
        }

        return $rules;
    }

    public function authorize(): bool {
        return true;
    }
}
