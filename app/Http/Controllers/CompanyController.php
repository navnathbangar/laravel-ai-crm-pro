<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Storage;
use App\Exports\CompaniesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::query();
        if ($request->status) {

            $query->where('status', $request->status);

        }
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->Where('company_name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')
                ->orWhere('phone', 'like', '%'.$request->search.'%');

            });

        }
        $companies = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
        $search = $request->search;

        $totalCompanies = Company::count();

        $activeCompanies = Company::where('status','Active')->count();

        $inactiveCompanies = Company::where('status','Inactive')->count();

        $deletedCompanies = Company::onlyTrashed()->count();

        return view('companies.index', compact(
            'companies',
            'search',
            'totalCompanies',
            'activeCompanies',
            'inactiveCompanies',
            'deletedCompanies'
        ));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {

            $data['logo'] = $request
                ->file('logo')
                ->store('companies', 'public');
        }

        Company::create($data);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {

            if ($company->logo) {

                Storage::disk('public')->delete($company->logo);
            }

            $data['logo'] = $request
                ->file('logo')
                ->store('companies', 'public');
        }

        $company->update($data);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company moved to trash.');
    }

    public function trash()
    {
        $companies = Company::onlyTrashed()
            ->latest()
            ->paginate(10);

        return view('companies.trash', compact('companies'));
    }

    public function restore($id)
    {
        Company::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return redirect()
            ->route('companies.trash')
            ->with('success', 'Company restored successfully.');
    }

    public function forceDelete($id)
    {
        $company = Company::onlyTrashed()->findOrFail($id);

        if ($company->logo) {

            Storage::disk('public')->delete($company->logo);
        }

        $company->forceDelete();

        return redirect()
            ->route('companies.trash')
            ->with('success', 'Company permanently deleted.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new CompaniesExport($request->search),
            'companies.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $search = $request->search;

        $companies = Company::when($search, function ($query) use ($search) {

                $query->where('company_name', 'like', "%{$search}%")
                    ->orWhere('company_code', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");

            })
            ->orderBy('company_name')
            ->get();

        $pdf = Pdf::loadView(
            'companies.pdf',
            compact('companies', 'search')
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('companies.pdf');
    }
}
