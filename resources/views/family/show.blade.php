<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $member->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p><span class="font-medium">Relationship:</span> {{ $member->relationship }}</p>
                <p><span class="font-medium">Date of birth:</span> {{ $member->date_of_birth->format('d M Y') }}</p>
                <p class="mt-3">
                    <a class="text-blue-600" href="{{ route('family.edit', $member) }}">Edit details</a>
                    &middot;
                    <a class="text-blue-600" href="{{ route('family.index') }}">Back to list</a>
                </p>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold">Health profile</h3>
                    <a class="text-blue-600" href="{{ route('health.edit', $member) }}">Edit health profile</a>
                </div>

                @php($profile = $member->healthProfile)
                <p><span class="font-medium">Blood group:</span> {{ $profile->blood_group ?? 'Not set' }}</p>
                <p>
                    <span class="font-medium">Emergency contact:</span>
                    @if ($profile && $profile->emergency_contact_name)
                        {{ $profile->emergency_contact_name }} ({{ $profile->emergency_contact_phone }})
                    @else
                        Not set
                    @endif
                </p>
                <p><span class="font-medium">Allergies:</span>
                    {{ $member->allergies->isEmpty() ? 'None recorded' : $member->allergies->pluck('name')->join(', ') }}
                </p>
                <p><span class="font-medium">Conditions:</span>
                    {{ $member->conditions->isEmpty() ? 'None recorded' : $member->conditions->pluck('name')->join(', ') }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
