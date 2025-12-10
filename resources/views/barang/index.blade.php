<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Manajemen Barang
            </h2>

            <a href="{{ route('barang.create') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-black rounded-lg shadow transition">
                + Tambah Barang
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Alert sukses --}}
            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-2">#</th>
                            <th class="py-2">Nama</th>
                            <th class="py-2">Harga</th>
                            <th class="py-2">Stok</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($barang as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $loop->iteration }}</td>
                                <td class="py-2">{{ $item->nama }}</td>
                                <td class="py-2">Rp {{ number_format($item->harga) }}</td>
                                <td class="py-2">{{ $item->stok }}</td>
                                <td class="py-2 flex gap-2">

                                    <a href="{{ route('barang.edit', $item->id) }}"
                                       class="px-3 py-1 bg-green-500 text-black rounded">
                                        Edit 
                                    </a>

                                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus barang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 bg-red-600 text-white rounded">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data barang</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>
