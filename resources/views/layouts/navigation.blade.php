<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left Side: Brand & Main Links -->
            <div class="flex items-center gap-10">
                <a href="{{ route('notes.index') }}" class="flex items-center gap-3 group">
                    <div class="bg-slate-900 text-white w-9 h-9 flex items-center justify-center rounded-lg font-black text-lg transition-all group-hover:bg-indigo-600 shadow-sm">X</div>
                    <span class="font-black text-xl tracking-tight text-slate-800 uppercase">StudyXnote</span>
                </a>

                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('notes.index') }}" class="nav-pill {{ request()->routeIs('notes.index') ? 'nav-pill-active' : '' }}">
                        {{ __('Library') }}
                    </a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="nav-pill {{ request()->routeIs('admin.dashboard') ? 'nav-pill-active' : '' }}">
                                {{ __('Management') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side: User Menu / Auth -->
            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="56">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 py-1.5 px-2 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-100 transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center text-[10px] font-black text-white overflow-hidden shadow-sm">
                                        @if(Auth::user()->profile_picture)
                                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs font-bold text-slate-700 leading-none">{{ Auth::user()->name }}</p>
                                        <p class="text-[10px] font-bold text-slate-400 mt-0.5 leading-none group-hover:text-indigo-500 transition-colors">@ {{ Auth::user()->username ?? 'User' }}</p>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-300 ms-1 group-hover:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-3 bg-slate-50/50 border-b border-slate-100">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Authenticated as</p>
                                    <p class="text-xs font-bold text-slate-800 break-all">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-1">
                                    <x-dropdown-link :href="route('profile.show')" class="rounded-lg font-bold text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 py-2.5">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            {{ __('My Profile') }}
                                        </div>
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('profile.edit')" class="rounded-lg font-bold text-sm text-slate-600 hover:bg-slate-50 py-2.5">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            {{ __('Edit Account') }}
                                        </div>
                                    </x-dropdown-link>
                                </div>
                                <div class="border-t border-slate-100 p-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                class="rounded-lg font-bold text-sm text-red-500 hover:bg-red-50 py-2.5">
                                            <div class="flex items-center gap-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                                {{ __('Log Out') }}
                                            </div>
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-secondary text-xs px-4 py-2 border-none bg-slate-50">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary text-xs px-4 py-2">Sign Up</a>
                    </div>
                @endauth

                <!-- Mobile menu button -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-all duration-200">
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="sm:hidden bg-white border-b border-slate-100 overflow-hidden shadow-lg">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('notes.index')" :active="request()->routeIs('notes.index')">
                {{ __('Library') }}
            </x-responsive-nav-link>
            @auth
                @if(auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Management') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-slate-100 bg-slate-50/50">
            @auth
                <div class="flex items-center px-4 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white font-black overflow-hidden shadow-sm">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="ms-3">
                        <div class="font-black text-slate-800 text-sm uppercase leading-none">{{ Auth::user()->name }}</div>
                        <div class="font-bold text-slate-400 text-xs mt-1 leading-none">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-1 px-4">
                    <x-responsive-nav-link :href="route('profile.show')">
                        {{ __('My Profile') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Edit Account') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-red-500 font-bold">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" class="btn btn-secondary w-full text-sm py-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary w-full text-sm py-3">Sign Up</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
