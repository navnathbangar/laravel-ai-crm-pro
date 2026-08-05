<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Edit Company
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">

                <form action="{{ route('companies.update',$company) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @include('companies._form')

                </form>

            </div>
        </div>
    </div>

</x-app-layout>