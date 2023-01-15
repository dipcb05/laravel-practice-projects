<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            {{-- Login with Email and Password --}}
            <div class="block mt-4">
                <x-jet-label for="email" value="{{ __('Email/Username') }}" />
                <x-jet-input id="email"
                             class="block mt-1 w-full"
                             type="email"
                             name="email"
                             :value="old('email')"
                             required autofocus />
            </div>

            <div class="block mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password"
                             class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required autocomplete="current-password" />
            </div>

            <div class="block mt-6">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me"
                                    name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>

            <div class="flex items-center mt-4">
                <div class="justify-center p-2">
                @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('register') }}">{{ __('Have a new account') }}
                </a>
                @endif
                </div>

                <div class="justify-center p-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}">{{ __('Forgot your password?') }}
                    </a>
                @endif
                </div>
            </div>
            {{-- Social Login --}}
            <div class="flex items-center justify-center mt-4">
                <div class="border-t border-gray-300 flex justify-center items-center text-black-400 w-full">
                    <span class="px-2 bg-white text-sm text-black-400">Or login with</span>
                </div>
            </div>
            <div class="flex items-center justify-center mt-4">
                {{-- Login with GitHub --}}
                <a class="btn p-2" href="{{ url('auth/github') }}" target="__blank">
                    <img src="{{ url('images/social-logo/github.png') }}" alt="Github Logo" width="50" height="50">
                </a>
                {{-- Login with Google --}}
                <a class="btn p-2" href="{{ url('auth/google') }}" target="__blank">
                    <img src="{{ url("images/social-logo/google.png") }}" alt="Google Logo" width="50" height="50">
                </a>
                {{-- Login with Facebook --}}
                <a class="btn p-2" href="{{ url('auth/facebook') }}" target="__blank">
                    <img src="{{ url("images/social-logo/facebook.png") }}" alt="Facebook Logo" width="50" height="50">
                </a>
                {{-- Login with Facebook --}}
                <a class="btn p-2" href="{{ url('auth/twitter') }}" target="__blank">
                    <img src="{{ url("images/social-logo/twitter.png") }}" alt="Twitter Logo" width="50" height="50">
                </a>
            </div>
            {{-- style="background: #313131; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;" --}}
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
