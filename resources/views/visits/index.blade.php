<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Doctor Visits</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <a href="{{ route('visits.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Add visit
            </a>

            <div class="mt-4 bg-white shadow-sm sm:rounded-lg p-4">
                @if ($visits->isEmpty())
                    <p class="text-gray-600">No visits recorded yet.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Date</th>
                                <th>Family member</th>
                                <th>Doctor</th>
                                <th>Diagnosis</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                                <tr class="border-b align-top">
                                    <td class="py-2">{{ $visit->visit_date->format('d M Y') }}</td>
                                    <td>{{ $visit->familyMember->name }}</td>
                                    <td>{{ $visit->doctor_name }}</td>
                                    <td>
                                        {{ $visit->diagnosis ?? '-' }}
                                        @if ($visit->notes)
                                            <div class="text-gray-500">{{ $visit->notes }}</div>
                                        @endif
                                    </td>
                                    <td class="text-right space-x-2">
                                        <a class="text-blue-600" href="{{ route('visits.edit', $visit) }}">Edit</a>
                                        <form method="POST" action="{{ route('visits.destroy', $visit) }}" class="inline"
                                              onsubmit="return confirm('Delete this visit?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
