<x-layout title="Dashboard">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Resumen de tus transacciones y categorias</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4">
            <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 rounded-lg p-3">
                <i class="fa-solid fa-scale-balanced text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Balance</p>
                <p class="text-2xl font-bold text-gray-900">${{ number_format($balance, 2) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4">
            <div class="flex-shrink-0 bg-emerald-100 text-emerald-600 rounded-lg p-3">
                <i class="fa-solid fa-arrow-trend-up text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Ingresos</p>
                <p class="text-2xl font-bold text-emerald-600">${{ number_format($income, 2) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4">
            <div class="flex-shrink-0 bg-red-100 text-red-500 rounded-lg p-3">
                <i class="fa-solid fa-arrow-trend-down text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Gastos</p>
                <p class="text-2xl font-bold text-red-500">${{ number_format($expense, 2) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4">
            <div class="flex-shrink-0 bg-violet-100 text-violet-600 rounded-lg p-3">
                <i class="fa-solid fa-tag text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Categorias</p>
                <p class="text-2xl font-bold text-gray-900">{{ $categories->count() }}</p>
            </div>
        </div>

    </div>

    {{-- Main content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent transactions --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-indigo-500"></i>
                    Transacciones recientes
                </h2>
                <a href="/transactions" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Ver todas</a>
            </div>

            <div class="divide-y divide-gray-50">
                @forelse ($transactions as $transaction)
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 bg-gray-100 text-gray-500 rounded-lg p-3">
                                <i class="fa-solid fa-money-bill-transfer text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $transaction->description }}</p>
                                <p class="text-sm text-gray-500">{{ $transaction->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-semibold {{ $transaction->type === 'income' ? 'text-emerald-600' : 'text-red-500' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                        </p>
                    </div>
                @empty
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                        <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                        <p class="text-sm">No hay transacciones registradas</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Categories --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-layer-group text-violet-500"></i>
                    Categorias
                </h2>
                <a href="/categories" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Gestionar</a>
            </div>

            <div class="p-6 space-y-4 flex flex-row gap-4 flex-wrap ">

                @forelse ($categories as $category)
                    <div class="flex-inline items-center justify-between">
                        <div class="bg-gray-100 text-gray-500 rounded-full px-3 py-1 cursor-pointer hover:bg-purple-200">
                            <span class="text-sm text-gray-700">{{ $category->name }}</span>
                        </div>
                    </div>
                @empty
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center py-10 text-gray-400">
                        <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                        <p class="text-sm">No hay categorias</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</x-layout>
