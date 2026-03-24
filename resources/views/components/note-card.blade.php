@props(['note'])

<div class="note-card-pro group">
    <div class="mb-6 flex items-center justify-between">
        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg">
            {{ $note->category->name }}
        </span>
        <div class="flex items-center gap-1.5 text-[10px] font-bold text-slate-300">
            <span class="w-2 h-2 bg-indigo-200 rounded-full animate-pulse"></span>
            SYNCED
        </div>
    </div>

    <h3 class="text-2xl font-bold text-slate-800 mb-4 group-hover:text-indigo-600 transition-colors leading-snug font-outfit">
        {{ $note->title }}
    </h3>

    <div class="flex-grow mb-8 overflow-hidden">
        @if($note->type === 'image')
            <div class="relative w-full rounded-2xl overflow-hidden shadow-inner bg-slate-100 aspect-[4/3]">
                <img src="{{ Storage::url($note->content) }}" alt="{{ $note->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
            </div>
        @else
            <p class="text-slate-500 leading-relaxed font-medium line-clamp-4 italic font-caveat text-2xl">
                "{{ Str::limit(strip_tags($note->content), 150) }}"
            </p>
        @endif
    </div>

    <div class="flex items-center justify-between mt-auto pt-6 border-t border-slate-50">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
            {{ number_format($note->view_count) }}
        </div>
        <a href="{{ route('notes.show', $note) }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-slate-900 hover:text-indigo-600 transition-all group/btn">
            Read Entry
            <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </a>
    </div>
</div>
