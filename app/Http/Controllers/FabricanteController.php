<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFabricanteRequest;
use App\Http\Requests\UpdateFabricanteRequest;
use App\Models\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fabricantes = Fabricante::all();
        return view('fabricantes.index', ['fabricantes' => $fabricantes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fabricantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ], [
            'nombre.required' => 'La denominación es obligatoria.',
            'nombre.max' => 'La denominación no puede tener más de 255 caracteres.',
        ]);

        $fabricante= Fabricante::create($validated);
        session()->flash('exito', 'Fabricante creado correctamente.');

        return redirect()->route('fabricantes.index', $fabricante);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fabricante $fabricante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fabricante $fabricante)
    {
        return view('fabricantes.edit', ['fabricante' => $fabricante]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fabricante $fabricante)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
        ]);


        $fabricante->fill($validated);
        $fabricante->save();
        session()->flash('exito', 'Los cambios se guardaron correctamente.');
        return redirect()->route('fabricantes.index', ['fabricante' => $fabricante]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fabricante $fabricante)
    {
        $fabricante->delete();
        return redirect()->route('fabricantes.index');
    }
}
