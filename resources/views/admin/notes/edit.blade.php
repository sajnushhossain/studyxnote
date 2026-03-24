<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight font-outfit">Edit Repository Entry</h1>
                <p class="text-slate-400 font-medium mt-1 italic uppercase tracking-widest text-[10px]">Modify existing academic resource</p>
            </div>
            <a href="{{ route('admin.notes.index') }}" class="btn btn-secondary gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl" x-data="{ type: '{{ old('type', $note->type) }}', showNewCategory: false }">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-10">
            <form action="{{ route('admin.notes.update', $note) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Entry Title</label>
                        <input type="text" name="title" value="{{ old('title', $note->title) }}" class="input-field" placeholder="e.g. Advanced Calculus: Integrals" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="md:col-span-2">
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 block">Classification</label>
                            <button type="button" @click="showNewCategory = !showNewCategory" class="text-[10px] font-bold text-indigo-600 uppercase hover:underline">
                                <span x-show="!showNewCategory">+ Create New Classification</span>
                                <span x-show="showNewCategory">x Cancel New Classification</span>
                            </button>
                        </div>
                        
                        <div x-show="!showNewCategory">
                            <select name="category_id" class="input-field">
                                <option value="">Select Existing Topic</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $note->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div x-show="showNewCategory" x-cloak>
                            <input type="text" name="new_category_name" value="{{ old('new_category_name') }}" class="input-field" placeholder="Type new classification name...">
                            <p class="text-[10px] text-slate-400 mt-1 italic">This will create a new category in your wish.</p>
                        </div>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        <x-input-error :messages="$errors->get('new_category_name')" class="mt-2" />
                    </div>

                    <!-- Type -->
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Format Type</label>
                        <select name="type" x-model="type" class="input-field" required>
                            <option value="text">Text Document</option>
                            <option value="image">Visual/Image</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                </div>

                <!-- Content (Text) -->
                <div x-show="type === 'text'" class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Document Content</label>
                    <textarea name="content" rows="10" class="input-field font-medium leading-relaxed" placeholder="Detailed notes go here...">{{ old('content', $note->type === 'text' ? $note->content : '') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Image Upload -->
                <div x-show="type === 'image'" class="space-y-4" x-cloak>
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Upload Visual Resource</label>
                    
                    @if($note->type === 'image')
                        <div class="mb-4">
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Current Image:</p>
                            <img src="{{ Storage::url($note->content) }}" class="w-32 h-32 object-cover rounded-xl border border-slate-100">
                        </div>
                    @endif

                    <div class="relative group">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="input-field flex items-center justify-center border-dashed border-2 py-12 group-hover:border-indigo-400 transition-colors">
                            <div class="text-center">
                                <svg class="w-10 h-10 text-slate-300 mx-auto mb-4 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <p class="text-sm font-bold text-slate-400 group-hover:text-slate-600 transition-colors">Click to upload new image or drag & drop</p>
                                <p class="text-[10px] text-slate-300 uppercase mt-1">Maximum size 24MB</p>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="pt-6 border-t border-slate-50 flex gap-4">
                    <button type="submit" class="btn btn-indigo flex-grow py-4 text-sm tracking-[0.2em]">
                        Update Repository Entry
                    </button>
                    <a href="{{ route('admin.notes.index') }}" class="btn btn-secondary px-8 py-4 text-sm tracking-[0.2em]">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
