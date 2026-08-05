<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeadRequest;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $leads = Lead::query()

            ->when($search, function ($query) use ($search) {

                $query->where('lead_code', 'like', "%{$search}%")
                    ->orWhere('lead_name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('leads.index', compact('leads', 'search'));
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
}
