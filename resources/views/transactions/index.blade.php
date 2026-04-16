<x-layout title="Transactions">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Transacciones</h1>
            <p class="text-sm text-gray-500 mt-1">Historial de tus ingresos y gastos</p>
        </div>
        <a href="/transactions/create"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
            <i class="fa-solid fa-plus"></i>
            Nueva transacción
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-x-scroll">

        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Todas las transacciones</h2>
            <span class="text-sm text-gray-400">{{ $transactions->count() }} transacciones</span>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <th class="px-6 py-3">Descripcion</th>
                    <th class="px-6 py-3">Tipo</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3 text-right">Monto</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">

                @forelse ($transactions as $transaction)
                    <tr class="hover:bg-gray-50 transition-colors">

                        <td class="px-6 py-4 text-gray-700">
                            {{ $transaction->description ?? '—' }}
                        </td>

                        <td class="px-6 py-4">
                            @if ($transaction->type === 'income')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                    <i class="fa-solid fa-arrow-up"></i>
                                    Ingreso
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-600">
                                    <i class="fa-solid fa-arrow-down"></i>
                                    Gasto
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @if ($transaction->state === 'completed')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Completado
                                </span>
                            @elseif ($transaction->state === 'pending')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-600">
                                    <i class="fa-solid fa-clock"></i>
                                    Pendiente
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-500">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Fallido
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-right font-semibold">
                            @if ($transaction->type === 'income')
                                <span class="text-emerald-600">+${{ number_format($transaction->amount, 2) }}</span>
                            @else
                                <span class="text-red-500">-${{ number_format($transaction->amount, 2) }}</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/transactions/{{ $transaction->id }}/edit"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-colors">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Editar
                                </a>
                                <form action="/transactions/{{ $transaction->id }}" method="POST" onsubmit="return confirm('¿Estás seguro que quieres borrar esta transacción?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-500 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                                        <i class="fa-solid fa-trash"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                                <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                                <p class="text-sm">No hay transacciones registradas</p>
                            </div>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</x-layout>
