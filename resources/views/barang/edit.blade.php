<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Barang
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('barang.update', $barang->id) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200">Nama Barang</label>
                        <input type="text" name="nama" class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('nama', $barang->nama) }}" required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-gray-200">Harga</label>
                        <input type="number" name="harga" class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('harga', $barang->harga) }}" required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-gray-200">Stok</label>
                        <input type="number" name="stok" class="w-full mt-1 rounded border-gray-300"
                               value="{{ old('stok', $barang->stok) }}" required>
                    </div>

                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
