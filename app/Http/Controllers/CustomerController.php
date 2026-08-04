<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->status) {

            $query->where('status', $request->status);

        }

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('customer_code', 'like', '%'.$request->search.'%')
                ->orWhere('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')
                ->orWhere('phone', 'like', '%'.$request->search.'%');

            });

        }

        $customers = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
        $search = $request->search;

        $totalCustomers = Customer::count();

        $activeCustomers = Customer::where('status','Active')->count();

        $inactiveCustomers = Customer::where('status','Inactive')->count();

        $deletedCustomers = Customer::onlyTrashed()->count();

        return view('customers.index', compact(
            'customers',
            'search',
            'totalCustomers',
            'activeCustomers',
            'inactiveCustomers',
            'deletedCustomers'
        ));
    }

    
    public function create()
    {
        $lastCustomer = Customer::latest('id')->first();

        if ($lastCustomer) {

            $number = (int) str_replace('CUST', '', $lastCustomer->customer_code);

            $customerCode = 'CUST'.str_pad($number + 1, 4, '0', STR_PAD_LEFT);

        } else {

            $customerCode = 'CUST0001';

        }
        return view('customers.create',compact('customerCode'));
    }

   
    public function store(CustomerRequest $request)
    {
        Customer::create($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }
    
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }
    
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    public function restore($id)
    {
        Customer::withTrashed()
            ->findOrFail($id)
            ->restore();

        return back()->with('success','Customer restored successfully.');
    }

    public function trash()
    {
        $customers = Customer::onlyTrashed()
                        ->paginate(10);

        return view('customers.trash', compact('customers'));
    }

    public function forceDelete($id)
    {
        Customer::withTrashed()
                ->findOrFail($id)
                ->forceDelete();

        return back()
            ->with('success',
            'Customer permanently deleted.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new CustomersExport($request),
            'customers.xlsx'
        );
    }

    public function exportPdf()
    {
        $customers = Customer::all();

        $pdf = Pdf::loadView(
            'customers.pdf',
            compact('customers')
        );

        return $pdf->download('customers.pdf');
    }
}
