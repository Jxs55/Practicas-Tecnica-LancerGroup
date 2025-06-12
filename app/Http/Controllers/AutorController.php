<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::withCount('libros')->get();
        return Inertia::render('Autores/Index', [
            'autores' => $autores
        ]);
    }

    public function create()
    {
        return Inertia::render('Autores/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
        ]);
        
        $validated['fecha_registro'] = now();
        
        Autor::create($validated);
        
        return redirect()->route('autores.index');
    }

    public function show($id)
    {
        $autor = Autor::with('libros')->findOrFail($id);
        return Inertia::render('Autores/Show', [
            'autor' => $autor
        ]);
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return Inertia::render('Autores/Edit', [
            'autor' => $autor
        ]);
    }

    public function update(Request $request, $id)
    {
        $autor = Autor::findOrFail($id);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
        ]);
        
        $autor->update($validated);
        
        return redirect()->route('autores.index');
    }

    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);
        $autor->delete(); // Soft delete
        return redirect()->route('autores.index');
    }

    // Añadir este método
public function ocultar($id)
{
    $autor = Autor::findOrFail($id);
    $autor->delete(); // Esto aplica SoftDelete
    
    return redirect()->route('autores.index');
}

}