<nav x-data="{ open: false }" class="bg-white/70 backdrop-blur-md border-b border-slate-200/60 relative z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo LaporIn -->
                <div class="shrink-0 flex items-center border-r border-slate-200/60 pe-6">
                    <a href="{{ Auth::check() ? route('dashboard') : url('/') }}" class="font-extrabold tracking-tighter text-xl text-slate-900">
                        LaporIn<span class="text-indigo-600">.</span>
                    </a>
                </div>

                <!-- Nav Links Dinamis Sesuai Alur Project -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(Auth::user()->role === 'user')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('user.dashboard')">
                                {{ __('Dashboard Saya') }}
                            </x-nav-link>
                            <x-nav-link :href="route('user.complaints.index')" :active="request()->routeIs('user.complaints.*')">
                                {{ __('Aduan Saya') }}
                            </x-nav-link>
                        @endif

                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')">
                                {{ __('Dashboard Ringkasan') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')">
                                {{ __('Kelola Aduan Pusat') }}
                            </x-nav-link>
                        @endif

                        @if(Auth::user()->role === 'constructor')
                            <x-nav-link :href="route('constructor.dashboard')" :active="request()->routeIs('constructor.dashboard')">
                                {{ __('Panel Kerja Konstruksi') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    @guest
                        <x-nav-link :href="url('/')" :active="request()->is('/')">
                            {{ __('Home') }}
                        </x-nav-link>
                    @endguest

                    @if(!Auth::check() || Auth::user()->role !== 'constructor')
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                            {{ __('Tentang') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Bagian Kanan Dropdown Nama User -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-slate-500 bg-white/50 hover:text-slate-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="url('#')">{{ __('Profile') }}</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @guest
                    <div class="space-x-3">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-indigo-100 shadow-sm transition ease-in-out duration-150">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-sm transition ease-in-out duration-150">Daftar Akun</a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>