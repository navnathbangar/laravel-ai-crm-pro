<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Add Customer
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">

                <form action="{{ route('customers.store') }}" method="POST">

                    @include('customers._form')

                </form>

            </div>
        </div>
    </div>

</x-app-layout>