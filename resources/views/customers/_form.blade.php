@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Customer Code -->
    <div>
        <label class="block font-semibold mb-2">
            Customer Code <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="customer_code"
            value="{{ old('customer_code', $customer->customer_code ?? $customerCode ?? '') }}"
            readonly
            class="w-full rounded-lg bg-gray-100 border-gray-300">

        @error('customer_code')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Customer Name -->
    <div>
        <label class="block font-semibold mb-2">
            Customer Name <span class="text-red-500">*</span>
        </label>

        <input type="text"
               name="name"
               value="{{ old('name', $customer->name ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label class="block font-semibold mb-2">
            Email <span class="text-red-500">*</span>
        </label>

        <input type="email"
               name="email"
               value="{{ old('email', $customer->email ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Phone -->
    <div>
        <label class="block font-semibold mb-2">
            Phone <span class="text-red-500">*</span>
        </label>

        <input type="text"
               name="phone"
               value="{{ old('phone', $customer->phone ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        @error('phone')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Company -->
    <div>
        <label class="block font-semibold mb-2">
            Company
        </label>

        <input type="text"
               name="company_name"
               value="{{ old('company_name', $customer->company_name ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <!-- GST -->
    <div>
        <label class="block font-semibold mb-2">
            GST Number
        </label>

        <input type="text"
               name="gst_number"
               value="{{ old('gst_number', $customer->gst_number ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <!-- City -->
    <div>
        <label class="block font-semibold mb-2">
            City
        </label>

        <input type="text"
               name="city"
               value="{{ old('city', $customer->city ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <!-- State -->
    <div>
        <label class="block font-semibold mb-2">
            State
        </label>

        <input type="text"
               name="state"
               value="{{ old('state', $customer->state ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <!-- Country -->
    <div>
        <label class="block font-semibold mb-2">
            Country
        </label>

        <input type="text"
               name="country"
               value="{{ old('country', $customer->country ?? 'India') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <!-- Pincode -->
    <div>
        <label class="block font-semibold mb-2">
            Pincode
        </label>

        <input type="text"
               name="pincode"
               value="{{ old('pincode', $customer->pincode ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
    </div>

</div>

<!-- Address -->
<div class="mt-6">
    <label class="block font-semibold mb-2">
        Address
    </label>

    <textarea name="address"
              rows="3"
              class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('address', $customer->address ?? '') }}</textarea>
</div>

<!-- Notes -->
<div class="mt-6">
    <label class="block font-semibold mb-2">
        Notes
    </label>

    <textarea name="notes"
              rows="3"
              class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $customer->notes ?? '') }}</textarea>
</div>

<!-- Status -->
<div class="mt-6">
    <label class="block font-semibold mb-2">
        Status
    </label>

    <select name="status"
            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        <option value="Active"
            {{ old('status', $customer->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
            Active
        </option>

        <option value="Inactive"
            {{ old('status', $customer->status ?? '') == 'Inactive' ? 'selected' : '' }}>
            Inactive
        </option>

    </select>
</div>

<!-- Buttons -->
<div class="mt-8 flex gap-3">

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
        {{ isset($customer) ? 'Update Customer' : 'Save Customer' }}
    </button>

    <a href="{{ route('customers.index') }}"
       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
        Cancel
    </a>

</div>