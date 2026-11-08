<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Doctor verification</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                @if ($profiles->isEmpty())
                    <p class="text-gray-600">No doctors have registered yet.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Doctor</th>
                                <th>License number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profiles as $profile)
                                <tr class="border-b align-top">
                                    <td class="py-2">
                                        {{ $profile->user->name }}
                                        <div class="text-gray-500">{{ $profile->user->email }}</div>
                                    </td>
                                    <td>{{ $profile->license_number }}</td>
                                    <td>
                                        {{ ucfirst($profile->status) }}
                                        @if ($profile->rejection_reason)
                                            <div class="text-gray-500">{{ $profile->rejection_reason }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($profile->status !== 'approved')
                                            <form method="POST" action="{{ route('admin.doctors.approve', $profile) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-700">Approve</button>
                                            </form>
                                        @endif

                                        @if ($profile->status !== 'rejected')
                                            <form method="POST" action="{{ route('admin.doctors.reject', $profile) }}" class="mt-2 flex gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input name="rejection_reason" type="text" required placeholder="Reason for rejecting"
                                                       class="border-gray-300 rounded-md shadow-sm text-sm">
                                                <button type="submit" class="text-red-600">Reject</button>
                                            </form>
                                        @endif
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
