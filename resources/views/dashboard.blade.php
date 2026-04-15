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
                <p class="text-2xl font-bold text-gray-900">$0.00</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4">
            <div class="flex-shrink-0 bg-emerald-100 text-emerald-600 rounded-lg p-3">
                <i class="fa-solid fa-arrow-trend-up text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Ingresos</p>
                <p class="text-2xl font-bold text-emerald-600">$0.00</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4">
            <div class="flex-shrink-0 bg-red-100 text-red-500 rounded-lg p-3">
                <i class="fa-solid fa-arrow-trend-down text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Gastos</p>
                <p class="text-2xl font-bold text-red-500">$0.00</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4">
            <div class="flex-shrink-0 bg-violet-100 text-violet-600 rounded-lg p-3">
                <i class="fa-solid fa-tag text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Categorias</p>
                <p class="text-2xl font-bold text-gray-900">0</p>
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
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Ver todas</a>
            </div>

            <div class="divide-y divide-gray-50">
                {{-- Empty state --}}
                <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                    <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                    <p class="text-sm">No hay transacciones registradas</p>
                </div>

                {{-- Ejemplo income (descomenta cuando tengas datos) --}}
                {{--
                <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-100 text-emerald-600 rounded-lg p-2">
                            <i class="fa-solid fa-arrow-up text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Nombre transaccion</p>
                            <p class="text-xs text-gray-400">Categoria</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-emerald-600">+$0.00</p>
                        <p class="text-xs text-gray-400">01 Jan 2026</p>
                    </div>
                </div>
                --}}

                {{-- Ejemplo expense (descomenta cuando tengas datos) --}}
                {{--
                <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="bg-red-100 text-red-500 rounded-lg p-2">
                            <i class="fa-solid fa-arrow-down text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">Nombre transaccion</p>
                            <p class="text-xs text-gray-400">Categoria</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-red-500">-$0.00</p>
                        <p class="text-xs text-gray-400">01 Jan 2026</p>
                    </div>
                </div>
                --}}
            </div>
        </div>

        {{-- Categories --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-layer-group text-violet-500"></i>
                    Categorias
                </h2>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Gestionar</a>
            </div>

            <div class="p-6 space-y-4">
                {{-- Empty state --}}
                <div class="flex flex-col items-center justify-center py-10 text-gray-400">
                    <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                    <p class="text-sm">No hay categorias</p>
                </div>

                {{-- Ejemplo de categoria (descomenta cuando tengas datos) --}}
                {{--
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-500"></span>
                        <span class="text-sm text-gray-700">Nombre categoria</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-800">$0.00</span>
                </div>
                --}}
            </div>
        </div>

    </div>

</x-layout>
