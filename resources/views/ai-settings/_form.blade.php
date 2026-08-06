<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <label class="block font-medium">
            AI Provider
            <span class="text-red-500">*</span>
        </label>

        <select
            name="provider"
            class="w-full mt-1 rounded-lg border-gray-300">

            @foreach(['OpenAI','Gemini'] as $provider)

                <option
                    value="{{ $provider }}"
                    {{ old('provider',$ai_setting->provider ?? 'OpenAI')==$provider ? 'selected':'' }}>

                    {{ $provider }}

                </option>

            @endforeach

        </select>

        @error('provider')

            <p class="text-red-500 text-sm mt-1">

                {{ $message }}

            </p>

        @enderror

    </div>


    <div>

        <label class="block font-medium">

            AI Model

        </label>

        <input
            type="text"
            name="model"
            value="{{ old('model',$ai_setting->model ?? 'gpt-4.1-mini') }}"
            class="w-full mt-1 rounded-lg border-gray-300">

        @error('model')

            <p class="text-red-500 text-sm">

                {{ $message }}

            </p>

        @enderror

    </div>


    <div class="md:col-span-2">

        <label class="block font-medium">

            API Key

        </label>

        <textarea
            rows="3"
            name="api_key"
            class="w-full mt-1 rounded-lg border-gray-300">{{ old('api_key',$ai_setting->api_key ?? '') }}</textarea>

        @error('api_key')

            <p class="text-red-500 text-sm">

                {{ $message }}

            </p>

        @enderror

    </div>


    <div>

        <label class="block font-medium">

            Temperature

        </label>

        <input
            type="number"
            step="0.1"
            min="0"
            max="2"
            name="temperature"
            value="{{ old('temperature',$ai_setting->temperature ?? 0.7) }}"
            class="w-full mt-1 rounded-lg border-gray-300">

    </div>


    <div>

        <label class="block font-medium">

            Max Tokens

        </label>

        <input
            type="number"
            name="max_tokens"
            value="{{ old('max_tokens',$ai_setting->max_tokens ?? 500) }}"
            class="w-full mt-1 rounded-lg border-gray-300">

    </div>


    <div>

        <label class="block font-medium">

            Status

        </label>

        <select
            name="status"
            class="w-full mt-1 rounded-lg border-gray-300">

            @foreach(['Active','Inactive'] as $status)

                <option
                    value="{{ $status }}"
                    {{ old('status',$ai_setting->status ?? 'Active')==$status ? 'selected':'' }}>

                    {{ $status }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="mt-6">

    <button
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">

        Save AI Setting

    </button>

</div>