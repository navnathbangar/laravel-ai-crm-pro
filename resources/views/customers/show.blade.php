<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                Customer Details
            </h2>

            <a href="{{ route('customers.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-6xl mx-auto">

            <div class="bg-white rounded-lg shadow">

                <div class="border-b p-6">

                    <h2 class="text-2xl font-bold">
                        {{ $customer->name }}
                    </h2>

                    <p class="text-gray-500">
                        Customer Code : {{ $customer->customer_code }}
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">

                    <div>
                        <label class="font-semibold">Email</label>
                        <p>{{ $customer->email }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Phone</label>
                        <p>{{ $customer->phone }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Company</label>
                        <p>{{ $customer->company_name ?: '-' }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">GST Number</label>
                        <p>{{ $customer->gst_number ?: '-' }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">City</label>
                        <p>{{ $customer->city ?: '-' }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">State</label>
                        <p>{{ $customer->state ?: '-' }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Country</label>
                        <p>{{ $customer->country }}</p>
                    </div>

                    <div>
                        <label class="font-semibold">Pincode</label>
                        <p>{{ $customer->pincode ?: '-' }}</p>
                    </div>

                </div>

                <div class="px-6 pb-4">

                    <label class="font-semibold">
                        Address
                    </label>

                    <p class="mt-1">
                        {{ $customer->address ?: '-' }}
                    </p>

                </div>

                <div class="px-6 pb-4">

                    <label class="font-semibold">
                        Notes
                    </label>

                    <p class="mt-1">
                        {{ $customer->notes ?: '-' }}
                    </p>

                </div>

                <div class="px-6 pb-6">

                    <label class="font-semibold">
                        Status
                    </label>

                    <br>

                    @if($customer->status == 'Active')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            Active
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                            Inactive
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>