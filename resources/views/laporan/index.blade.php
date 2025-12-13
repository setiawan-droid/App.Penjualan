<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- FILTER TANGGAL --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <form method="GET" action="{{ route('laporan.index') }}" class="flex gap-4 flex-wrap">
                    <div>
                        <label class="text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai"
                               value="{{ $tanggalMulai }}"
                               class="block w-full mt-1 dark:bg-gray-700 dark:text-gray-100 rounded border-gray-300 dark:border-gray-600">
                    </div>

                    <div>
                        <label class="text-gray-700 dark:text-gray-300">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir"
                               value="{{ $tanggalAkhir }}"
                               class="block w-full mt-1 dark:bg-gray-700 dark:text-gray-100 rounded border-gray-300 dark:border-gray-600">
                    </div>

                    <div class="flex items-end">
                        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            {{-- TABEL LAPORAN --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Data Transaksi</h3>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Kode</th>
                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Tanggal</th>
                            <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-200">Total</th>
                            <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-200">Bayar</th>
                            <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-200">Kembalian</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                        @forelse($transaksi as $t)
                            <tr>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $t->kode_transaksi }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">
                                    {{ $t->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-2 text-right text-gray-800 dark:text-gray-300">Rp {{ number_format($t->total) }}</td>
                                <td class="px-4 py-2 text-right text-gray-800 dark:text-gray-300">Rp {{ number_format($t->bayar) }}</td>
                                <td class="px-4 py-2 text-right text-gray-800 dark:text-gray-300">Rp {{ number_format($t->kembalian) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">
                                    Tidak ada data transaksi
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                {{-- TOTAL --}}
                <div class="mt-4 text-right">
                    <span class="font-semibold text-gray-800 dark:text-gray-100">
                        Total Pendapatan: Rp {{ number_format($totalPendapatan) }}
                    </span>
                </div>
                <a href="{{ route('laporan.pdf', ['tanggal_mulai' => $tanggalMulai, 'tanggal_akhir' => $tanggalAkhir]) }}"
   class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded mb-4 inline-block">
    Export PDF
</a>

            </div>

        </div>
    </div>
</x-app-layout>
