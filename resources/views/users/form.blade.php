<x-app-layout>
    <x-slot name="header">{{ $user->exists ? 'Edit User' : 'Add New User' }}</x-slot>

    <div class="max-w-xl">
        <form method="POST" action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            @csrf
            @if($user->exists)
                @method('PUT')
            @endif

            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                    <select name="role" id="role" required class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                        @foreach($roles as $value => $label)
                            <option value="{{ $value }}" {{ old('role', $user->role ?? 'staff') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password {{ $user->exists ? '(leave blank to keep current)' : '*' }}
                    </label>
                    <input type="password" name="password" id="password" {{ $user->exists ? '' : 'required' }}
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition">
                    {{ $user->exists ? 'Update User' : 'Create User' }}
                </button>
                <a href="{{ route('users.index') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
