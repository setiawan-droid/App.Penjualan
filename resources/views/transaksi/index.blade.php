<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Riwayat Transaksi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                <table class="w-full text-left text-gray-700 dark:text-gray-200">
                    <thead class="border-b">
                        <tr>
                            <th class="py-2">#</th>
                            <th class="py-2">Kode</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Bayar</th>
                            <th class="py-2">Kembalian</th>
                            <th class="py-2">Kasir</th>
                            <th class="py-2">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($transaksi as $t)
                            <tr class="border-b">
                                <td class="py-2">{{ $loop->iteration }}</td>
                                <td class="py-2 font-semibold">{{ $t->kode_transaksi }}</td>
                                <td class="py-2">Rp {{ number_format($t->total, 0) }}</td>
                                <td class="py-2">Rp {{ number_format($t->bayar, 0) }}</td>
                                <td class="py-2">Rp {{ number_format($t->kembalian, 0) }}</td>
                                <td class="py-2">{{ $t->user->name }}</td>
                                <td class="py-2">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    Belum ada transaksi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                <div class="mt-4">
                    {{ $transaksi->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
