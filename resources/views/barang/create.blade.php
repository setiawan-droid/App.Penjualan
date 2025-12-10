<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Barang
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('barang.store') }}">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Barang</label>
                        <input type="text" name="nama" class="mt-1 block w-full rounded-md border-gray-300"
                            value="{{ old('nama') }}" required>
                    </div>

                    <!-- Harga -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Harga</label>
                        <input type="number" name="harga" class="mt-1 block w-full rounded-md border-gray-300"
                            value="{{ old('harga') }}" required>
                    </div>

                    <!-- Stok -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Stok</label>
                        <input type="number" name="stok" class="mt-1 block w-full rounded-md border-gray-300"
                            value="{{ old('stok') }}" required>
                    </div>

                    <div class="mt-6 flex justify-end space-x-2">
                        <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
