<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar: User Info -->
            <div class="lg:col-span-1">
                <div class="card-entry sticky top-8 p-8 flex flex-col items-center">
                    <div class="relative group mb-6">
                        <div class="w-32 h-32 bg-slate-900 rounded-2xl overflow-hidden flex items-center justify-center shadow-lg shadow-slate-200 border-4 border-white transition-transform group-hover:scale-[1.02]">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-white text-5xl font-black uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- Upload Button Overlay -->
                        <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all bg-slate-900/60 rounded-2xl cursor-pointer">
                            @csrf
                            <label for="profile_picture" class="cursor-pointer text-white text-[10px] font-black uppercase tracking-widest text-center px-4 py-2">
                                Change<br>Photo
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden" onchange="this.form.submit()">
                        </form>
                    </div>
                    
                    <div class="text-center w-full border-b border-slate-100 pb-6 mb-6">
                        <h2 class="text-2xl font-black text-slate-800 leading-tight uppercase tracking-tight">{{ $user->name }}</h2>
                        <p class="font-bold text-slate-400 text-sm mt-1">@ {{ $user->username ?? 'User' }}</p>
                    </div>
                    
                    <div class="w-full space-y-5 mb-8">
                        <div>
                            <span class="uppercase text-[10px] font-black tracking-widest text-slate-400 block mb-1">Email Address</span>
                            <span class="font-bold text-slate-700 break-all text-sm">{{ $user->email }}</span>
                        </div>
                        <div>
                            <span class="uppercase text-[10px] font-black tracking-widest text-slate-400 block mb-1">Joined Date</span>
                            <span class="font-bold text-slate-700 text-sm">{{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <div class="w-full space-y-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary w-full text-xs">
                            Edit Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-center font-bold text-red-500 hover:text-red-700 uppercase text-[10px] tracking-widest mt-4 transition-colors">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main: Recently Viewed & Cart -->
            <div class="lg:col-span-3">
                <!-- My Cart Section -->
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                            </div>
                            <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">My Cart</h2>
                        </div>
                        <span class="font-black text-[10px] uppercase tracking-widest bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full border border-indigo-100">
                            {{ $cartNotes->count() }} Items
                        </span>
                    </div>
                    
                    @if($cartNotes->isEmpty())
                        <div class="card-entry p-12 text-center border-dashed border-2 bg-slate-50/50">
                            <h3 class="text-xl font-bold text-slate-600 uppercase">Your cart is empty</h3>
                            <p class="mt-2 font-medium text-slate-400 text-sm">Add notes you want to read later!</p>
                            <a href="{{ route('notes.index') }}" class="btn btn-indigo mt-8 text-sm">Browse Collection</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($cartNotes as $note)
                                <div class="relative group">
                                    <x-note-card :note="$note" />
                                    <form action="{{ route('cart.destroy', $note) }}" method="POST" class="absolute top-4 right-4 z-20">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 bg-white/90 backdrop-blur-md text-red-500 rounded-xl border border-slate-100 hover:bg-red-500 hover:text-white transition-all shadow-lg flex items-center justify-center group/btn" title="Remove from Cart">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Recently Read Section -->
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                            <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">History</h2>
                        </div>
                        <span class="font-black text-[10px] uppercase tracking-widest bg-amber-50 text-amber-600 px-3 py-1 rounded-full border border-amber-100">
                            Recently Viewed
                        </span>
                    </div>
                    
                    @if($recentlyViewed->isEmpty())
                        <div class="card-entry p-12 text-center bg-slate-50/50">
                            <h3 class="text-xl font-bold text-slate-600 uppercase">Nothing here yet</h3>
                            <p class="mt-2 font-medium text-slate-400 text-sm">Start exploring our study notes!</p>
                            <a href="{{ route('notes.index') }}" class="btn btn-primary mt-8 text-sm">Explore Notes</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($recentlyViewed as $note)
                                <div class="relative group">
                                    <x-note-card :note="$note" />
                                    <form action="{{ route('profile.recently-viewed.destroy', $note) }}" method="POST" class="absolute top-4 right-4 z-20 opacity-0 group-hover:opacity-100 transition-all">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 bg-white/90 backdrop-blur-md text-slate-400 rounded-xl border border-slate-100 hover:bg-slate-900 hover:text-white transition-all shadow-lg flex items-center justify-center" title="Remove from History">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
