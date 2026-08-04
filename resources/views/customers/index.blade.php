<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Customer Management
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                <!-- Total Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-blue-500 p-5">
                    <p class="text-gray-500 text-sm">Total Customers</p>
                    <h2 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalCustomers }}
                    </h2>
                </div>

                <!-- Active Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-green-500 p-5">
                    <p class="text-gray-500 text-sm">Active Customers</p>
                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $activeCustomers }}
                    </h2>
                </div>

                <!-- Inactive Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-yellow-500 p-5">
                    <p class="text-gray-500 text-sm">Inactive Customers</p>
                    <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ $inactiveCustomers }}
                    </h2>
                </div>

                <!-- Deleted Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-red-500 p-5">
                    <p class="text-gray-500 text-sm">Deleted Customers</p>
                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $deletedCustomers }}
                    </h2>
                </div>

            </div>

            <div class="flex flex-wrap gap-3 mb-6">

                <a href="{{ route('customers.index') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded-lg">
                    All
                </a>

                <a href="{{ route('customers.index',['status'=>'Active']) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg">
                    Active
                </a>

                <a href="{{ route('customers.index',['status'=>'Inactive']) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
                    Inactive
                </a>

                <a href="{{ route('customers.trash') }}"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg">
                    Trash
                </a>

            </div>

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <!-- Heading -->
                    <div class="flex justify-between items-center mb-6">

                        <h2 class="text-2xl font-bold">
                            Customer List
                        </h2>

                    </div>

                    <!-- Success Message -->
                    @if(session('success'))

                        <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-5">

                            {{ session('success') }}

                        </div>

                    @endif

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                        <form class="flex flex-1 gap-3"> 
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search by code, name, email or phone..." class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"> 
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg"> Search </button> 
                        </form> 
                        <div class="flex gap-3"> 
                            <a href="{{ route('customers.export.excel',request()->query()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"> 
                                Excel 
                            </a> 
                            <a href="{{ route('customers.export.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"> 
                                PDF 
                            </a> 
                            <a href="{{ route('customers.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg"> 
                                + Add Customer 
                            </a> 
                        </div> 
                    </div>
                    

                    <!-- Table -->

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>
                                    <th class="border p-3">#</th>
                                    <th class="border p-3">Code</th>
                                    <th class="border p-3">Name</th>
                                    <th class="border p-3">Email</th>
                                    <th class="border p-3">Phone</th>
                                    <th class="border p-3">Company</th>
                                    <th class="border p-3">Status</th>
                                    <th class="border p-3">Date</th>
                                    <th class="border p-3">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                            @forelse($customers as $customer)

                                <tr>
                                    <td class="border p-3">
                                        {{ $customers->firstItem() + $loop->index }}
                                    </td>

                                    <td class="border p-3">

                                        {{ $customer->customer_code }}

                                    </td>

                                    <td class="border p-3">

                                        {{ $customer->name }}

                                    </td>

                                    <td class="border p-3">

                                        {{ $customer->email }}

                                    </td>

                                    <td class="border p-3">

                                        {{ $customer->phone }}

                                    </td>

                                    <td class="border p-3">

                                        {{ $customer->company_name }}

                                    </td>

                                    <td class="border p-3">

                                        @if($customer->status=='Active')

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                                Active

                                            </span>

                                        @else

                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                                Inactive

                                            </span>

                                        @endif

                                    </td>

                                    <td class="border p-3">
                                        {{ $customer->created_at->format('d M Y') }}
                                    </td>

                                    <td class="border p-3">

                                        <div class="flex gap-2">

                                            <a href="{{ route('customers.show',$customer) }}"
                                               class="bg-gray-600 text-white px-3 py-1 rounded">

                                                View

                                            </a>

                                            <a href="{{ route('customers.edit',$customer) }}"
                                               class="bg-yellow-500 text-white px-3 py-1 rounded">

                                                Edit

                                            </a>

                                            <form action="{{ route('customers.destroy',$customer) }}"
                                                  method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Delete this customer?')"
                                                    class="bg-red-600 text-white px-3 py-1 rounded">

                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9"
                                        class="text-center p-5">

                                        No Customer Found

                                    </td>

                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-5">

                        {{ $customers->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>