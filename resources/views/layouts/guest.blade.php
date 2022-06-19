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
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        {{-- Livewire --}}
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body>
        {{-- Nav --}}
        <nav id="header" class="w-full z-30 top-0 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

                <label for="menu-toggle" class="cursor-pointer md:hidden block">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <title>menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </label>
                <input class="hidden" type="checkbox" id="menu-toggle" />

                <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
                    <nav>
                        <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
                            <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="{{ route('shop.index') }}">Shop</a></li>
                            <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="#">About</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="order-1 md:order-2">
                    <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="{{ route('welcome') }}">
                        <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                        </svg>
                        NORDICS
                    </a>
                </div>

                <div class="order-3 md:order-3 flex items-center" id="nav-content">
                    @if (Route::has('login'))
                      <div class="flex">
                          @auth
                              <a href="{{ url('/dashboard') }}" class="inline-block no-underline hover:text-black">
                                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                  <circle fill="none" cx="12" cy="7" r="3" />
                                  <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                                </svg>
                              </a>
                          @else
                            <a class="inline-block no-underline hover:text-black" href="{{ route('register') }}">
                              <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                  <circle fill="none" cx="12" cy="7" r="3" />
                                  <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                              </svg>
                            </a>
                          @endauth
                      </div>
                    @endif
                    
                    <div class="flex justify-items-end">
                      <a class="pl-3 inline-block no-underline hover:text-black" href="{{ route('cart.index') }}">
                          <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
                              <circle cx="10.5" cy="18.5" r="1.5" />
                              <circle cx="17.5" cy="18.5" r="1.5" />
                          </svg>
                        </a>
                      <livewire:front-end.cart-counter />
                    </div>
                </div>
            </div>
        </nav>

        <div class="font-sans text-gray-900 antialiased min-h-max">
            {{ $slot }}
        </div>

        {{-- footer --}}
        <footer class="bg-white">
            <div class="container flex flex-wrap items-center justify-center px-4 py-8 mx-auto lg:justify-between">
              <div class="flex flex-wrap justify-center">
                <ul class="flex items-center space-x-4 text-black">
                  <li>Home</li>
                  <li>About</li>
                  <li>Contact</li>
                  <li>Terms</li>
                </ul>
              </div>
              <div class="flex justify-center mt-4 lg:mt-0">
                <a>
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-6 h-6 text-blue-600" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                  </svg>
                </a>
                <a class="ml-3">
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-6 h-6 text-blue-300" viewBox="0 0 24 24">
                    <path
                      d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                    </path>
                  </svg>
                </a>
                <a class="ml-3">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-6 h-6 text-pink-400" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                  </svg>
                </a>
                <a class="ml-3">
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="0" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24">
                    <path stroke="none"
                      d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                  </svg>
                </a>
              </div>
            </div>
        </footer>

        {{-- Notifications --}}
        <x-notification />

        {{-- Livewire --}}
        @livewireScripts
    </body>
</html>