<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lead Management
        </h2>
    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <!-- Dashboard Cards -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">


                <div class="bg-white rounded-lg shadow border-l-4 border-blue-500 p-5">

                    <p class="text-gray-500 text-sm">
                        Total Leads
                    </p>

                    <h2 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalLeads }}
                    </h2>

                </div>


                <div class="bg-white rounded-lg shadow border-l-4 border-green-500 p-5">

                    <p class="text-gray-500 text-sm">
                        Active Leads
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $activeLeads }}
                    </h2>

                </div>


                <div class="bg-white rounded-lg shadow border-l-4 border-yellow-500 p-5">

                    <p class="text-gray-500 text-sm">
                        New Leads
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ $newLeads }}
                    </h2>

                </div>


                <div class="bg-white rounded-lg shadow border-l-4 border-red-500 p-5">

                    <p class="text-gray-500 text-sm">
                        Deleted Leads
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $deletedLeads }}
                    </h2>

                </div>


            </div>




            <!-- Filter Buttons -->

            <div class="flex flex-wrap gap-3 mb-6">


                <a href="{{ route('leads.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg">

                    All

                </a>


                <a href="{{ route('leads.index',['status'=>'New']) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                    New

                </a>


                <a href="{{ route('leads.index',['status'=>'Qualified']) }}"
                   class="bg-green-600 text-white px-4 py-2 rounded-lg">

                    Qualified

                </a>


                <a href="{{ route('leads.index',['status'=>'Won']) }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-lg">

                    Won

                </a>


                <a href="{{ route('leads.trash') }}"
                   class="bg-red-600 text-white px-4 py-2 rounded-lg">

                    Trash

                </a>


            </div>





            <div class="bg-white shadow rounded-lg">


                <div class="p-6">


                    <div class="flex justify-between items-center mb-6">


                        <h2 class="text-2xl font-bold">

                            Leads List

                        </h2>


                    </div>



                    @if(session('success'))

                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                            {{ session('success') }}

                        </div>

                    @endif





                    <!-- Search + Export + Add -->


                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">


                        <form method="GET"
                              action="{{ route('leads.index') }}"
                              class="flex flex-1 gap-3">


                            <input type="text"
                                   name="search"
                                   value="{{ $search }}"
                                   placeholder="Search Lead..."
                                   class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">


                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

                                Search

                            </button>


                        </form>




                        <div class="flex gap-3">


                            <a href="{{ route('leads.export.excel',['search'=>request('search')]) }}"
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                                Excel

                            </a>



                            <a href="{{ route('leads.export.pdf',['search'=>request('search')]) }}"
                               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                PDF

                            </a>



                            <a href="{{ route('leads.create') }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">

                                + Add Lead

                            </a>


                        </div>


                    </div>






                    <div class="overflow-x-auto">


                        <table class="min-w-full border">


                            <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-3 py-2">#</th>

                                <th class="border px-3 py-2">Code</th>

                                <th class="border px-3 py-2">Lead Name</th>

                                <th class="border px-3 py-2">Company</th>

                                <th class="border px-3 py-2">Phone</th>

                                <th class="border px-3 py-2">Source</th>

                                <th class="border px-3 py-2">Status</th>

                                <th class="border px-3 py-2">Value</th>

                                <th class="border px-3 py-2">Action</th>


                            </tr>

                            </thead>



                            <tbody>


                            @forelse($leads as $lead)


                            <tr>


                                <td class="border p-3">

                                    {{ $lead->id }}

                                </td>



                                <td class="border p-3">

                                    {{ $lead->lead_code }}

                                </td>



                                <td class="border p-3">

                                    {{ $lead->lead_name }}

                                </td>



                                <td class="border p-3">

                                    {{ $lead->company_name }}

                                </td>



                                <td class="border p-3">

                                    {{ $lead->phone }}

                                </td>



                                <td class="border p-3">

                                    {{ $lead->source }}

                                </td>



                                <td class="border p-3">


                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded">

                                        {{ $lead->status }}

                                    </span>


                                </td>



                                <td class="border p-3">

                                    ₹ {{ number_format($lead->expected_value,2) }}

                                </td>




                                <td class="border p-3">


                                    <a href="{{ route('leads.edit',$lead) }}"
                                       class="text-blue-600 font-semibold">

                                        Edit

                                    </a>


                                    |


                                    <form action="{{ route('leads.destroy',$lead) }}"
                                          method="POST"
                                          class="inline">


                                        @csrf
                                        @method('DELETE')


                                        <button
                                            onclick="return confirm('Delete Lead?')"
                                            class="text-red-600 font-semibold">

                                            Delete

                                        </button>


                                    </form>


                                </td>


                            </tr>


                            @empty


                            <tr>

                                <td colspan="9"
                                    class="text-center py-6">

                                    No Leads Found

                                </td>

                            </tr>


                            @endforelse


                            </tbody>


                        </table>


                    </div>




                    <div class="mt-5">

                        {{ $leads->links() }}

                    </div>


                </div>


            </div>


        </div>


    </div>


</x-app-layout>