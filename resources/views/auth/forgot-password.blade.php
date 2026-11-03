<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Forgot Password?</h2>
        <p class="text-gray-500">Enter your email address and we'll send you a link to reset your password.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2 uppercase tracking-wide">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 transition placeholder-gray-400"
                    placeholder="Enter Your Email">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 uppercase tracking-wide">
            Send Reset Link
        </button>

        <!-- Back to Login -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Remember your password? <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">Back to Login</a>
        </p>
    </form>
</x-guest-layout>
