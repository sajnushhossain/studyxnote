<x-app-layout>
    <div class="max-w-4xl">
        <div class="mb-12 flex items-center justify-between">
            <a href="{{ route('notes.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-800 transition-colors">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Return to Notebook
            </a>
            
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg">
                    {{ $note->category->name }}
                </span>
                <span class="text-xs font-bold text-slate-300">#{{ str_pad($note->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-12 font-outfit">
            {{ $note->title }}
        </h1>

        <div class="prose max-w-none">
            @if($note->type === 'image')
                <div class="relative w-full rounded-2xl overflow-hidden shadow-2xl bg-slate-50 border border-slate-100 mb-12">
                    <img src="{{ Storage::url($note->content) }}" alt="{{ $note->title }}" class="w-full h-auto">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent pointer-events-none"></div>
                </div>
            @else
                <div class="text-2xl text-slate-600 font-medium italic font-caveat leading-[2.5rem] space-y-12">
                    {!! nl2br(e($note->content)) !!}
                </div>
            @endif
        </div>

        @auth
            <div class="mt-24 p-12 bg-slate-900 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/20 rounded-full -mr-32 -mt-32 blur-3xl group-hover:bg-indigo-600/30 transition-colors duration-700"></div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold mb-4 font-outfit">Academic Insight</h2>
                    <p class="text-slate-400 text-lg font-medium leading-relaxed max-w-xl italic">
                        "Your progress is saved. This note has been added to your recently viewed collection."
                    </p>
                    
                    <div class="mt-10 flex flex-wrap gap-4">
                        @if(auth()->user()->isInCart($note))
                            <form action="{{ route('cart.destroy', $note) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary !bg-red-600 !text-white !border-red-700 hover:!bg-red-700">
                                    Remove from Cart
                                </button>
                            </form>
                        @else
                            <form action="{{ route('cart.store', $note) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-indigo">
                                    Add to Cart
                                </button>
                            </form>
                        @endif
                        <button class="btn btn-secondary !bg-slate-800 !text-white !border-slate-700 hover:!bg-slate-700">
                            Export PDF
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-24 p-12 bg-white rounded-[3rem] border border-slate-100 shadow-xl text-center">
                <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <h2 class="text-3xl font-bold text-slate-800 mb-4 font-outfit">Unlock Full Access</h2>
                <p class="text-slate-500 text-lg font-medium mb-10 max-w-md mx-auto">Join StudyXnote to save your favorite resources and track your academic journey.</p>
                <a href="{{ route('register') }}" class="btn btn-primary px-10 py-4 text-sm tracking-[0.2em]">
                    Create Free Account
                </a>
            </div>
        @endauth
    </div>
</x-app-layout>
