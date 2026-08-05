<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <label class="block font-medium">Lead Code <span class="text-red-500">*</span></label>

        <input
            type="text"
            name="lead_code"
            value="{{ old('lead_code',$lead->lead_code ?? '') }}"
            class="w-full border rounded-lg mt-1">

        @error('lead_code')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">Lead Name <span class="text-red-500">*</span></label>

        <input
            type="text"
            name="lead_name"
            value="{{ old('lead_name',$lead->lead_name ?? '') }}"
            class="w-full border rounded-lg mt-1">

        @error('lead_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium">Company Name</label>

        <input
            type="text"
            name="company_name"
            value="{{ old('company_name',$lead->company_name ?? '') }}"
            class="w-full border rounded-lg mt-1">
    </div>

    <div>
        <label class="block font-medium">Email</label>

        <input
            type="email"
            name="email"
            value="{{ old('email',$lead->email ?? '') }}"
            class="w-full border rounded-lg mt-1">
    </div>

    <div>
        <label class="block font-medium">Phone</label>

        <input
            type="text"
            name="phone"
            value="{{ old('phone',$lead->phone ?? '') }}"
            class="w-full border rounded-lg mt-1">
    </div>

    <div>
        <label class="block font-medium">Source</label>

        <select
            name="source"
            class="w-full border rounded-lg mt-1">

            <option value="">Select Source</option>

            @foreach([
                'Website',
                'Google',
                'Facebook',
                'Instagram',
                'LinkedIn',
                'WhatsApp',
                'Referral',
                'Cold Call'
            ] as $source)

                <option
                    value="{{ $source }}"
                    {{ old('source',$lead->source ?? '')==$source ? 'selected':'' }}>

                    {{ $source }}

                </option>

            @endforeach

        </select>
    </div>

    <div>
        <label class="block font-medium">Status</label>

        <select
            name="status"
            class="w-full border rounded-lg mt-1">

            @foreach([
                'New',
                'Contacted',
                'Qualified',
                'Proposal',
                'Won',
                'Lost'
            ] as $status)

                <option
                    value="{{ $status }}"
                    {{ old('status',$lead->status ?? 'New')==$status ? 'selected':'' }}>

                    {{ $status }}

                </option>

            @endforeach

        </select>
    </div>

    <div>
        <label class="block font-medium">Expected Value</label>

        <input
            type="number"
            step="0.01"
            name="expected_value"
            value="{{ old('expected_value',$lead->expected_value ?? '') }}"
            class="w-full border rounded-lg mt-1">
    </div>

    <div>
        <label class="block font-medium">Follow Up Date</label>

        <input
            type="date"
            name="follow_up_date"
            value="{{ old('follow_up_date', isset($lead) && $lead->follow_up_date ? $lead->follow_up_date->format('Y-m-d') : '') }}"
            class="w-full border rounded-lg mt-1">
    </div>

    <div class="md:col-span-2">
        <label class="block font-medium">Notes</label>

        <textarea
            name="notes"
            rows="4"
            class="w-full border rounded-lg mt-1">{{ old('notes',$lead->notes ?? '') }}</textarea>
    </div>

</div>

<div class="mt-6">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

        Save

    </button>

</div>