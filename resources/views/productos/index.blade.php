<x-app-layout>

    <div class="flex justify-end w-full">
        <div class="flex w-1/6 p-4">
            <div class="p-4 bg-blue-600 text-white text-center rounded-full">
                {{ session('carrito') != null ? count(session('carrito')) : 'Vacio' }}
            </div>
        </div>
    </div>

        @if (session('exito'))
        <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
              <p>El producto se ha creado correctamente.</p>
            </div>
        </div>
        @endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-3/4">
            <tr>
                <th scope="col" class="px-6 py-3 text-left">
                    Nombre del producto
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Marca
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Precio
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($productos as $producto)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('productos.show', $producto) }}">{{ $producto->denominacion }}</a>
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ $producto->fabricante->nombre }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        ${{ $producto->precio }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <!-- Acciones: Editar, Añadir al carrito, Eliminar -->
                        <form action="{{ route('productos.comprar', $producto) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit"
                                class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md">
                                Al carrito
                            </button>
                        </form>

                        <form action="{{ route('productos.edit', $producto) }}" method="GET" class="inline-block">
                            <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">
                                Editar
                            </button>
                        </form>

                        <form method="POST" action="{{ route('productos.destroy', $producto) }}" class="inline-block">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md"
                                onclick="return confirm('¿Está seguro?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-center w-full mt-4">
        <form action="{{ route('productos.create') }}" method="GET">
            <button type="submit" class="text-white p-2 bg-purple-600 rounded-lg text-center">
                Nuevo producto
            </button>
        </form>
    </div>


</x-app-layout>
