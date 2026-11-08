@csrf

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="family_member_id">Family member</label>
    <select id="family_member_id" name="family_member_id" required class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
        <option value="">Choose...</option>
        @foreach ($members as $member)
            <option value="{{ $member->id }}" @selected((int) old('family_member_id', $visit->family_member_id ?? 0) === $member->id)>
                {{ $member->name }}
            </option>
        @endforeach
    </select>
    @error('family_member_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="doctor_name">Doctor name</label>
    <input id="doctor_name" name="doctor_name" type="text" required
           value="{{ old('doctor_name', $visit->doctor_name ?? '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('doctor_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="visit_date">Visit date</label>
    <input id="visit_date" name="visit_date" type="date" required
           value="{{ old('visit_date', isset($visit) ? $visit->visit_date->format('Y-m-d') : '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('visit_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="diagnosis">Diagnosis</label>
    <input id="diagnosis" name="diagnosis" type="text"
           value="{{ old('diagnosis', $visit->diagnosis ?? '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('diagnosis')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="notes">Notes</label>
    <textarea id="notes" name="notes" rows="4"
              class="mt-1 border-gray-300 rounded-md shadow-sm w-full">{{ old('notes', $visit->notes ?? '') }}</textarea>
    @error('notes')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<button type="submit"
        class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
    Save
</button>
<a href="{{ route('visits.index') }}" class="ml-3 text-gray-600">Cancel</a>
