<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight font-poppins">Get your Notebook.</h2>
        <p class="text-sm font-medium text-gray-500 italic mt-1">"Organize your studies, achieve your dreams."</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="relative mb-6">
            <x-input-label for="name" :value="__('Full Name')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1" />
            <x-text-input id="name" class="block w-full border-0 border-b-2 border-gray-100 focus:ring-0 focus:border-indigo-600 rounded-none px-0 pb-2 text-lg font-medium" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="relative mb-6">
            <x-input-label for="username" :value="__('Username')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1" />
            <x-text-input id="username" class="block w-full border-0 border-b-2 border-gray-100 focus:ring-0 focus:border-indigo-600 rounded-none px-0 pb-2 text-lg font-medium" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="relative mb-6">
            <x-input-label for="email" :value="__('Gmail / Email')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1" />
            <x-text-input id="email" class="block w-full border-0 border-b-2 border-gray-100 focus:ring-0 focus:border-indigo-600 rounded-none px-0 pb-2 text-lg font-medium" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="relative mb-6">
            <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1" />
            <x-text-input id="password" class="block w-full border-0 border-b-2 border-gray-100 focus:ring-0 focus:border-indigo-600 rounded-none px-0 pb-2 text-lg font-medium"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="relative mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1" />
            <x-text-input id="password_confirmation" class="block w-full border-0 border-b-2 border-gray-100 focus:ring-0 focus:border-indigo-600 rounded-none px-0 pb-2 text-lg font-medium"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest text-sm rounded-sm shadow-lg transition-all transform hover:-translate-y-0.5">
                {{ __('Register Account') }}
            </button>
        </div>
    </form>

    <div class="mt-10 pt-8 border-t border-dashed border-gray-100 text-center">
        <a class="text-sm font-bold text-gray-400 hover:text-indigo-600 uppercase tracking-widest" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    </div>
</x-guest-layout>
