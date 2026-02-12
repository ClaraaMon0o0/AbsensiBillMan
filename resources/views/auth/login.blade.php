<x-guest-layout>
    <!-- Session Status -->
    <div class="mb-6">
        <x-auth-session-status class="alert-modern alert-success" :status="session('status')" />
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700 ml-1" style="font-family: 'Poppins', sans-serif;" />
            
            <div class="input-wrapper">
                <i class="fas fa-envelope input-icon"></i>
                <x-text-input id="email" 
                    class="modern-input modern-input-with-icon" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    placeholder="Masukkan email anda"
                    required 
                    autofocus 
                    autocomplete="username" 
                    style="font-family: 'Poppins', sans-serif;" />
            </div>
            
            <x-input-error :messages="$errors->get('email')" class="error-message-modern" style="font-family: 'Poppins', sans-serif;" />
        </div>

        <!-- Password dengan Toggle Mata -->
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-sm font-medium text-gray-700 ml-1" style="font-family: 'Poppins', sans-serif;" />
            </div>
            
            <div class="input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <x-text-input id="password" 
                    class="modern-input modern-input-with-icon pr-12"
                    type="password"
                    name="password"
                    placeholder="Masukkan kata sandi anda"
                    required 
                    autocomplete="current-password"
                    style="font-family: 'Poppins', sans-serif;" />
                
                <!-- Tombol Toggle Modern -->
                <button type="button" 
                    id="togglePassword"
                    class="absolute right-3 flex items-center text-gray-400 hover:text-[#155E76] transition-colors focus:outline-none">
                    <!-- Ikon Mata Terbuka -->
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <!-- Ikon Mata Tertutup (hidden default) -->
                    <svg id="eyeClose" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 012.223-3.592m3.132-2.342A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a9.978 9.978 0 01-4.132 5.411M15 12a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3l-6 6m6-6l6 6" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="error-message-modern" style="font-family: 'Poppins', sans-serif;" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer group">
                <input id="remember_me" type="checkbox" class="checkbox-modern" name="remember">
                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors" style="font-family: 'Poppins', sans-serif;">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="link-modern" href="{{ route('password.request') }}" style="font-family: 'Poppins', sans-serif;">
                    <span>{{ __('Lupa kata sandi?') }}</span>
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="mt-6">
            <x-primary-button class="btn-modern w-full" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
                <span>{{ __('Masuk') }}</span>
            </x-primary-button>
        </div>
    </form>

    <!-- Script Toggle Password -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClose = document.getElementById('eyeClose');

        if (togglePassword && password && eyeOpen && eyeClose) {
            togglePassword.addEventListener('click', function() {
                // Toggle tipe input
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;
                
                // Toggle ikon
                eyeOpen.classList.toggle('hidden');
                eyeClose.classList.toggle('hidden');
            });
        }
    </script>

    <style>
        /* Force Poppins untuk semua elemen */
        .btn-modern,
        .modern-input,
        .link-modern,
        .checkbox-modern + span,
        .error-message-modern,
        .alert-modern,
        x-input-label,
        label,
        input,
        button,
        a,
        span,
        div,
        p {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</x-guest-layout>