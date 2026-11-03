<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Basic Inventory') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-slate-50 to-gray-100 flex-col justify-center px-12 xl:px-20">
                <div class="max-w-lg">
                    <h1 class="text-4xl xl:text-5xl font-bold text-slate-800 leading-tight mb-6">
                        Manage your Inventory
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed mb-10">
                        Streamline your stock management with our powerful inventory platform. Track products, manage suppliers, monitor stock levels, and grow your business with real-time insights.
                    </p>

                    <!-- Inventory Illustration -->
                    <div class="flex justify-center">
                        <svg viewBox="0 0 400 300" class="w-full max-w-md" xmlns="http://www.w3.org/2000/svg">
                            <!-- Background Circle -->
                            <circle cx="200" cy="150" r="120" fill="#0D9488" opacity="0.15"/>
                            <circle cx="200" cy="150" r="90" fill="#0D9488" opacity="0.2"/>
                            
                            <!-- Warehouse/Box Icon -->
                            <g transform="translate(155, 100)">
                                <rect x="0" y="20" width="90" height="60" rx="4" fill="#0D9488"/>
                                <rect x="5" y="25" width="35" height="25" rx="2" fill="white" opacity="0.3"/>
                                <rect x="50" y="25" width="35" height="25" rx="2" fill="white" opacity="0.3"/>
                                <rect x="5" y="55" width="80" height="20" rx="2" fill="white" opacity="0.2"/>
                            </g>
                            
                            <!-- Chart/Analytics -->
                            <g transform="translate(80, 80)">
                                <rect x="0" y="0" width="60" height="45" rx="4" fill="white" stroke="#E5E7EB" stroke-width="2"/>
                                <rect x="8" y="25" width="8" height="15" fill="#0D9488"/>
                                <rect x="20" y="18" width="8" height="22" fill="#F97316"/>
                                <rect x="32" y="12" width="8" height="28" fill="#0D9488"/>
                                <rect x="44" y="20" width="8" height="20" fill="#F97316"/>
                            </g>
                            
                            <!-- Clipboard/Checklist -->
                            <g transform="translate(270, 90)">
                                <rect x="0" y="5" width="50" height="60" rx="4" fill="white" stroke="#E5E7EB" stroke-width="2"/>
                                <rect x="15" y="0" width="20" height="10" rx="2" fill="#0D9488"/>
                                <line x1="10" y1="25" x2="40" y2="25" stroke="#E5E7EB" stroke-width="2"/>
                                <line x1="10" y1="35" x2="35" y2="35" stroke="#E5E7EB" stroke-width="2"/>
                                <line x1="10" y1="45" x2="40" y2="45" stroke="#E5E7EB" stroke-width="2"/>
                                <circle cx="10" cy="25" r="3" fill="#10B981"/>
                                <circle cx="10" cy="35" r="3" fill="#10B981"/>
                                <circle cx="10" cy="45" r="3" fill="#F97316"/>
                            </g>
                            
                            <!-- Boxes Stack -->
                            <g transform="translate(95, 170)">
                                <rect x="0" y="20" width="40" height="30" rx="3" fill="#F97316" opacity="0.9"/>
                                <rect x="15" y="5" width="40" height="30" rx="3" fill="#0D9488"/>
                                <line x1="25" y1="12" x2="45" y2="12" stroke="white" stroke-width="2" opacity="0.5"/>
                                <line x1="25" y1="20" x2="40" y2="20" stroke="white" stroke-width="2" opacity="0.5"/>
                            </g>
                            
                            <!-- Trending Arrow -->
                            <g transform="translate(260, 180)">
                                <circle cx="25" cy="25" r="25" fill="#10B981" opacity="0.2"/>
                                <path d="M15 35 L25 20 L35 28 L45 15" stroke="#10B981" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                <polygon points="43,10 50,17 43,17" fill="#10B981"/>
                            </g>
                            
                            <!-- Small decorative elements -->
                            <circle cx="320" cy="70" r="8" fill="#F97316" opacity="0.6"/>
                            <circle cx="80" cy="230" r="6" fill="#0D9488" opacity="0.4"/>
                            <circle cx="330" cy="220" r="10" fill="#0D9488" opacity="0.3"/>
                            <circle cx="70" cy="130" r="5" fill="#F97316" opacity="0.5"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 sm:px-12 lg:px-16 xl:px-24 py-12 bg-white">
                <div class="w-full max-w-md mx-auto">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
