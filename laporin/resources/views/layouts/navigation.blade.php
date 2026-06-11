<nav x-data="{ open: false }" class="bg-white/70 backdrop-blur-md border-b border-slate-200/60 relative z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-extrabold tracking-tighter text-xl text-slate-900">
                        LaporIn<span class="text-indigo-600">.</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    
                    @if(Auth::user()->role === 'constructor')
                        <x-nav-link :href="route('constructor.dashboard')" :active="request()->routeIs('constructor.dashboard')" 
                            class="text-sm font-bold tracking-tight transition duration-150 {{ request()->routeIs('constructor.dashboard') ? 'text-amber-600 border-amber-600' : 'text-slate-500 hover:text-amber-600 hover:border-slate-300' }}">
                            {{ __('Panel Kerja Konstruksi') }}
                        </x-nav-link>

                    @elif(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                            class="text-sm font-bold tracking-tight transition duration-150 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 border-indigo-600' : 'text-slate-500 hover:text-indigo-600 hover:border-slate-300' }}">
                            {{ __('Dashboard Admin') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')"
                            class="text-sm font-bold tracking-tight transition duration-150 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-600 border-indigo-600' : 'text-slate-500 hover:text-indigo-600 hover:border-slate-300' }}">
                            {{ __('Kelola Kategori') }}
                        </x-nav-link>

                    @else
                        <x-nav-link :href="route('dashboard')" :active="Request::is('user/dashboard')" 
                            class="text-sm font-bold tracking-tight transition duration-150 {{ Request::is('user/dashboard') ? 'text-indigo-600 border-indigo-600' : 'text-slate-500 hover:text-indigo-600 hover:border-slate-300' }}">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/user/complaints')" :active="Request::is('user/complaints*')"
                            class="text-sm font-bold tracking-tight transition duration-150 {{ Request::is('user/complaints*') ? 'text-indigo-600 border-indigo-600' : 'text-slate-500 hover:text-indigo-600 hover:border-slate-300' }}">
                            {{ __('Aduan Saya') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="url('/about')" :active="Request::is('about')"
                        class="text-sm font-bold tracking-tight transition duration-150 {{ Request::is('about') ? 'text-indigo-600 border-indigo-600' : 'text-slate-500 hover:text-indigo-600 hover:border-slate-300' }}">
                        {{ __('Tentang') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-slate-200/60 text-sm leading-4 font-bold rounded-xl text-slate-700 bg-white/80 hover:text-indigo-600 hover:bg-slate-50 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }} <span class="text-xs text-slate-400">({{ strtoupper(Auth::user()->role) }})</span></div>
                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="font-semibold text-red-500 hover:bg-red-50">
                                {{ __('Keluar Sistem') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-indigo-600 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-slate-200">
        <div class="pt-2 pb-3 space-y-1">
            
            @if(Auth::user()->role === 'constructor')
                <x-responsive-nav-link :href="route('constructor.dashboard')" :active="request()->routeIs('constructor.dashboard')" 
                    class="font-bold {{ request()->routeIs('constructor.dashboard') ? 'text-amber-600 bg-amber-50/50 border-amber-600' : 'text-slate-600' }}">
                    {{ __('Panel Kerja Konstruksi') }}
                </x-responsive-nav-link>

            @elif(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                    class="font-bold {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 bg-indigo-50/50 border-indigo-600' : 'text-slate-600' }}">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')"
                    class="font-bold {{ request()->routeIs('admin.categories.*') ? 'text-indigo-600 bg-indigo-50/50 border-indigo-600' : 'text-slate-600' }}">
                    {{ __('Kelola Kategori') }}
                </x-responsive-nav-link>

            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="Request::is('user/dashboard')"
                    class="font-bold {{ Request::is('user/dashboard') ? 'text-indigo-600 bg-indigo-50/50 border-indigo-600' : 'text-slate-600' }}">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/user/complaints')" :active="Request::is('user/complaints*')"
                    class="font-bold {{ Request::is('user/complaints*') ? 'text-indigo-600 bg-indigo-50/50 border-indigo-600' : 'text-slate-600' }}">
                    {{ __('Aduan Saya') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="url('/about')" :active="Request::is('about')"
                class="font-bold {{ Request::is('about') ? 'text-indigo-600 bg-indigo-50/50 border-indigo-600' : 'text-slate-600' }}">
                {{ __('Tentang') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-slate-200 bg-slate-50/50">
            <div class="px-4">
                <div class="font-bold text-sm text-slate-800">{{ Auth::user()->name }} <span class="text-xs text-slate-400">({{ strtoupper(Auth::user()->role) }})</span></div>
                <div class="font-medium text-xs text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="font-bold text-red-500">
                        {{ __('Keluar Sistem') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>