<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="text-2xl font-bold">

                AI Settings Trash

            </h2>

            <a href="{{ route('ai-settings.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">

                Back

            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto">

            @if(session('success'))

                <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">

                    {{ session('success') }}

                </div>

            @endif

            <div class="bg-white shadow rounded-lg">

                <div class="p-6">

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="border px-3 py-2">#</th>

                                    <th class="border px-3 py-2">Provider</th>

                                    <th class="border px-3 py-2">Model</th>

                                    <th class="border px-3 py-2">Temperature</th>

                                    <th class="border px-3 py-2">Max Tokens</th>

                                    <th class="border px-3 py-2">Status</th>

                                    <th class="border px-3 py-2">Deleted At</th>

                                    <th class="border px-3 py-2">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($settings as $setting)

                                    <tr>

                                        <td class="border p-3">

                                            {{ $setting->id }}

                                        </td>

                                        <td class="border p-3">

                                            @if($setting->provider == 'OpenAI')

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

                                            @if($setting->status=='Active')

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

                                            {{ $setting->deleted_at->format('d M Y H:i') }}

                                        </td>

                                        <td class="border p-3">

                                            <form
                                                action="{{ route('ai-settings.restore',$setting->id) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf

                                                <button
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                                                    Restore

                                                </button>

                                            </form>

                                            <form
                                                action="{{ route('ai-settings.forceDelete',$setting->id) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Permanently delete this AI Setting?')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                                    Delete Permanently

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="8"
                                            class="text-center py-6 text-gray-500">

                                            No Deleted AI Settings Found.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-6">

                        {{ $settings->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>