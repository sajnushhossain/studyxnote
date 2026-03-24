<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight font-outfit">Management Dashboard</h1>
                <p class="text-slate-400 font-medium mt-1 italic uppercase tracking-widest text-[10px]">Administrative Overview</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden md:flex flex-col items-end mr-4">
                    <span class="text-xs font-black text-slate-900">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-tighter">System Administrator</span>
                </div>
                <a href="{{ route('admin.notes.create') }}" class="btn btn-indigo gap-2 px-6 shadow-indigo-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                    New Entry
                </a>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Stats Cards with hover effects and cleaner icons -->
        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Repository</p>
            <p class="text-3xl font-black text-slate-900 tabular-nums">{{ number_format($stats['total_notes']) }} <span class="text-xs font-bold text-slate-300 ml-1">Notes</span></p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Global Reach</p>
            <p class="text-3xl font-black text-slate-900 tabular-nums">{{ number_format($stats['total_views']) }} <span class="text-xs font-bold text-slate-300 ml-1">Views</span></p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Active Students</p>
            <p class="text-3xl font-black text-slate-900 tabular-nums">{{ number_format($stats['total_users']) }} <span class="text-xs font-bold text-slate-300 ml-1">Users</span></p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Subject Areas</p>
            <p class="text-3xl font-black text-slate-900 tabular-nums">{{ number_format($stats['total_categories']) }} <span class="text-xs font-bold text-slate-300 ml-1">Topics</span></p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Notes Table-like view -->
        <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                <h3 class="text-xl font-black text-slate-800 font-outfit">Recent Repository Entries</h3>
                <a href="{{ route('admin.notes.index') }}" class="btn btn-secondary !py-2 !px-4 text-[10px] tracking-widest">Master List</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Entry Title</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Classification</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($recent_notes as $note)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black text-xs group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                            {{ substr($note->title, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-bold text-slate-800 line-clamp-1">{{ $note->title }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="text-[10px] font-black text-slate-500 bg-slate-100 px-3 py-1 rounded-full uppercase tracking-wider">
                                        {{ $note->category->name }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase">Live</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.notes.edit', $note) }}" class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-white hover:shadow-md rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <a href="{{ route('notes.show', $note) }}" class="p-2 bg-slate-50 text-slate-400 hover:text-emerald-600 hover:bg-white hover:shadow-md rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar Activity/Popular -->
        <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden group">
            <!-- Decorative circle -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col h-full">
                <h3 class="text-xl font-black text-white font-outfit mb-8 flex items-center gap-3">
                    <span class="w-2 h-2 bg-indigo-400 rounded-full"></span>
                    High Performance
                </h3>
                
                <div class="space-y-6 flex-grow">
                    @foreach($top_notes as $index => $note)
                        <div class="flex items-center justify-between group/item">
                            <div class="flex items-center gap-4">
                                <div class="text-xs font-black text-slate-700 tabular-nums">0{{ $index + 1 }}</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-300 group-hover/item:text-white transition-colors truncate max-w-[120px]">{{ $note->title }}</p>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase">{{ number_format($note->view_count) }} Views</p>
                                </div>
                            </div>
                            <div class="w-16 h-1 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 rounded-full group-hover/item:bg-indigo-400 transition-all duration-700" style="width: {{ ($note->view_count / max($top_notes->pluck('view_count')->toArray())) * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 pt-8 border-t border-slate-800 text-center">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">System Integrity</p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/10 text-emerald-500 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        Operational
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
