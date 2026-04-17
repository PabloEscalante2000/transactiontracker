<x-layout title="Transaccion">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="/transactions"
           class="inline-flex items-center justify-center w-9 h-9 text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detalle de transaccion</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Registrada el {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}
            </p>
        </div>
    </div>

    <div class="max-w-2xl space-y-6">

        {{-- Amount card --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                @if ($transaction->type === 'income')
                    <div class="bg-emerald-100 text-emerald-600 rounded-xl p-4">
                        <i class="fa-solid fa-arrow-trend-up text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tipo</p>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 mt-1">
                            <i class="fa-solid fa-arrow-up"></i>
                            Ingreso
                        </span>
                    </div>
                @else
                    <div class="bg-red-100 text-red-500 rounded-xl p-4">
                        <i class="fa-solid fa-arrow-trend-down text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tipo</p>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-600 mt-1">
                            <i class="fa-solid fa-arrow-down"></i>
                            Gasto
                        </span>
                    </div>
                @endif
            </div>

            <div class="text-right">
                <p class="text-sm text-gray-500 mb-1">Monto</p>
                @if ($transaction->type === 'income')
                    <p class="text-3xl font-bold text-emerald-600">+${{ number_format($transaction->amount, 2) }}</p>
                @else
                    <p class="text-3xl font-bold text-red-500">-${{ number_format($transaction->amount, 2) }}</p>
                @endif
            </div>
        </div>

        {{-- Details --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm divide-y divide-gray-100">

            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-3 text-gray-500">
                    <i class="fa-solid fa-calendar-days w-4 text-center"></i>
                    <span class="text-sm">Fecha</span>
                </div>
                <span class="text-sm font-medium text-gray-800">
                    {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                </span>
            </div>

            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-3 text-gray-500">
                    <i class="fa-solid fa-circle-half-stroke w-4 text-center"></i>
                    <span class="text-sm">Estado</span>
                </div>
                @if ($transaction->state === 'completed')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-circle-check"></i> Completado
                    </span>
                @elseif ($transaction->state === 'pending')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-600">
                        <i class="fa-solid fa-clock"></i> Pendiente
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-500">
                        <i class="fa-solid fa-circle-xmark"></i> Fallido
                    </span>
                @endif
            </div>

            <div class="flex items-start justify-between px-6 py-4">
                <div class="flex items-center gap-3 text-gray-500">
                    <i class="fa-solid fa-align-left w-4 text-center"></i>
                    <span class="text-sm">Descripcion</span>
                </div>
                <span class="text-sm text-gray-700 text-right max-w-xs">
                    {{ $transaction->description ?? '—' }}
                </span>
            </div>

            <div class="flex items-start justify-between px-6 py-4">
                <div class="flex items-center gap-3 text-gray-500">
                    <i class="fa-solid fa-layer-group w-4 text-center"></i>
                    <span class="text-sm">Categorias</span>
                </div>
                <div class="flex flex-wrap gap-1.5 justify-end max-w-xs">
                    @forelse ($transaction->categories as $category)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                            {{ $category->name }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-400">Sin categorias</span>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="#"
               class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-colors">
                <i class="fa-solid fa-pen-to-square"></i>
                Editar
            </a>
            <form action="#" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-red-500 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                    <i class="fa-solid fa-trash"></i>
                    Eliminar
                </button>
            </form>
        </div>

    </div>

</x-layout>
