<div class="overflow-hidden rounded-xl shadow">
<table class="w-full border-collapse">
    <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
        {{ $head }}
    </thead>
    <tbody class="bg-white dark:bg-gray-800">
        {{ $slot }}
    </tbody>
</table>
</div>
<x-ui.table>
    <x-slot name="head">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Harga</th>
        </tr>
    </x-slot>

    <tr>
        <td class="p-3">Barang A</td>
        <td class="p-3">10000</td>
    </tr>
</x-ui.table>
