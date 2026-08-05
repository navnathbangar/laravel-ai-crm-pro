<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Management
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                <!-- Total Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-blue-500 p-5">
                    <p class="text-gray-500 text-sm">Total Products</p>
                    <h2 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalProducts }}
                    </h2>
                </div>

                <!-- Active Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-green-500 p-5">
                    <p class="text-gray-500 text-sm">Active Products</p>
                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $activeProducts }}
                    </h2>
                </div>

                <!-- Inactive Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-yellow-500 p-5">
                    <p class="text-gray-500 text-sm">Inactive Products</p>
                    <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ $inactiveProducts }}
                    </h2>
                </div>

                <!-- Deleted Customers -->
                <div class="bg-white rounded-lg shadow border-l-4 border-red-500 p-5">
                    <p class="text-gray-500 text-sm">Deleted Products</p>
                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $deletedProducts }}
                    </h2>
                </div>

            </div>

            <div class="flex flex-wrap gap-3 mb-6">

                <a href="{{ route('products.index') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded-lg">
                    All
                </a>

                <a href="{{ route('products.index',['status'=>'Active']) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg">
                    Active
                </a>

                <a href="{{ route('products.index',['status'=>'Inactive']) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
                    Inactive
                </a>

                <a href="{{ route('products.trash') }}"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg">
                    Trash
                </a>

            </div>

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <div class="flex justify-between items-center mb-6">

                        <h2 class="text-2xl font-bold">
                            Products List
                        </h2>                        

                    </div>


                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                        <form method="GET" action="{{ route('products.index') }}" class="flex flex-1 gap-3"> 
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search Product..." class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"> 
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg"> Search </button> 
                        </form> 
                        <div class="flex gap-3"> 
                            <a href="{{ route('products.export.excel', ['search' => request('search')]) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"> 
                                Excel 
                            </a> 
                            <a href="{{ route('products.export.pdf', ['search' => request('search')]) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"> 
                                PDF 
                            </a> 
                            <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg"> 
                                + Add Product 
                            </a> 
                        </div> 
                    </div>
                    

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="border px-3 py-2">#</th>

                                    <th class="border px-3 py-2">Image</th>

                                    <th class="border px-3 py-2">SKU</th>

                                    <th class="border px-3 py-2">Name</th>

                                    <th class="border px-3 py-2">Category</th>

                                    <th class="border px-3 py-2">Brand</th>

                                    <th class="border px-3 py-2">Cost</th>

                                    <th class="border px-3 py-2">Price</th>

                                    <th class="border px-3 py-2">Stock</th>

                                    <th class="border px-3 py-2">Status</th>

                                    <th class="border px-3 py-2">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($products as $product)

                                <tr>

                                    <td class="border p-3">
                                        {{ $product->id }}
                                    </td>

                                    <td class="border p-3">

                                        @if($product->image_url)

                                            <img
                                                src="{{ $product->image_url }}"
                                                class="w-14 h-14 rounded object-cover border">

                                        @else

                                            <span class="text-gray-400">
                                                No Image
                                            </span>

                                        @endif

                                    </td>

                                    <td class="border p-3">

                                        {{ $product->sku }}

                                    </td>

                                    <td class="border p-3">
                                        {{ $product->product_name }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $product->category }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $product->brand }}
                                    </td>

                                    <td class="border p-3">

                                        ₹ {{ number_format($product->cost_price,2) }}

                                    </td>

                                    <td class="border p-3">

                                        ₹ {{ number_format($product->selling_price,2) }}

                                    </td>

                                    <td class="border p-3">

                                        {{ $product->stock }}

                                    </td>

                                    <td class="border p-3">

                                        @if($product->status=="Active")

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded">

                                        Active

                                        </span>

                                        @else

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded">

                                        Inactive

                                        </span>

                                        @endif

                                    </td>

                                    
                                    <td class="border p-3">

                                        <a href="{{ route('products.edit',$product) }}"
                                           class="text-blue-600 font-semibold">
                                            Edit
                                        </a>

                                        |

                                        <form
                                            action="{{ route('products.destroy',$product) }}"
                                            method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Delete Product?')"
                                                class="text-red-600 font-semibold">

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="text-center py-6">

                                        No Products Found

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-5">

                        {{ $products->links() }}

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>