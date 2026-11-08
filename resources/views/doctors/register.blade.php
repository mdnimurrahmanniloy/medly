<x-guest-layout>
    <h2 class="text-lg font-semibold mb-4">Doctor registration</h2>
    <p class="text-sm text-gray-600 mb-4">
        After you register, an admin checks your license number. You can use the doctor features once you are approved.
    </p>

    <form method="POST" action="{{ route('doctor.register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="name">Full name</label>
            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                   class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                   class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="license_number">Medical license number</label>
            <input id="license_number" name="license_number" type="text" required value="{{ old('license_number') }}"
                   class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
            @error('license_number')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
            <input id="password" name="password" type="password" required
                   class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
            @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="mt-1 border-gray-300 rounded-md shadow-sm w-full">
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            Register as doctor
        </button>
        <a href="{{ route('login') }}" class="ml-3 text-sm text-gray-600">Back to login</a>
    </form>
</x-guest-layout>
