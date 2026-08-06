<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="text-2xl font-bold">

                Add AI Setting

            </h2>

            <a
                href="{{ route('ai-settings.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">

                Back

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <form
                        action="{{ route('ai-settings.store') }}"
                        method="POST">

                        @csrf

                        @include('ai-settings._form')

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>