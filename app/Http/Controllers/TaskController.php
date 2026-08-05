<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TasksExport;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $tasks = Task::query()

            ->when($search, function ($query) use ($search) {

                $query->where('task_code', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('assigned_to', 'like', "%{$search}%");

            })

            ->when($request->status, function ($query) use ($request) {

                $query->where('status', $request->status);

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();


        $totalTasks = Task::count();

        $pendingTasks = Task::where('status', 'Pending')->count();

        $inProgressTasks = Task::where('status', 'In Progress')->count();

        $completedTasks = Task::where('status', 'Completed')->count();

        $deletedTasks = Task::onlyTrashed()->count();

        return view('tasks.index', compact(

            'tasks',

            'search',

            'totalTasks',

            'pendingTasks',

            'inProgressTasks',

            'completedTasks',

            'deletedTasks'

        ));
    }

    
    public function create()
    {
        return view(

            'tasks.create'

        );
    }

    public function store(TaskRequest $request)
    {
        Task::create(

            $request->validated()

        );

        return redirect()

            ->route('tasks.index')

            ->with(

                'success',

                'Task created successfully.'

            );
    }

    public function edit(Task $task)
    {
        return view(

            'tasks.edit',

            compact('task')

        );
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update(

            $request->validated()

        );

        return redirect()

            ->route('tasks.index')

            ->with(

                'success',

                'Task updated successfully.'

            );
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()

            ->route('tasks.index')

            ->with(

                'success',

                'Task deleted successfully.'

            );
    }

    public function trash()
    {
        $tasks = Task::onlyTrashed()

            ->latest()

            ->paginate(10);

        return view(

            'tasks.trash',

            compact('tasks')

        );
    }

    public function restore($id)
    {
        Task::onlyTrashed()

            ->findOrFail($id)

            ->restore();

        return redirect()

            ->route('tasks.trash')

            ->with(

                'success',

                'Task restored successfully.'

            );
    }

    public function forceDelete($id)
    {
        Task::onlyTrashed()

            ->findOrFail($id)

            ->forceDelete();

        return redirect()

            ->route('tasks.trash')

            ->with(

                'success',

                'Task permanently deleted.'

            );
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new TasksExport($request->search),
            'tasks.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $search = $request->search;

        $tasks = Task::query()

            ->when($search, function ($query) use ($search) {

                $query->where('task_code', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('assigned_to', 'like', "%{$search}%");

            })

            ->orderBy('id', 'desc')

            ->get();

        $pdf = Pdf::loadView('tasks.pdf', compact('tasks'))

            ->setPaper('a4', 'landscape');

        return $pdf->download('tasks-report.pdf');
    }
}
