@csrf

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="name">Name</label>
    <input id="name" name="name" type="text" required
           value="{{ old('name', $member->name ?? '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="relationship">Relationship (for example: Mother, Son)</label>
    <input id="relationship" name="relationship" type="text" required
           value="{{ old('relationship', $member->relationship ?? '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('relationship')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="date_of_birth">Date of birth</label>
    <input id="date_of_birth" name="date_of_birth" type="date" required
           value="{{ old('date_of_birth', isset($member) ? $member->date_of_birth->format('Y-m-d') : '') }}"
           class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
    @error('date_of_birth')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<button type="submit"
        class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
    Save
</button>
<a href="{{ route('family.index') }}" class="ml-3 text-gray-600">Cancel</a>
