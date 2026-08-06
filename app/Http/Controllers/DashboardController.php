<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Company;
use App\Models\Product;
use App\Models\Lead;
use App\Models\Task;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

            'customers' => Customer::count(),

            'companies' => Company::count(),

            'products' => Product::count(),

            'leads' => Lead::count(),

            'tasks' => Task::count(),

            'activeProducts' => Product::where('status', 'Active')->count(),

            'inactiveProducts' => Product::where('status', 'Inactive')->count(),

        ]);
    }
}
