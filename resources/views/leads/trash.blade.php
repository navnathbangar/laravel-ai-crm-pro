<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="text-2xl font-bold">
                Trash Leads
            </h2>

            <a href="{{ route('leads.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">
                Back
            </a>

        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full border-collapse">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border px-4 py-2 text-left">Lead Code</th>
                            <th class="border px-4 py-2 text-left">Lead Name</th>
                            <th class="border px-4 py-2 text-left">Company</th>
                            <th class="border px-4 py-2 text-left">Phone</th>
                            <th class="border px-4 py-2 text-left">Status</th>
                            <th class="border px-4 py-2 text-center">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($leads as $lead)

                        <tr>

                            <td class="border px-4 py-2">{{ $lead->lead_code }}</td>

                            <td class="border px-4 py-2">{{ $lead->lead_name }}</td>

                            <td class="border px-4 py-2">{{ $lead->company_name }}</td>

                            <td class="border px-4 py-2">{{ $lead->phone }}</td>

                            <td class="border px-4 py-2">{{ $lead->status }}</td>

                            <td class="border px-4 py-2 text-center">

                                <div class="flex justify-center gap-2">

                                    <form action="{{ route('leads.restore',$lead->id) }}" method="POST">

                                        @csrf

                                        <button
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                                            Restore

                                        </button>

                                    </form>

                                    <form
                                        action="{{ route('leads.forceDelete',$lead->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete permanently?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="border px-4 py-4 text-center">

                                No Deleted Leads Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="p-4">

                    {{ $leads->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>