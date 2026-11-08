@csrf

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="family_member_id">Family member</label>
    <select id="family_member_id" name="family_member_id" required class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
        <option value="">Choose...</option>
        @foreach ($members as $member)
            <option value="{{ $member->id }}" @selected((int) old('family_member_id', $appointment->family_member_id ?? 0) === $member->id)>
                {{ $member->name }}
            </option>
        @endforeach
    </select>
    @error('family_member_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="title">Title (for example: Dental check-up)</label>
    <input id="title" name="title" type="text" required
           value="{{ old('title', $appointment->title ?? '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="appointment_at">Date and time</label>
    <input id="appointment_at" name="appointment_at" type="datetime-local" required
           value="{{ old('appointment_at', isset($appointment) ? $appointment->appointment_at->format('Y-m-d\TH:i') : '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('appointment_at')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="location">Location</label>
    <input id="location" name="location" type="text"
           value="{{ old('location', $appointment->location ?? '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('location')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="notes">Notes</label>
    <textarea id="notes" name="notes" rows="3"
              class="mt-1 border-gray-300 rounded-md shadow-sm w-full">{{ old('notes', $appointment->notes ?? '') }}</textarea>
    @error('notes')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<button type="submit"
        class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
    Save
</button>
<a href="{{ route('appointments.index') }}" class="ml-3 text-gray-600">Cancel</a>
