<x-layout title="Nueva Transaccion">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="/transactions"
           class="inline-flex items-center justify-center w-9 h-9 text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Editar transaccion</h1>
            <p class="text-sm text-gray-500 mt-0.5">Edita un ingreso o gasto</p>
        </div>
    </div>

    <form action="/transactions/{{ $transaction->id }}" method="POST" class="max-w-2xl space-y-6">
        @csrf

        @method('PATCH')
        {{-- Type toggle --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Tipo de transaccion</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="relative cursor-pointer">
                    <input type="radio" name="type" value="income" class="peer sr-only" {{ $transaction->type === 'income' ? 'checked' : '' }}>
                    <div class="flex items-center justify-center gap-2 px-4 py-3 rounded-lg border-2 border-gray-200 text-gray-500 font-medium text-sm transition-colors peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        Ingreso
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="type" value="expense" class="peer sr-only" {{ $transaction->type === 'expense' ? 'checked' : '' }}>
                    <div class="flex items-center justify-center gap-2 px-4 py-3 rounded-lg border-2 border-gray-200 text-gray-500 font-medium text-sm transition-colors peer-checked:border-red-400 peer-checked:bg-red-50 peer-checked:text-red-600">
                        <i class="fa-solid fa-arrow-trend-down"></i>
                        Gasto
                    </div>
                </label>
            </div>
            @error('type')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Amount, Date --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

            <div>
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1.5">Monto</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 text-sm">$</span>
                    <input type="number" name="amount" id="amount" step="0.01" min="0"
                           value="{{ old('amount', $transaction->amount) }}"
                           placeholder="0.00"
                           class="w-full pl-7 pr-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('amount') border-red-400 @enderror">
                </div>
                @error('amount')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700 mb-1.5">Fecha</label>
                <input type="date" name="date" id="date"
                       value="{{ old('date', $transaction->date) }}"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('date') border-red-400 @enderror">
                @error('date')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Description --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">
                Descripcion
                <span class="font-normal text-gray-400">(opcional)</span>
            </label>
            <textarea name="description" id="description" rows="3"
                      value="{{ old('description', $transaction->description) }}"
                      placeholder="Agrega una descripcion..."
                      class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none @error('description') border-red-400 @enderror">{{ old('description', $transaction->description) }}</textarea>
            @error('description')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- State & Categories --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

            <div>
                <label for="state" class="block text-sm font-semibold text-gray-700 mb-1.5">Estado</label>
                <select name="state" id="state"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('state') border-red-400 @enderror">
                    <option value="pending"   {{ old('state', $transaction->state) === 'pending'   ? 'selected' : '' }}>Pendiente</option>
                    <option value="completed" {{ old('state', $transaction->state) === 'completed' ? 'selected' : '' }}>Completado</option>
                    <option value="failed"    {{ old('state', $transaction->state) === 'failed'    ? 'selected' : '' }}>Fallido</option>
                </select>
                @error('state')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Categorias
                    <span class="font-normal text-gray-400">(opcional)</span>
                </label>

                <div class="flex flex-wrap gap-2">
                    @foreach ($categories as $category)
                        @php $checked = in_array($category->id, old('categories', $transaction->categories->pluck('id')->toArray())); @endphp
                        <label class="category-chip cursor-pointer select-none">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                   class="sr-only peer" {{ $checked ? 'checked' : '' }}>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium border border-gray-200 text-gray-600 bg-white transition-colors
                                         peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600">
                                {{ $category->name }}
                            </span>
                        </label>
                    @endforeach

                    @if ($categories->isEmpty())
                        <p class="text-xs text-gray-400 py-1">No hay categorias disponibles</p>
                    @endif
                </div>

                @error('categories')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="/transactions"
               class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                <i class="fa-solid fa-floppy-disk"></i>
                Actualizar transaccion
            </button>
        </div>

    </form>

</x-layout>
