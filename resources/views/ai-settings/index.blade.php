<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold">

            AI Integration Settings

        </h2>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto">

            {{-- Dashboard Cards --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                <div class="bg-white rounded-lg shadow border-l-4 border-blue-500 p-5">

                    <p class="text-gray-500 text-sm">

                        Total Settings

                    </p>

                    <h2 class="text-3xl font-bold text-blue-600 mt-2">

                        {{ $totalSettings }}

                    </h2>

                </div>

                <div class="bg-white rounded-lg shadow border-l-4 border-green-500 p-5">

                    <p class="text-gray-500 text-sm">

                        Active

                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">

                        {{ $activeSettings }}

                    </h2>

                </div>

                <div class="bg-white rounded-lg shadow border-l-4 border-yellow-500 p-5">

                    <p class="text-gray-500 text-sm">

                        OpenAI

                    </p>

                    <h2 class="text-3xl font-bold text-yellow-600 mt-2">

                        {{ $openaiCount }}

                    </h2>

                </div>

                <div class="bg-white rounded-lg shadow border-l-4 border-purple-500 p-5">

                    <p class="text-gray-500 text-sm">

                        Gemini

                    </p>

                    <h2 class="text-3xl font-bold text-purple-600 mt-2">

                        {{ $geminiCount }}

                    </h2>

                </div>

            </div>

            {{-- Filter Buttons --}}

            <div class="flex flex-wrap gap-3 mb-6">

                <a href="{{ route('ai-settings.index') }}"
                    class="bg-gray-700 text-white px-4 py-2 rounded-lg">

                    All

                </a>

                <a href="{{ route('ai-settings.index',['provider'=>'OpenAI']) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg">

                    OpenAI

                </a>

                <a href="{{ route('ai-settings.index',['provider'=>'Gemini']) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                    Gemini

                </a>

                <a href="{{ route('ai-settings.trash') }}"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg">
                    Trash
                </a>

            </div>

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <div class="flex justify-between items-center mb-6">

                        <h2 class="text-2xl font-bold">

                            AI Settings

                        </h2>

                    </div>

                    @if(session('success'))

                        <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                            {{ session('success') }}

                        </div>

                    @endif

                    @if(session('error'))

                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">

                        {{ session('error') }}

                    </div>

                    @endif

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                        <form
                            action="{{ route('ai-settings.index') }}"
                            method="GET"
                            class="flex flex-1 gap-3">

                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search Provider..."
                                class="flex-1 rounded-lg border-gray-300">

                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

                                Search

                            </button>

                        </form>
                        <form
                            action="{{ route('ai-settings.test') }}"
                            method="POST">

                            @csrf

                            <button
                                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">

                                Test Connection OpenAI

                            </button>

                        </form>

                        <form action="{{ route('ai-settings.testGemini') }}" method="POST">

                            @csrf

                            <button
                                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">

                                Test Gemini

                            </button>

                        </form>

                        <div class="flex gap-3">

                            

                            <a
                                href="{{ route('ai-settings.create') }}"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">

                                + Add Setting

                            </a>

                        </div>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="border p-3">#</th>

                                    <th class="border p-3">Provider</th>

                                    <th class="border p-3">Model</th>

                                    <th class="border p-3">Temperature</th>

                                    <th class="border p-3">Max Tokens</th>

                                    <th class="border p-3">Status</th>

                                    <th class="border p-3">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($settings as $setting)

                                    <tr>

                                        <td class="border p-3">

                                            {{ $setting->id }}

                                        </td>

                                        <td class="border p-3">

                                            @if($setting->provider=="OpenAI")

                                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded">

                                                    OpenAI

                                                </span>

                                            @else

                                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded">

                                                    Gemini

                                                </span>

                                            @endif

                                        </td>

                                        <td class="border p-3">

                                            {{ $setting->model }}

                                        </td>

                                        <td class="border p-3">

                                            {{ $setting->temperature }}

                                        </td>

                                        <td class="border p-3">

                                            {{ $setting->max_tokens }}

                                        </td>

                                        <td class="border p-3">

                                            @if($setting->status=="Active")

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

                                            <a
                                                href="{{ route('ai-settings.edit',$setting) }}"
                                                class="text-blue-600 font-semibold">

                                                Edit

                                            </a>

                                            |

                                            <form
                                                action="{{ route('ai-settings.destroy',$setting) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Delete Setting?')"
                                                    class="text-red-600 font-semibold">

                                                    Delete

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="7"
                                            class="text-center py-6">

                                            No AI Settings Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-5">

                        {{ $settings->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>