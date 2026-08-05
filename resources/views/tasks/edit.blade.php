<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="text-2xl font-bold">

                Edit Task

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

                    @if ($errors->any())

                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">

                            <ul class="list-disc list-inside">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form
                        action="{{ route('tasks.update', $task) }}"
                        method="POST">

                        @csrf

                        @method('PUT')

                        @include('tasks._form')

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>