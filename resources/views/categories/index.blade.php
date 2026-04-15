<x-layout title="Categories">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Categorias</h1>
            <p class="text-sm text-gray-500 mt-1">Gestiona las categorias de tus transacciones</p>
        </div>
        <a href="/categories/create"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
            <i class="fa-solid fa-plus"></i>
            Nueva categoria
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Todas las categorias</h2>
            <span class="text-sm text-gray-400">{{ $categories->count() }} categorias</span>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Descripcion</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">

                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->description }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/categories/edit/{{ $category->id }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-colors">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Editar
                                </a>
                                <form action="/categories/delete/{{ $category->id }}" method="POST">
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
                    {{-- Empty state --}}
                    <tr>
                        <td colspan="3">
                            <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                                <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                                <p class="text-sm">No hay categorias registradas</p>
                            </div>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</x-layout>
