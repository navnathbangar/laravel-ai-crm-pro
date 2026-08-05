<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Company Trash
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <div class="flex justify-between items-center mb-6">

                        <h2 class="text-2xl font-bold">

                            Deleted Companies

                        </h2>

                        <a href="{{ route('companies.index') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                            ← Back

                        </a>

                    </div>

                    @if(session('success'))

                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                            {{ session('success') }}

                        </div>

                    @endif

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="border px-3 py-2">ID</th>

                                    <th class="border px-3 py-2">Company</th>

                                    <th class="border px-3 py-2">Contact</th>

                                    <th class="border px-3 py-2">Email</th>

                                    <th class="border px-3 py-2">Deleted At</th>

                                    <th class="border px-3 py-2">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($companies as $company)

                                    <tr>

                                        <td class="border p-3">

                                            {{ $company->id }}

                                        </td>

                                        <td class="border p-3">

                                            <strong>

                                                {{ $company->company_name }}

                                            </strong>

                                            <br>

                                            <small class="text-gray-500">

                                                {{ $company->company_code }}

                                            </small>

                                        </td>

                                        <td class="border p-3">

                                            {{ $company->contact_person }}

                                        </td>

                                        <td class="border p-3">

                                            {{ $company->email }}

                                        </td>

                                        <td class="border p-3">

                                            {{ $company->deleted_at->format('d-m-Y H:i') }}

                                        </td>

                                        <td class="border p-3">

                                            <form
                                                action="{{ route('companies.restore',$company->id) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf

                                                <button
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                                                    Restore

                                                </button>

                                            </form>

                                            <form
                                                action="{{ route('companies.forceDelete',$company->id) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Permanently delete this company?')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded ml-2">

                                                    Delete Forever

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="text-center py-6 text-gray-500">

                                            No Deleted Companies Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-5">

                        {{ $companies->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>