<x-app-layout>

<x-slot name="header">

<div class="flex justify-between items-center">

    <h2 class="text-2xl font-bold">

        Deleted Products

    </h2>

    <a href="{{ route('products.index') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

        Back

    </a>

</div>

</x-slot>

<div class="py-8">

<div class="max-w-7xl mx-auto">

@if(session('success'))

<div class="bg-green-100 text-green-700 p-4 rounded mb-5">

    {{ session('success') }}

</div>

@endif

<div class="bg-white shadow rounded-lg overflow-hidden">

<table class="min-w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Image</th>

<th>SKU</th>

<th>Name</th>

<th>Category</th>

<th>Brand</th>

<th>Status</th>

<th width="220">Action</th>

</tr>

</thead>

<tbody>

@forelse($products as $product)

<tr class="border-b hover:bg-gray-50">

<td class="p-3">

@if($product->image)

<img src="{{ $product->image_url }}"
     class="w-14 h-14 rounded object-cover">

@else

No Image

@endif

</td>

<td>

{{ $product->sku }}

</td>

<td>

{{ $product->product_name }}

</td>

<td>

{{ $product->category }}

</td>

<td>

{{ $product->brand }}

</td>

<td>

{{ $product->status }}

</td>

<td>

<div class="flex gap-2">

<form
action="{{ route('products.restore',$product->id) }}"
method="POST">

@csrf

<button
class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded">

Restore

</button>

</form>

<form
action="{{ route('products.forceDelete',$product->id) }}"
method="POST">

@csrf

@method('DELETE')

<button

onclick="return confirm('Delete Permanently?')"

class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">

Delete Forever

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7"
class="text-center py-6">

No Deleted Products Found

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

</x-app-layout>