<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight font-outfit">Master Repository</h1>
                <p class="text-slate-400 font-medium mt-1 italic uppercase tracking-widest text-[10px]">Managing {{ $notes->total() }} total entries</p>
            </div>
            <a href="{{ route('admin.notes.create') }}" class="btn btn-indigo gap-2 px-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                New Entry
            </a>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Entry Title</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Type</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Category</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Stats</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($notes as $note)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="text-sm font-bold text-slate-800">{{ $note->title }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-[10px] font-black text-indigo-500 bg-indigo-50 px-2 py-1 rounded-md uppercase">
                                    {{ $note->type }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-sm font-medium text-slate-500">{{ $note->category->name }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-sm font-bold text-slate-400">{{ number_format($note->view_count) }} views</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.notes.edit', $note) }}" class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-white hover:shadow-md rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form action="{{ route('admin.notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Archive this entry permanently?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-50 text-slate-400 hover:text-red-600 hover:bg-white hover:shadow-md rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50 bg-slate-50/30">
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
