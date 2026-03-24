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
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Caveat:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .font-outfit { font-family: 'Outfit', sans-serif; }
            .font-caveat { font-family: 'Caveat', cursive; }
        </style>
    </head>
    <body class="font-outfit antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <div class="px-4 sm:px-6 lg:px-8">
                <div class="notebook-shell shadow-[0_35px_60px_-15px_rgba(0,0,0,0.15)]">
                    <!-- The Spine Section -->
                    <div class="notebook-spine hidden sm:flex">
                        @for($i=0; $i<10; $i++)
                            <div class="spine-ring"></div>
                        @endfor
                    </div>

                    <!-- The Main Page Content -->
                    <div class="notebook-page-body">
                        <!-- Red Margin Line -->
                        <div class="notebook-margin-line"></div>

                        <!-- Content wrapper -->
                        <div class="notebook-inner-content">
                            <!-- Page Heading -->
                            @isset($header)
                                <div class="mb-10 pb-8 border-b-2 border-slate-100/50">
                                    {{ $header }}
                                </div>
                            @endisset

                            <!-- Main Content -->
                            <main>
                                {{ $slot }}
                            </main>

                            <!-- Subtle Footer -->
                            <footer class="mt-40 pt-10 border-t border-dashed border-slate-100 text-center">
                                <span class="font-caveat text-4xl text-slate-300">Curated Journal of Learning</span>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
