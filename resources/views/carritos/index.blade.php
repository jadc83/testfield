<x-app-layout>
    <div class="flex flex-col items-center">
        @if (session()->has('carrito'))
            @foreach (session('carrito') as $articulo)
                <div class="flex justify-center bg-slate-600 rounded-lg p-4 m-4 w-1/2 text-white">
                    <p class="p-2">{{ $articulo['nombre'] }} </p>
                    <p class="p-2">Precio / unidad: ${{ $articulo['precio'] }}</p>
                    <p class="p-2">x{{ $articulo['cantidad'] }} </p>
                </div>
            @endforeach
        @else
                <p class="p-2">Tu carrito esta vacio.</p>
        @endif
        <p class="bg-green-600 text-white p-2 mt-4 rounded-lg">{{ $total }}</p>
    </div>
</x-app-layout>
