<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Task::query()

            ->when($this->search, function ($query) {

                $query->where(function ($q) {

                    $q->where('task_code', 'like', "%{$this->search}%")
                      ->orWhere('title', 'like', "%{$this->search}%")
                      ->orWhere('assigned_to', 'like', "%{$this->search}%")
                      ->orWhere('priority', 'like', "%{$this->search}%")
                      ->orWhere('status', 'like', "%{$this->search}%");

                });

            })

            ->select([
                'task_code',
                'title',
                'assigned_to',
                'priority',
                'status',
                'start_date',
                'due_date',
            ])

            ->get();
    }

    public function headings(): array
    {
        return [
            'Task Code',
            'Title',
            'Assigned To',
            'Priority',
            'Status',
            'Start Date',
            'Due Date',
        ];
    }
}