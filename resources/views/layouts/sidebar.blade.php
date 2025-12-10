<aside class="w-64 bg-white dark:bg-gray-900 shadow-lg fixed inset-y-0 left-0 z-40">
    <div class="p-6 text-xl font-bold">
        {{ config('app.name') }}
    </div>

    <nav class="mt-4 space-y-2">
        <a href="/dashboard" class="block px-6 py-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
            Dashboard
        </a>

        <a href="/kasir" class="block px-6 py-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
            Kasir
        </a>

        <a href="/barang" class="block px-6 py-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
            Data Barang
        </a>
    </nav>
</aside>
