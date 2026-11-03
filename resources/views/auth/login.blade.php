<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Login To Your Account</h2>
        <p class="text-gray-500">Enter your details to login.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2 uppercase tracking-wide">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 transition placeholder-gray-400"
                    placeholder="Enter Your Email">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2 uppercase tracking-wide">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 transition placeholder-gray-400"
                    placeholder="Enter Password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                <span class="ml-2 text-sm text-gray-600">Remember Me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-red-500 hover:text-red-600 font-medium" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 uppercase tracking-wide">
            Login
        </button>

        <!-- Terms -->
        <p class="text-center text-sm text-gray-500 mt-6">
            By clicking login, you agree to our <a href="#" class="text-blue-500 hover:underline">Terms & Conditions</a>!
        </p>
    </form>
</x-guest-layout>
