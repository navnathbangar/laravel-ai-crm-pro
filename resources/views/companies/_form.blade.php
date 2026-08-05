@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Company Code -->
    <div>
        <label class="block font-medium mb-2">Company Code <span class="text-red-500">*</span></label>
        <input type="text"
               name="company_code"
               value="{{ old('company_code', $company->company_code ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
        @error('company_code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Company Name -->
    <div>
        <label class="block font-medium mb-2">Company Name <span class="text-red-500">*</span></label>
        <input type="text"
               name="company_name"
               value="{{ old('company_name', $company->company_name ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
        @error('company_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Contact Person -->
    <div>
        <label class="block font-medium mb-2">Contact Person</label>
        <input type="text"
               name="contact_person"
               value="{{ old('contact_person', $company->contact_person ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- Email -->
    <div>
        <label class="block font-medium mb-2">Email</label>
        <input type="email"
               name="email"
               value="{{ old('email', $company->email ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Phone -->
    <div>
        <label class="block font-medium mb-2">Phone</label>
        <input type="text"
               name="phone"
               value="{{ old('phone', $company->phone ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- Website -->
    <div>
        <label class="block font-medium mb-2">Website</label>
        <input type="url"
               name="website"
               value="{{ old('website', $company->website ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- GST -->
    <div>
        <label class="block font-medium mb-2">GST Number</label>
        <input type="text"
               name="gst_number"
               value="{{ old('gst_number', $company->gst_number ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- Logo -->
    <div>
        <label class="block font-medium mb-2">Company Logo</label>

        <input type="file"
               name="logo"
               class="w-full border rounded-lg px-4 py-2">

        @if(isset($company) && $company->logo)
            <img src="{{ asset('storage/'.$company->logo) }}"
                 class="mt-3 w-24 h-24 object-cover rounded border">
        @endif
    </div>

    <!-- City -->
    <div>
        <label class="block font-medium mb-2">City</label>
        <input type="text"
               name="city"
               value="{{ old('city', $company->city ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- State -->
    <div>
        <label class="block font-medium mb-2">State</label>
        <input type="text"
               name="state"
               value="{{ old('state', $company->state ?? '') }}"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- Country -->
    <div>
        <label class="block font-medium mb-2">Country</label>
        <input type="text"
               name="country"
               value="{{ old('country', $company->country ?? 'India') }}"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <!-- Status -->
    <div>
        <label class="block font-medium mb-2">Status</label>

        <select name="status"
                class="w-full border rounded-lg px-4 py-2">

            <option value="Active"
                {{ old('status', $company->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="Inactive"
                {{ old('status', $company->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                Inactive
            </option>

        </select>
    </div>

</div>

<!-- Address -->
<div class="mt-6">
    <label class="block font-medium mb-2">Address</label>

    <textarea name="address"
              rows="4"
              class="w-full border rounded-lg px-4 py-2">{{ old('address', $company->address ?? '') }}</textarea>
</div>

<!-- Buttons -->
<div class="mt-8 flex gap-3">

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

        {{ isset($company) && $company->exists ? 'Update Company' : 'Save Company' }}

    </button>

    <a href="{{ route('companies.index') }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">

        Cancel

    </a>

</div>