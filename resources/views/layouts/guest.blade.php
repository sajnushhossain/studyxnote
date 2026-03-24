<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'StudyXnote') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .font-outfit { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="font-outfit text-slate-800 bg-slate-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4">
            <div class="mb-12">
                <a href="/" class="flex items-center gap-4 group">
                    <div class="bg-slate-900 text-white w-14 h-14 flex items-center justify-center rounded-2xl font-black text-2xl group-hover:bg-indigo-600 transition-all shadow-2xl shadow-indigo-200 group-hover:rotate-6">X</div>
                    <span class="font-black text-4xl tracking-tighter text-slate-900">StudyXnote</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white shadow-[0_32px_64px_-15px_rgba(0,0,0,0.1)] rounded-[2.5rem] overflow-hidden border border-slate-100 relative group">
                <!-- Premium Journal Spine -->
                <div class="absolute top-0 left-0 bottom-0 w-2 bg-slate-900 z-20 group-hover:w-3 transition-all"></div>
                
                <div class="p-10 relative z-10">
                    {{ $slot }}
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-xs font-black text-slate-300 uppercase tracking-[0.3em]">
                    Digital Academic Ledger &copy; {{ date('Y') }}
                </p>
            </div>
        </div>
    </body>
</html>
