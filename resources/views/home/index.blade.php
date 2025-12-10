<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard / Home
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Selamat Datang, {{ Auth::user()->name }} 👋</h3>

                <p>Aplikasi Penjualan Barang - Laravel 12 + Breeze</p>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">

                    <a href="{{ route('kasir.index') }}"
                       class="p-4 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                        ➜ Menu Kasir
                    </a>

                    <a href="{{ route('barang.index') }}"
                       class="p-4 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">
                        ➜ Data Barang
                    </a>

                    <a href="{{ route('transaksi.index') }}"
                       class="p-4 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600">
                        ➜ Riwayat Transaksi
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
