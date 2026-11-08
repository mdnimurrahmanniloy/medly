<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Appointment</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($members->isEmpty())
                    <p class="text-gray-600">Add a family member first, then you can schedule an appointment.</p>
                @else
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @include('appointments._form')
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
