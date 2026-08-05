<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <label class="block font-medium">
            Task Code <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="task_code"
            value="{{ old('task_code', $task->task_code ?? '') }}"
            class="w-full border rounded-lg mt-1">

        @error('task_code')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">
            Task Title <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="title"
            value="{{ old('title', $task->title ?? '') }}"
            class="w-full border rounded-lg mt-1">

        @error('title')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">
            Assigned To
        </label>

        <input
            type="text"
            name="assigned_to"
            value="{{ old('assigned_to', $task->assigned_to ?? '') }}"
            class="w-full border rounded-lg mt-1">

        @error('assigned_to')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">
            Priority <span class="text-red-500">*</span>
        </label>

        <select
            name="priority"
            class="w-full border rounded-lg mt-1">

            @foreach(['Low','Medium','High'] as $priority)

                <option
                    value="{{ $priority }}"
                    {{ old('priority', $task->priority ?? 'Medium') == $priority ? 'selected' : '' }}>

                    {{ $priority }}

                </option>

            @endforeach

        </select>

        @error('priority')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">
            Status <span class="text-red-500">*</span>
        </label>

        <select
            name="status"
            class="w-full border rounded-lg mt-1">

            @foreach([
                'Pending',
                'In Progress',
                'Completed',
                'Cancelled'
            ] as $status)

                <option
                    value="{{ $status }}"
                    {{ old('status', $task->status ?? 'Pending') == $status ? 'selected' : '' }}>

                    {{ $status }}

                </option>

            @endforeach

        </select>

        @error('status')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">
            Start Date <span class="text-red-500">*</span>
        </label>

        <input
            type="date"
            name="start_date"
            value="{{ old('start_date', isset($task) && $task->start_date ? $task->start_date->format('Y-m-d') : '') }}"
            class="w-full border rounded-lg mt-1">

        @error('start_date')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">
            Due Date <span class="text-red-500">*</span>
        </label>

        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
            class="w-full border rounded-lg mt-1">

        @error('due_date')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">
            Completed At
        </label>

        <input
            type="datetime-local"
            name="completed_at"
            value="{{ old('completed_at', isset($task) && $task->completed_at ? $task->completed_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full border rounded-lg mt-1">

        @error('completed_at')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block font-medium">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            class="w-full border rounded-lg mt-1">{{ old('description', $task->description ?? '') }}</textarea>

        @error('description')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="mt-6">

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

        Save Task

    </button>

</div>