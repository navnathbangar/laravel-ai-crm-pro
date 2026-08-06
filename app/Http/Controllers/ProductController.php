<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::when($search, function ($query) use ($search) {

                $query->where('product_name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%");

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        $totalProducts = Product::count();

        $activeProducts = Product::where('status','Active')->count();

        $inactiveProducts = Product::where('status','Inactive')->count();

        $deletedProducts = Product::onlyTrashed()->count();

        return view('products.index', compact(

            'products',

            'search',

            'totalProducts',

            'activeProducts',

            'inactiveProducts',

            'deletedProducts'

        ));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image')
                                    ->store('products','public');
        }

        $data['created_by'] = auth()->id();
        $data['ai_generated'] = !empty($request->description);
        $product = Product::create($data);

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $image) {

                $path = $image->store('products/gallery', 'public');

                $product->images()->create([
                    'image' => $path
                ]);

            }
        }

        return redirect()

            ->route('products.index')

            ->with('success','Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($product->image) {

                Storage::disk('public')->delete($product->image);

            }

            $data['image'] = $request->file('image')
                                    ->store('products','public');
        }

        $data['ai_generated'] = !empty($request->description);

        $product->update($data);

        return redirect()

            ->route('products.index')

            ->with('success','Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()

            ->with('success','Product moved to trash.');
    }

    public function trash()
    {
        $products = Product::onlyTrashed()
                    ->latest()
                    ->paginate(10);

        return view('products.trash', compact('products'));
    }

    public function restore($id)
    {
        Product::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return redirect()
            ->route('products.trash')
            ->with('success', 'Product restored successfully.');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        if ($product->image) {

            Storage::disk('public')->delete($product->image);

        }

        $product->forceDelete();

        return redirect()
            ->route('products.trash')
            ->with('success', 'Product deleted permanently.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ProductsExport($request->search),
            'products.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $search = $request->search;

        $products = Product::when($search, function ($query) use ($search) {

                $query->where('product_name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%");

            })
            ->orderBy('product_name')
            ->get();

        $pdf = Pdf::loadView(
            'products.pdf',
            compact('products', 'search')
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('products.pdf');
    }
}
