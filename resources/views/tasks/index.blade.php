<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task Management
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">

                <!-- Total Tasks -->
                <div class="bg-white rounded-lg shadow border-l-4 border-blue-500 p-5">
                    <p class="text-gray-500 text-sm">Total Tasks</p>
                    <h2 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalTasks }}
                    </h2>
                </div>

                <!-- Pending Tasks -->
                <div class="bg-white rounded-lg shadow border-l-4 border-yellow-500 p-5">
                    <p class="text-gray-500 text-sm">Pending Tasks</p>
                    <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ $pendingTasks }}
                    </h2>
                </div>

                <!-- In Progress Tasks -->
                <div class="bg-white rounded-lg shadow border-l-4 border-indigo-500 p-5">
                    <p class="text-gray-500 text-sm">In Progress</p>
                    <h2 class="text-3xl font-bold text-indigo-600 mt-2">
                        {{ $inProgressTasks }}
                    </h2>
                </div>

                <!-- Completed Tasks -->
                <div class="bg-white rounded-lg shadow border-l-4 border-green-500 p-5">
                    <p class="text-gray-500 text-sm">Completed Tasks</p>
                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $completedTasks }}
                    </h2>
                </div>

                <!-- Deleted Tasks -->
                <div class="bg-white rounded-lg shadow border-l-4 border-red-500 p-5">
                    <p class="text-gray-500 text-sm">Deleted Tasks</p>
                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $deletedTasks }}
                    </h2>
                </div>

            </div>

            <div class="flex flex-wrap gap-3 mb-6">

                <a href="{{ route('tasks.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    All
                </a>

                <a href="{{ route('tasks.index', ['status' => 'Pending']) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                    Pending
                </a>

                <a href="{{ route('tasks.index', ['status' => 'In Progress']) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    In Progress
                </a>

                <a href="{{ route('tasks.index', ['status' => 'Completed']) }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    Completed
                </a>

                <a href="{{ route('tasks.index', ['status' => 'Cancelled']) }}"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                    Cancelled
                </a>

                <a href="{{ route('tasks.trash') }}"
                    class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded-lg">
                    Trash
                </a>

            </div>

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <div class="flex justify-between items-center mb-6">

                        <h2 class="text-2xl font-bold">
                            Tasks List
                        </h2>

                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                        <form method="GET"
                            action="{{ route('tasks.index') }}"
                            class="flex flex-1 gap-3">

                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search Task..."
                                class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

                                Search

                            </button>

                        </form>

                        <div class="flex gap-3">

                            <a href="{{ route('tasks.export.excel', ['search' => request('search')]) }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                                Excel

                            </a>

                            <a href="{{ route('tasks.export.pdf', ['search' => request('search')]) }}"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                PDF

                            </a>

                            <a href="{{ route('tasks.create') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">

                                + Add Task

                            </a>

                        </div>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="border px-3 py-2">#</th>

                                    <th class="border px-3 py-2">Task Code</th>

                                    <th class="border px-3 py-2">Title</th>

                                    <th class="border px-3 py-2">Assigned To</th>

                                    <th class="border px-3 py-2">Priority</th>

                                    <th class="border px-3 py-2">Status</th>

                                    <th class="border px-3 py-2">Start Date</th>

                                    <th class="border px-3 py-2">Due Date</th>

                                    <th class="border px-3 py-2">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($tasks as $task)

                                <tr>

                                    <td class="border p-3">
                                        {{ $task->id }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $task->task_code }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $task->title }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $task->assigned_to }}
                                    </td>

                                    <td class="border p-3">

                                        @if($task->priority == 'High')

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                                                High
                                            </span>

                                        @elseif($task->priority == 'Medium')

                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                                Medium
                                            </span>

                                        @else

                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded">
                                                Low
                                            </span>

                                        @endif

                                    </td>

                                    <td class="border p-3">

                                        @if($task->status == 'Completed')

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                                                Completed
                                            </span>

                                        @elseif($task->status == 'In Progress')

                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded">
                                                In Progress
                                            </span>

                                        @elseif($task->status == 'Pending')

                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                                Pending
                                            </span>

                                        @else

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                                                Cancelled
                                            </span>

                                        @endif

                                    </td>

                                    <td class="border p-3">
                                        {{ optional($task->start_date)->format('d-m-Y') }}
                                    </td>

                                    <td class="border p-3">
                                        {{ optional($task->due_date)->format('d-m-Y') }}
                                    </td>

                                    <td class="border p-3">

                                        <a href="{{ route('tasks.edit', $task) }}"
                                        class="text-blue-600 font-semibold">

                                            Edit

                                        </a>

                                        |

                                        <form action="{{ route('tasks.destroy', $task) }}"
                                            method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Delete Task?')"
                                                class="text-red-600 font-semibold">

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="9"
                                        class="text-center py-6">

                                        No Tasks Found

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-5">

                        {{ $tasks->links() }}

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>