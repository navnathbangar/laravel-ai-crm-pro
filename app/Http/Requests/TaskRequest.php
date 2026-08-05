<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $taskId = $this->route('task')?->id;

        return [

            'task_code' => 'required|string|max:50|unique:tasks,task_code,'.$taskId,

            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'assigned_to' => 'nullable|string|max:255',

            'priority' => 'required|in:Low,Medium,High',

            'status' => 'required|in:Pending,In Progress,Completed,Cancelled',

            'start_date' => 'required|date',

            'due_date' => 'required|date|after_or_equal:start_date',

            'completed_at' => 'nullable|date',

        ];
    }
}
