<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Kasir
            </h2>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- ALERT --}}
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif


        {{-- ============================== --}}
        {{--        BAGIAN PILIH BARANG     --}}
        {{-- ============================== --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    Pilih Barang
                </h3>
            </div>

            {{-- FORM SEARCH --}}
            <form method="GET" action="{{ route('kasir.index') }}" class="mb-5">
                <div class="flex gap-3 items-center">
                    <input type="text" name="search" value="{{ $search }}"
                        class="border rounded-lg px-4 py-2 w-72 focus:ring-2 focus:ring-blue-300"
                        placeholder="Cari barang...">
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                        Cari
                    </button>
                </div>
            </form>


            {{-- TABEL BARANG --}}
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner">
                <h3 class="text-md font-semibold mb-3 text-gray-700 dark:text-gray-200">Daftar Barang</h3>

                <table class="w-full text-left text-gray-800 dark:text-gray-200">
                    <thead class="w-full text-left">
                        <tr>
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Harga</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-gray-800">
                        @forelse ($barang as $item)
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="p-2 border">{{ $item->nama }}</td>
                                <td class="p-2 border font-medium">Rp {{ number_format($item->harga) }}</td>
                                <td class="p-2 border text-center">
                                    <form action="{{ route('kasir.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <button  class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow">
                                            Tambah
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-3 text-gray-500 dark:text-gray-400">
                                    Barang tidak ditemukan...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        {{-- ============================== --}}
        {{--        BAGIAN KERANJANG         --}}
        {{-- ============================== --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold mb-6 text-gray-700 dark:text-gray-200">Keranjang Belanja</h3>

            @if(empty($cart))
                <p class="text-gray-500 dark:text-gray-400">
                    Belum ada barang dalam keranjang.
                </p>

            @else
                <table class="w-full text-left">
                    <thead border =1>
                        <tr class="w-full text-left">
                            <th class="p-2  border text-left">Barang</th>
                            <th class="p-2 border">Harga</th>
                            <th class="p-2 border">Qty</th>
                            <th class="p-2 border">Subtotal</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-gray-800">
                        @php $total = 0; @endphp

                        @foreach($cart as $id => $c)
                            @php
                                $sub = $c['harga'] * $c['qty'];
                                $total += $sub;
                            @endphp

                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="p-2 border">{{ $c['nama'] }}</td>

                                <td class="p-2 border font-medium">Rp {{ number_format($c['harga']) }}</td>

                                <td class="p-2 border text-center">
                                    <div class="flex justify-center items-center space-x-2">

                                        {{-- MINUS --}}
                                        <form action="{{ route('kasir.minus', $id) }}" method="POST">
                                            @csrf
                                            <button class="px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded-lg">
                                                -
                                            </button>
                                        </form>

                                        {{-- QTY --}}
                                        <span class="px-3 py-1 bg-gray-1000 dark:bg-gray-100 rounded-lg border">
                                            {{ $c['qty'] }}
                                        </span>

                                        {{-- PLUS --}}
                                        <form action="{{ route('kasir.plus', $id) }}" method="POST">
                                            @csrf
                                            <button class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                <td class="p-2 border font-medium">Rp {{ number_format($sub) }}</td>

                                <td class="p-2 border text-center">
                                    <form action="{{ route('kasir.delete', $id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                        <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
                            <td colspan="3" class="text-right p-2 text-gray-700 dark:text-gray-200">
                                TOTAL:
                            </td>
                            <td class="p-2">Rp {{ number_format($total) }}</td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>


                {{-- FORM BAYAR --}}
                <form action="{{ route('kasir.submit') }}" method="POST" class="mt-6">
                    @csrf

                    <label class="block font-bold mb-2 text-gray-700 dark:text-gray-100">
                        Bayar:
                    </label>

                    <div class="flex items-center gap-3">
                        <input type="number" name="bayar"
                            class="border rounded-lg px-4 py-2 w-48 focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan jumlah bayar" required>

                        <button
                            class="px-5 py-2 rounded-lg bg-green-700 hover:bg-green-800 text-white shadow">
                            Proses Transaksi
                        </button>
                    </div>
                </form>

            @endif
        </div>

    </div>
</x-app-layout>
