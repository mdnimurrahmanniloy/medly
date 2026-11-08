<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Family Members</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <a href="{{ route('family.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Add family member
            </a>

            <div class="mt-4 bg-white shadow-sm sm:rounded-lg p-4">
                @if ($members->isEmpty())
                    <p class="text-gray-600">No family members yet. Add the first one.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Name</th>
                                <th>Relationship</th>
                                <th>Date of birth</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr class="border-b">
                                    <td class="py-2">{{ $member->name }}</td>
                                    <td>{{ $member->relationship }}</td>
                                    <td>{{ $member->date_of_birth->format('d M Y') }}</td>
                                    <td class="text-right space-x-2">
                                        <a class="text-blue-600" href="{{ route('family.show', $member) }}">View</a>
                                        <a class="text-blue-600" href="{{ route('family.edit', $member) }}">Edit</a>
                                        <form method="POST" action="{{ route('family.destroy', $member) }}" class="inline"
                                              onsubmit="return confirm('Remove this family member and their records?')">
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
