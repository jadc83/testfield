<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fabricantes = Fabricante::all();
        return view('productos.create', ['fabricantes' => $fabricantes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'denominacion' => 'required|string|max:255|unique:productos,denominacion',
            'precio' => 'required|numeric|between:0,9999.99',
            'fabricante_id' => 'required|exists:fabricantes,id',
        ], [
            'denominacion.required' => 'La denominación es obligatoria.',
            'denominacion.unique' => 'El producto ya existe en la base de datos',
            'denominacion.max' => 'La denominación no puede tener más de 255 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.between' => 'El precio debe estar entre 0 y 9999.99.',
            'fabricante_id.required' => 'El fabricante es obligatorio.',
            'fabricante_id.exists' => 'El fabricante seleccionado no existe.',
        ]);

        $producto = Producto::create($validated);
        session()->flash('exito', 'Producto creado correctamente.');
        return redirect()->route('productos.index', $producto);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', ['producto' => $producto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $fabricantes = Fabricante::all();
        return view('productos.edit', ['producto' => $producto, 'fabricantes' => $fabricantes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'denominacion' => 'required|string|max:255|unique:productos,denominacion',
            'precio' => 'required|numeric|between:0,9999.99',
            'fabricante_id' => 'required|exists:fabricantes,id',
        ], [
            'denominacion.required' => 'La denominación es obligatoria.',
            'denominacion.max' => 'La denominación no puede tener más de 255 caracteres.',
            'denominacion.unique' => 'El producto ya existe en la base de datos',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.between' => 'El precio debe estar entre 0 y 9999.99.',
            'fabricante_id.required' => 'El fabricante es obligatorio.',
            'fabricante_id.exists' => 'El fabricante seleccionado no existe.',
        ]);

        $producto->fill($validated);
        $producto->save();
        session()->flash('exito', 'Los cambios se guardaron correctamente.');
        return redirect()->route('productos.index', $producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }

        /**
     * Añade un producto al carrito desde el index de productos
     */
    public function comprar(Producto $producto)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += 1;
        } else {
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->denominacion,
                'precio' => $producto->precio,
                'cantidad' => 1,
            ];
        }
        session(['carrito' => $carrito]);
        session()->flash('exito', 'Articulo agregado al carrito.');
        return redirect()->route('productos.index');
    }

        /**
     * Añade un producto al carrito desde la vista del carrito
     */

    public function add(Producto $producto)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += 1;
        } else {
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->denominacion,
                'precio' => $producto->precio,
                'cantidad' => 1,
            ];
        }
        session(['carrito' => $carrito]);
        return redirect()->route('micarrito');
    }

         /**
     * Resta un producto al carrito desde la vista del carrito
     */

    public function resta(Producto $producto)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$producto->id])) {
            if ($carrito[$producto->id]['cantidad'] > 1) {
                $carrito[$producto->id]['cantidad'] -= 1;
            } else {
                unset($carrito[$producto->id]);
            }
        }
        session(['carrito' => $carrito]);
        return redirect()->route('micarrito');
    }
         /**
     * Crea una factura, enlaza los productos del carrito, los asigna a la factura y vacia el carrito
     */

    public function pagar()
    {
        if (Auth::check()) {
            $factura = Factura::create([
                'user_id' => Auth::id(),
                'created_at' => now(),
            ]);

            $carrito = session('carrito');
            if (session()->has('carrito')) {
                $carrito = session('carrito');

                foreach ($carrito as $producto) {
                    DB::table('factura_producto')->insert([
                        'factura_id' => $factura->id,
                        'producto_id' => $producto['id'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
            session()->forget('carrito');
            return redirect()->route('facturas');
        }

        return redirect()->route('login');
    }
         /**
     * Vacia el carrito
     */

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('micarrito');
    }
}
