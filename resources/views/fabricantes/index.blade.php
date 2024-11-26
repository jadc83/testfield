<x-app-layout>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if(session('exito'))
            <div class="text-green-400">
                {{ session('exito') }}
            </div>
        @endif
    </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>

                    <th scope="col" class="px-6 py-3 text-end">Acciones
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fabricantes as $fabricante)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td class="px-6 py-4">
                        {{$fabricante->nombre}}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{route('fabricantes.edit', $fabricante)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('fabricantes.destroy', $fabricante) }}">
                            @method('DELETE')
                            @csrf
                            <a href="{{ route('fabricantes.destroy', $fabricante) }}"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                Eliminar
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <div class="flex justify-center w-full">
            <form action="{{ route('fabricantes.create') }}" method="GET">
                <button type="submit" class="text-white p-2 mt-2 bg-purple-600 rounded-lg text-center">
                    Nuevo fabricante
                </button>
            </form>
        </div>

</x-app-layout>
