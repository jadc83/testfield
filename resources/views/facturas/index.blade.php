<x-app-layout>
    <h1 class="ml-4 text-3xl font-bold text-gray-800 mb-6">{{ Auth::user()->name }}</h1>

    @foreach (Auth::user()->facturas as $factura)
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-1/4 mx-auto">
            <h2 class="text-xl text-left font-semibold text-gray-700 mb-4">Factura #{{ $factura->id }}</h2>
            <h3 class="text-lg text-left font-semibold text-gray-700 mb-4">{{ $factura->created_at->format('d-m-Y') }}</h3>
            @foreach ($factura->productos as $articulo)
                <div class="flex justify-between items-center py-2 border-b border-gray-300">
                    <p class="text-lg font-medium text-gray-800">{{ $articulo->denominacion }}</p>
                    <p class="text-lg font-semibold text-green-600">{{$articulo->precio}}€</p>
                </div>
            @endforeach
        </div>
    @endforeach
</x-app-layout>
