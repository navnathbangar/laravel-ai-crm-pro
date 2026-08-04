<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Deleted Customers
            </h2>

            <a href="{{ route('customers.index') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Back to Customers
            </a>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <div class="p-6">

                    <table class="min-w-full border border-gray-200">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-4 py-3 text-left">#</th>

                                <th class="border px-4 py-3 text-left">Customer Code</th>

                                <th class="border px-4 py-3 text-left">Name</th>

                                <th class="border px-4 py-3 text-left">Email</th>

                                <th class="border px-4 py-3 text-left">Phone</th>

                                <th class="border px-4 py-3 text-left">Deleted At</th>

                                <th class="border px-4 py-3 text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($customers as $customer)

                            <tr class="hover:bg-gray-50">

                                <td class="border px-4 py-3">
                                    {{ $customers->firstItem() + $loop->index }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $customer->customer_code }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $customer->name }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $customer->email }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $customer->phone }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $customer->deleted_at->format('d M Y h:i A') }}
                                </td>

                                <td class="border px-4 py-3">

                                    <div class="flex justify-center gap-2">

                                        <form action="{{ route('customers.restore',$customer->id) }}"
                                              method="POST">

                                            @csrf

                                            <button
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded">
                                                Restore
                                            </button>

                                        </form>

                                        <form action="{{ route('customers.forceDelete',$customer->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Permanently delete this customer?')"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-10 text-gray-500">

                                    No deleted customers found.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                    <div class="mt-6">
                        {{ $customers->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>