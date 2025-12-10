<header class="bg-white dark:bg-gray-800 shadow px-6 py-4 ml-64 flex justify-between items-center">
    <div class="text-lg font-semibold">
        {{ $title ?? 'Dashboard' }}
    </div>

    <div class="flex items-center gap-3">
        <span>{{ auth()->user()->name }}</span>
        <form action="/logout" method="POST">
            @csrf
            <x-ui.button color="red">Logout</x-ui.button>
        </form>
    </div>
</header>
