<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Menu Utama -->
            <div class="hidden space-x-8 sm:ms-10 sm:flex">

                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    Home
                </x-nav-link>

                <x-nav-link :href="route('kasir.index')" :active="request()->routeIs('kasir.index')">
                    Kasir
                </x-nav-link>

                <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.index')">
                    Barang
                </x-nav-link>

                <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.index')">
                    Transaksi
                </x-nav-link>

                <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.index')">
                    Laporan
                </x-nav-link>
            </div>

            <!-- Dropdown User -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                            {{ Auth::user()->name }}
                            <svg class="ms-1 w-4 h-4" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>
