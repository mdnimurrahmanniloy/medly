<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Appointments</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <a href="{{ route('appointments.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Add appointment
            </a>

            @foreach ([['Upcoming', $upcoming], ['Past', $past]] as [$heading, $list])
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $heading }}</h3>
                    @if ($list->isEmpty())
                        <p class="text-gray-600">Nothing here.</p>
                    @else
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2">When</th>
                                    <th>Family member</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $appointment)
                                    <tr class="border-b align-top">
                                        <td class="py-2">{{ $appointment->appointment_at->format('d M Y, H:i') }}</td>
                                        <td>{{ $appointment->familyMember->name }}</td>
                                        <td>
                                            {{ $appointment->title }}
                                            @if ($appointment->notes)
                                                <div class="text-gray-500">{{ $appointment->notes }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $appointment->location ?? '-' }}</td>
                                        <td class="text-right space-x-2">
                                            <a class="text-blue-600" href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                                            <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" class="inline"
                                                  onsubmit="return confirm('Delete this appointment?')">
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
            @endforeach
        </div>
    </div>
</x-app-layout>
