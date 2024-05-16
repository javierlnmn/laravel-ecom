<header class="min-h-20 bg-zinc-900 p-3">

    <div class="max-w-7xl w-11/12 mx-auto flex items-center">

        <div class="flex h-full w-full items-center justify-between">

            <a href="{{ route('index')}}">
                <x-breeze.application-logo-notext class="w-12 h-w-12" color="#FDFDFD" />
            </a>

            <nav class="flex gap-4 items-center justify-center ">
                <a href="#" class="text-sm font-medium text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors">Products</a>
                <a href="#" class="text-sm font-medium text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors">Brands</a>
                <a href="#" class="text-sm font-medium text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors">About us</a>
                <a href="#" class="text-sm font-medium text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors">Contact Us</a>
                <p class="text-sm font-medium text-zinc-300 select-none">|</p>
                @auth
                <a href="#" class="text-sm font-medium text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors">Shopping Cart</a>
                <x-breeze.dropdown width='w-72' align='right'>
                    <x-slot name="trigger">
                        <button class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::user()->hasAnyAccess(['platform.index']))
                            <x-breeze.dropdown-link :href="route('platform.main')">
                                {{ __('Admin Panel') }}
                            </x-breeze.dropdown-link>
                        @endif


                        <x-breeze.dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-breeze.dropdown-link>

                        <form class="m-0" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-breeze.dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-breeze.dropdown-link>
                        </form>

                    </x-slot>
                </x-breeze.dropdown>
                @endauth
                @guest
                    <a class="text-sm font-medium text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors" href="{{ route('register') }}">Register</a>
                    <a class="text-sm font-medium text-zinc-300 hover:text-zinc-100 focus:text-zinc-100 transition-colors" href="{{ route('login') }}">Log In</a>
                @endguest
            </nav>
        </div>

    </div>

</header>
