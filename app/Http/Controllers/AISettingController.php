<?php

namespace App\Http\Controllers;

use App\Http\Requests\AISettingRequest;
use App\Models\AISetting;
use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Services\GeminiService;

class AISettingController extends Controller
{
    public function index(Request $request)
    {
        $query = AISetting::query();
        if ($request->provider) {

            $query->where('provider', $request->provider);

        }
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->Where('provider', 'like', '%'.$request->search.'%')
                ->orWhere('model', 'like', '%'.$request->search.'%');

            });

        }
        $settings = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
        $search = $request->search;

        
        $totalSettings=AISetting::count();

        $activeSettings=AISetting::where(
            'status',
            'Active'
        )->count();

        $inactiveSettings=AISetting::where(
            'status',
            'Inactive'
        )->count();

        $deletedSettings=AISetting::onlyTrashed()->count();

        $openaiCount=AISetting::where(
            'provider',
            'OpenAI'
        )->count();

        $geminiCount=AISetting::where(
            'provider',
            'Gemini'
        )->count();

        return view(
            'ai-settings.index',
            compact(

                'settings',

                'search',

                'totalSettings',

                'activeSettings',

                'inactiveSettings',

                'deletedSettings',

                'openaiCount',

                'geminiCount'

            )
        );
    }

    public function create()
    {
        return view('ai-settings.create');
    }

    public function store(AISettingRequest $request)
    {
        AISetting::create($request->validated());

        return redirect()

            ->route('ai-settings.index')

            ->with('success', 'AI Setting created successfully.');
    }

    public function edit(AISetting $ai_setting)
    {
        return view(
            'ai-settings.edit',
            compact('ai_setting')
        );
    }

    public function update(
        AISettingRequest $request,
        AISetting $ai_setting
    ) {
        $ai_setting->update($request->validated());

        return redirect()

            ->route('ai-settings.index')

            ->with('success', 'AI Setting updated successfully.');
    }

    public function destroy(AISetting $ai_setting)
    {
        $ai_setting->delete();

        return redirect()

            ->route('ai-settings.index')

            ->with('success', 'AI Setting deleted successfully.');
    }

    public function trash()
    {
        $settings=AISetting::onlyTrashed()

            ->latest()

            ->paginate(10);

        return view(
            'ai-settings.trash',
            compact('settings')
        );
    }

    public function restore($id)
    {
        AISetting::onlyTrashed()

            ->findOrFail($id)

            ->restore();

        return redirect()

            ->route('ai-settings.trash')

            ->with(
                'success',
                'AI Setting restored successfully.'
            );
    }

    public function forceDelete($id)
    {
        AISetting::onlyTrashed()

            ->findOrFail($id)

            ->forceDelete();

        return redirect()

            ->route('ai-settings.trash')

            ->with(
                'success',
                'AI Setting permanently deleted.'
            );
    }

    public function testConnection(OpenAIService $openAI)
    {
        try {

            $reply = $openAI->generate(

                "Reply with exactly: OpenAI Connection Successful"

            );

            return back()->with(
                'success',
                trim($reply)
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    public function testConnectionGemini(GeminiService $gemini)
    {
        try {

            $reply = $gemini->generate(

                'Say only: Gemini Connection Successful'

            );

            return back()->with(

                'success',

                $reply

            );

        } catch (\Exception $e) {

            return back()->with(

                'error',

                $e->getMessage()

            );
        }
    }
}