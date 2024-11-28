<x-app-layout>
    <div class="flex flex-col items-center">
        @if (session()->has('carrito'))
            @foreach (session('carrito') as $articulo)
                <div class="flex justify-between bg-slate-600 rounded-lg p-4 m-4 w-1/4 text-white">
                    <div class="flex justify-start">
                        <p class="p-2">{{ $articulo['nombre'] }}</p>
                        <p class="p-2">Precio: {{ $articulo['precio'] }}€</p>
                    </div>

                    <div class="flex items-center justify-end">
                        <form action="{{ route('productos.add', $articulo['id']) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit"
                                class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md">+</button>
                        </form>
                        <p class="text-xl m-2">{{ $articulo['cantidad'] }}</p>
                        <form action="{{ route('productos.resta', $articulo['id']) }}" method="POST"
                            class="inline-block">
                            @csrf
                            <button type="submit"
                                class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md">-</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="p-2">Carrito Vacio.</p>
        @endif
    </div>
        <div class="m-4 h-6 w-28 bg-red-600 text-white text-center rounded-lg">
        <form action="{{ route('productos.pagar') }}" method="POST">
            @csrf
            <button type="submit">
                {{ $total != 0 ? $total : 'Carrito Vacio' }}
            </button>
        </form>
    </div>
    <div class="m-4 h-6 w-28 bg-red-600 text-white text-center rounded-lg">
        <form action="{{ route('productos.vaciar') }}" method="POST">
            @csrf
            <button type="submit">
                Vaciar carrito
            </button>
        </form>
    </div>
</x-app-layout>
