<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Health profile: {{ $member->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            @php($profile = $member->healthProfile)

            {{-- Basic details --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('health.update', $member) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="blood_group">Blood group</label>
                        <select id="blood_group" name="blood_group" class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
                            <option value="">Not set</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                <option value="{{ $group }}" @selected(old('blood_group', $profile->blood_group ?? '') === $group)>{{ $group }}</option>
                            @endforeach
                        </select>
                        @error('blood_group')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="emergency_contact_name">Emergency contact name</label>
                        <input id="emergency_contact_name" name="emergency_contact_name" type="text"
                               value="{{ old('emergency_contact_name', $profile->emergency_contact_name ?? '') }}"
                               class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
                        @error('emergency_contact_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="emergency_contact_phone">Emergency contact phone</label>
                        <input id="emergency_contact_phone" name="emergency_contact_phone" type="text"
                               value="{{ old('emergency_contact_phone', $profile->emergency_contact_phone ?? '') }}"
                               class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
                        @error('emergency_contact_phone')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Save details
                    </button>
                </form>
            </div>

            {{-- Allergies --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-3">Allergies</h3>
                <ul class="mb-3">
                    @forelse ($member->allergies as $allergy)
                        <li class="flex justify-between border-b py-1">
                            <span>{{ $allergy->name }}</span>
                            <form method="POST" action="{{ route('allergies.destroy', $allergy) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm">Remove</button>
                            </form>
                        </li>
                    @empty
                        <li class="text-gray-600">No allergies recorded.</li>
                    @endforelse
                </ul>
                <form method="POST" action="{{ route('allergies.store', $member) }}" class="flex gap-2">
                    @csrf
                    <input name="name" type="text" required placeholder="Add an allergy"
                           class="border-gray-300 rounded-md shadow-sm flex-1">
                    <button type="submit" class="px-4 py-2 bg-gray-800 rounded-md text-xs text-white uppercase">Add</button>
                </form>
            </div>

            {{-- Conditions --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-3">Conditions</h3>
                <ul class="mb-3">
                    @forelse ($member->conditions as $condition)
                        <li class="flex justify-between border-b py-1">
                            <span>{{ $condition->name }}</span>
                            <form method="POST" action="{{ route('conditions.destroy', $condition) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm">Remove</button>
                            </form>
                        </li>
                    @empty
                        <li class="text-gray-600">No conditions recorded.</li>
                    @endforelse
                </ul>
                <form method="POST" action="{{ route('conditions.store', $member) }}" class="flex gap-2">
                    @csrf
                    <input name="name" type="text" required placeholder="Add a condition"
                           class="border-gray-300 rounded-md shadow-sm flex-1">
                    <button type="submit" class="px-4 py-2 bg-gray-800 rounded-md text-xs text-white uppercase">Add</button>
                </form>
            </div>

            <a class="text-blue-600" href="{{ route('family.show', $member) }}">Back to {{ $member->name }}</a>
        </div>
    </div>
</x-app-layout>
