<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Kasir</h2>
    </x-slot>

    {{-- ALERT --}}
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-8 max-w-7xl mx-auto space-y-8">

        {{-- PILIH BARANG --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-bold text-lg mb-5 text-gray-700">Pilih Barang</h3>

            {{-- FORM CARI --}}
            <form method="GET" action="{{ route('kasir.index') }}" class="mb-6">
                <div class="flex gap-3 items-center">
                    <input type="text" name="search" value="{{ $search }}"
                        class="border rounded-lg px-4 py-2 w-72 focus:ring-2 focus:ring-blue-300"
                        placeholder="Cari barang...">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        Cari
                    </button>
                </div>
            </form>
            

            {{-- TABEL BARANG --}}
            <div class="bg-gray-50 p-4 shadow-inner rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Daftar Barang</h3>

                <table class="w-full border rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Harga</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($barang as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2 border">{{ $item->nama }}</td>
                                <td class="p-2 border font-medium">Rp {{ number_format($item->harga) }}</td>
                                <td class="p-2 border text-center">
                                    <form action="{{ route('kasir.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <button
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg shadow">
                                            Tambah
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-3 text-gray-500">
                                    Barang tidak ditemukan...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- KERANJANG --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-bold text-lg mb-5 text-gray-700">Keranjang Belanja</h3>

            @if(empty($cart))
                <p class="text-gray-500">Belum ada barang dalam keranjang.</p>

            @else
                <table class="w-full rounded-lg overflow-hidden shadow-inner">
                    <thead>
                        <tr class="border-b bg-gray-200 text-gray-700">
                            <th class="p-2 text-left">Barang</th>
                            <th class="p-2">Harga</th>
                            <th class="p-2">Qty</th>
                            <th class="p-2">Subtotal</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @php $total = 0; @endphp

                        @foreach($cart as $id => $c)
                            @php
                                $sub = $c['harga'] * $c['qty'];
                                $total += $sub;
                            @endphp

                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2">{{ $c['nama'] }}</td>

                                <td class="p-2 font-medium">Rp {{ number_format($c['harga']) }}</td>

                                <td class="p-2 text-center">
                                    <div class="flex justify-center space-x-2">

                                        {{-- MINUS --}}
                                        <form action="{{ route('kasir.minus', $id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="bg-gray-300 hover:bg-gray-400 text-black px-3 py-1 rounded-lg">
                                                -
                                            </button>
                                        </form>

                                        {{-- QTY --}}
                                        <span class="px-3 py-1 bg-gray-100 rounded-lg border">
                                            {{ $c['qty'] }}
                                        </span>

                                        {{-- PLUS --}}
                                        <form action="{{ route('kasir.plus', $id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                <td class="p-2 font-medium">Rp {{ number_format($sub) }}</td>

                                <td class="p-2 text-center">
                                    <form action="{{ route('kasir.delete', $id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg shadow">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr class="bg-gray-100 font-bold text-gray-700">
                            <td colspan="3" class="text-right p-2">TOTAL:</td>
                            <td class="p-2">Rp {{ number_format($total) }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                {{-- INPUT BAYAR --}}
                <form action="{{ route('kasir.submit') }}" method="POST" class="mt-6">
                    @csrf

                    <label class="block font-bold mb-2 text-gray-700">Bayar:</label>

                    <div class="flex items-center">
                        <input type="number" name="bayar"
                            class="border p-2 rounded-lg w-1/3 focus:ring-2 focus:ring-blue-300">

                        <button
                            class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg shadow ml-3">
                            Proses Transaksi
                        </button>
                    </div>
                </form>

            @endif
        </div>

    </div>
</x-app-layout>
