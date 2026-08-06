<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-3xl font-bold">
                    Welcome, {{ Auth::user()->name }} 👋
                </h2>

                <p class="mt-2 text-blue-100">
                    Welcome to AI CRM Pro Dashboard.
                </p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-white rounded-xl shadow p-5">
                    <h4 class="text-gray-500 text-sm">Customers</h4>
                    <h2 class="text-3xl font-bold text-blue-600">
                        {{ $customers }}
                    </h2>
                </div>

                <div class="bg-white rounded-xl shadow p-5">
                    <h4 class="text-gray-500 text-sm">Companies</h4>
                    <h2 class="text-3xl font-bold text-green-600">
                        {{ $companies }}
                    </h2>
                </div>

                <div class="bg-white rounded-xl shadow p-5">
                    <h4 class="text-gray-500 text-sm">Products</h4>
                    <h2 class="text-3xl font-bold text-purple-600">
                        {{ $products }}
                    </h2>
                </div>

                <div class="bg-white rounded-xl shadow p-5">
                    <h4 class="text-gray-500 text-sm">Leads</h4>
                    <h2 class="text-3xl font-bold text-red-600">
                        {{ $leads }}
                    </h2>
                </div>

                

            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-semibold mb-4">
                        Quick Actions
                    </h3>

                    <div class="flex flex-wrap gap-3">

                        <a href="{{ route('customers.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                            Add Customer
                        </a>

                        <a href="{{ route('companies.create') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                            Add Company
                        </a>

                        <a href="{{ route('products.create') }}"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg">
                            Add Product
                        </a>

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="text-xl font-semibold mb-4">
                        System Status
                    </h3>

                    <ul class="space-y-2">

                        <li>✅ Authentication Working</li>
                        <li>✅ Dashboard Ready</li>
                        <li>✅ Laravel 12</li>
                        <li>✅ Tailwind CSS</li>

                    </ul>

                </div>

            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-xl shadow">

                <div class="border-b px-6 py-4">
                    <h3 class="text-xl font-semibold">
                        Recent Activities
                    </h3>
                </div>

                <div class="p-6">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b">

                                <th class="text-left py-3">Activity</th>
                                <th class="text-left py-3">User</th>
                                <th class="text-left py-3">Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr class="border-b">

                                <td class="py-3">
                                    Dashboard Login
                                </td>

                                <td>
                                    {{ Auth::user()->name }}
                                </td>

                                <td>
                                    {{ now()->format('d M Y h:i A') }}
                                </td>

                            </tr>

                            <tr>

                                <td colspan="3" class="text-center py-6 text-gray-500">
                                    No more activities found.
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>