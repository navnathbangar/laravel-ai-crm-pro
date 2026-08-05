<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between">

            <h2 class="text-2xl font-bold">

                Add Lead

            </h2>

            <a href="{{ route('leads.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

                Back

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <form
                        action="{{ route('leads.store') }}"
                        method="POST">

                        @csrf

                        @include('leads._form')

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>