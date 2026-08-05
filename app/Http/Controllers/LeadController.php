<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use App\Exports\LeadsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $leads = Lead::query()

            ->when($search, function ($query) use ($search) {

                $query->where('lead_code','like',"%{$search}%")
                    ->orWhere('lead_name','like',"%{$search}%")
                    ->orWhere('company_name','like',"%{$search}%")
                    ->orWhere('email','like',"%{$search}%")
                    ->orWhere('phone','like',"%{$search}%");

            })

            ->when($request->status, function($query) use($request){

                $query->where('status',$request->status);

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();



        // Dashboard Counts

        $totalLeads = Lead::count();


        $activeLeads = Lead::whereIn('status',[

            'Contacted',
            'Qualified',
            'Proposal'

        ])->count();



        $newLeads = Lead::where('status','New')->count();



        $deletedLeads = Lead::onlyTrashed()->count();



        return view('leads.index',compact(

            'leads',
            'search',
            'totalLeads',
            'activeLeads',
            'newLeads',
            'deletedLeads'

        ));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(LeadRequest $request)
    {
        $data = $request->validated();

        $data['created_by'] = auth()->id();

        Lead::create($data);

        return redirect()
                ->route('leads.index')
                ->with('success', 'Lead created successfully.');
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    public function update(LeadRequest $request, Lead $lead)
    {
        $lead->update($request->validated());

        return redirect()
                ->route('leads.index')
                ->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()
                ->route('leads.index')
                ->with('success', 'Lead moved to trash.');
    }

    public function trash()
    {
        $leads = Lead::onlyTrashed()
                    ->latest()
                    ->paginate(10);

        return view('leads.trash', compact('leads'));
    }

    public function restore($id)
    {
        Lead::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return redirect()
                ->route('leads.trash')
                ->with('success', 'Lead restored successfully.');
    }

    public function forceDelete($id)
    {
        Lead::onlyTrashed()
            ->findOrFail($id)
            ->forceDelete();

        return redirect()
                ->route('leads.trash')
                ->with('success', 'Lead permanently deleted.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(

            new LeadsExport($request->search),

            'leads.xlsx'

        );
    }

    public function exportPdf(Request $request)
    {

        $leads = Lead::query()

            ->when($request->search,function($query) use($request){

                $query->where('lead_code','like','%'.$request->search.'%')
                ->orWhere('lead_name','like','%'.$request->search.'%')
                ->orWhere('company_name','like','%'.$request->search.'%')
                ->orWhere('email','like','%'.$request->search.'%')
                ->orWhere('phone','like','%'.$request->search.'%');

            })

            ->get();


        $pdf = Pdf::loadView(
            'leads.pdf',
            compact('leads')
        );


        return $pdf->download('leads-report.pdf');

    }
}
