<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="text-2xl font-bold">

                Deleted Tasks

            </h2>

            <a href="{{ route('tasks.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

                Back

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    @if(session('success'))

                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                            {{ session('success') }}

                        </div>

                    @endif

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

                                    <th class="border px-3 py-2">Deleted At</th>

                                    <th class="border px-3 py-2 text-center">

                                        Action

                                    </th>

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

                                            @if($task->priority=='High')

                                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded">

                                                    High

                                                </span>

                                            @elseif($task->priority=='Medium')

                                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">

                                                    Medium

                                                </span>

                                            @else

                                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded">

                                                    Low

                                                </span>

                                            @endif

                                        </td>

                                        <td class="border p-3">

                                            {{ $task->status }}

                                        </td>

                                        <td class="border p-3">

                                            {{ $task->deleted_at->format('d-m-Y H:i') }}

                                        </td>

                                        <td class="border p-3 text-center">

                                            <form
                                                action="{{ route('tasks.restore',$task->id) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf

                                                <button
                                                    onclick="return confirm('Restore this task?')"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                                                    Restore

                                                </button>

                                            </form>

                                            <form
                                                action="{{ route('tasks.forceDelete',$task->id) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Permanently delete this task?')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded ml-2">

                                                    Delete Permanently

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="8"
                                            class="text-center py-6">

                                            No Deleted Tasks Found

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