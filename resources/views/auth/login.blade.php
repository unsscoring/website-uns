<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-white via-red-50 to-white p-6">
        <div class="bg-white backdrop-blur-md rounded-2xl shadow-lg max-w-md w-full overflow-hidden">
            <!-- subtle red top accent -->
            <div class="h-1 bg-gradient-to-r from-red-400 via-red-500 to-red-600"></div>

            <div class="p-8">
                <header class="mb-6 text-center">
                    <h1 class="text-3xl font-extrabold text-gray-900">Selamat datang</h1>
                    <p class="mt-2 text-sm text-gray-600">Masuk untuk melanjutkan ke dashboard Anda</p>
                </header>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm"
                                 type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mb-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm"
                                 type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="flex items-center text-sm text-gray-600">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ms-2">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-red-600 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center">
                        <x-button class="w-full justify-center py-2 bg-red-600 hover:bg-red-700">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="flex items-center">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <div class="px-3 text-sm text-gray-500">atau masuk dengan</div>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    <div class="mt-4">
                        <a href="{{url('/oauth/google')}}" class="inline-flex items-center justify-center w-full px-4 py-2 rounded-lg border border-red-100 bg-white text-sm text-gray-700 hover:shadow transition">
                            <!-- simple Google icon -->
                            <svg class="w-5 h-5 me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 12.23c0-.72-.06-1.41-.17-2.07H12v3.92h4.84c-.21 1.12-.86 2.07-1.83 2.71v2.26h2.95c1.73-1.59 2.73-3.94 2.73-6.82z" fill="#4285F4"/>
                                <path d="M12 22c2.43 0 4.46-.8 5.95-2.17l-2.95-2.26c-.82.55-1.86.88-3  .88-2.31 0-4.27-1.56-4.97-3.66H3.93v2.3C5.4 19.94 8.49 22 12 22z" fill="#34A853"/>
                                <path d="M7.03 13.79A5.99 5.99 0 0 1 6.6 12c0-.6.1-1.18.33-1.72V7.98H3.93A9.99 9.99 0 0 0 2 12c0 1.66.4 3.22 1.11 4.6l3.92-2.81z" fill="#FBBC05"/>
                                <path d="M12 6.5c1.32 0 2.5.45 3.43 1.34l2.57-2.57C16.44 3.15 14.43 2.2 12 2.2 8.49 2.2 5.4 4.26 3.93 7.08l3.01 2.24C7.73 8.06 9.69 6.5 12 6.5z" fill="#EA4335"/>
                            </svg>
                            Masuk dengan Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
