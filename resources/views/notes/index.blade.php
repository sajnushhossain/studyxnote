<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="flex flex-col gap-2">
                <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tighter font-outfit leading-tight">
                    Academic <span class="text-indigo-600">Archive</span>
                </h1>
                <div class="flex items-center gap-3">
                    <div class="h-1 w-8 bg-indigo-600 rounded-full"></div>
                    <p class="font-caveat text-2xl sm:text-3xl text-slate-400 italic">
                        A curated vault of intellectual growth.
                    </p>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="lg:max-w-md w-full">
                <form action="{{ route('notes.index') }}" method="GET" class="flex items-center gap-6">
                    <!-- Minimal Search -->
                    <div class="flex items-center gap-2 border-b border-slate-200 py-1 flex-grow focus-within:border-indigo-500 transition-colors duration-300">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="bg-transparent border-none focus:ring-0 text-xs font-bold text-slate-600 placeholder:text-slate-400 p-0 w-full" 
                            placeholder="Find resources...">
                    </div>
                    
                    <!-- Minimal Topic -->
                    <div class="flex items-center gap-2 border-b border-slate-200 py-1 shrink-0 focus-within:border-indigo-500 transition-colors duration-300">
                        <select name="category" class="bg-transparent border-none focus:ring-0 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 cursor-pointer p-0 w-auto">
                            <option value="">Classification</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="text-slate-300 hover:text-indigo-600 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    @if($notes->isEmpty())
        <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[3rem] p-24 text-center">
            <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-sm border border-slate-100">
                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <h2 class="text-3xl font-bold text-slate-800 font-outfit mb-2">No Results Found</h2>
            <p class="text-slate-500 font-medium text-lg">We couldn't find any entries matching your search criteria.</p>
            @if(request()->anyFilled(['search', 'category']))
                <a href="{{ route('notes.index') }}" class="inline-block mt-8 text-indigo-600 font-black uppercase tracking-widest text-xs hover:underline">Clear all filters</a>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($notes as $note)
                <x-note-card :note="$note" />
            @endforeach
        </div>

        <div class="mt-24">
            {{ $notes->links() }}
        </div>
    @endif
</x-app-layout>
