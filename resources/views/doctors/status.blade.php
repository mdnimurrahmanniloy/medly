<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Verification status</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p><span class="font-medium">License number:</span> {{ $profile->license_number }}</p>

                <p class="mt-3">
                    <span class="font-medium">Status:</span>
                    @if ($profile->status === 'approved')
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Approved</span>
                    @elseif ($profile->status === 'rejected')
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded">Rejected</span>
                    @else
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Pending review</span>
                    @endif
                </p>

                @if ($profile->status === 'rejected' && $profile->rejection_reason)
                    <p class="mt-3"><span class="font-medium">Reason:</span> {{ $profile->rejection_reason }}</p>
                @endif

                @if ($profile->status === 'pending')
                    <p class="mt-3 text-gray-600">An admin will review your license number soon.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
