<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/choices.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        />

        {{-- Livewire --}}
        @livewireStyles
        {{-- blade ui Kit --}}
        @bukStyles(true)

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
             
    </head>
    <body class="font-sans antialiased">
        <div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
            <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark:text-gray-200 dark:bg-gray-800" x-data="{ open: false }" x-cloak>
                <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                    <a href="{{ route('welcome') }}" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">My E-commerce</a>
                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">

                        <x-admin-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')">
                            {{ __('Orders') }}
                        </x-admin-nav-link>

                        <x-admin-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                            {{ __('Products') }}
                        </x-admin-nav-link>
                        
                        <x-admin-nav-link :href="route('admin.variations.index')" :active="request()->routeIs('admin.variations.index')">
                            {{ __('Variations') }}
                        </x-admin-nav-link>
                        
                        <x-admin-nav-link :href="route('admin.attributes.index')" :active="request()->routeIs('admin.attributes.index')">
                            {{ __('Attributes') }}
                        </x-admin-nav-link>

                        <x-admin-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                            {{ __('Categories') }}
                        </x-admin-nav-link>

                        <x-admin-nav-link :href="route('admin.tags.index')" :active="request()->routeIs('admin.tags.index')">
                            {{ __('Tags') }}
                        </x-admin-nav-link>

                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark:bg-transparent dark:focus:text-white dark:hover:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                <span>{{ Auth::user()->name }}</span>
                                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                                <div class="px-2 py-2 bg-white rounded-md shadow dark:bg-gray-700">
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('dashboard') }}">
                                        Dashboard</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
            
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </nav>
            </div>

            <main class="m-2 p-8 w-full">
                <div class="flex justify-end">
                    {{-- Success Alert --}}
                    @if(session()->has('success'))
                        
                        <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-slate-100 rounded-lg shadow-md">
                            <div class="flex items-center justify-center w-12 bg-emerald-500">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
                                </svg>
                            </div>
                            
                            <div class="px-4 py-2 -mx-3">
                                <div class="mx-3">
                                    <span class="font-semibold text-emerald-500 dark:text-emerald-400">{{ session()->get('success') }}</span>
                                    <p class="text-sm text-gray-600 dark:text-gray-200"></p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Warning Alert --}}
                    @if(session()->has('warning'))
                        <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-slate-100 rounded-lg shadow-md">
                            <div class="flex items-center justify-center w-12 bg-yellow-400">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                                </svg>
                            </div>
                            
                            <div class="px-4 py-2 -mx-3">
                                <div class="mx-3">
                                    <span class="font-semibold text-yellow-400 dark:text-yellow-300">{{ session()->get('warning') }}</span>
                                    <p class="text-sm text-gray-600 dark:text-gray-200"></p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Error alert --}}
                    @if(session()->has('danger'))
                        <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-slate-100 rounded-lg shadow-md">
                            <div class="flex items-center justify-center w-12 bg-red-500">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"/>
                                </svg>
                            </div>
                            
                            <div class="px-4 py-2 -mx-3">
                                <div class="mx-3">
                                    <span class="font-semibold text-red-500 dark:text-red-400">{{ session()->get('danger') }}</span>
                                    <p class="text-sm text-gray-600 dark:text-gray-200"></p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                {{ $slot }}
            </main>
        </div>

        {{-- Notifications --}}
        <x-notification />

        {{-- Livewire --}}
        @livewireScripts

        {{-- Blade UI kit --}}
        @bukScripts(true)
        @yield('scripts')

        <!-- Livewire modal -->
        @livewire('livewire-ui-modal')

        {{-- Apex Charts --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        @stack('js')

    </body>
</html>
