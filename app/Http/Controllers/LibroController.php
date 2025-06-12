<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::with('autores')->get();
        return Inertia::render('Libros/Index', [
            'libros' => $libros
        ]);
    }

    public function create()
    {
        $autores = Autor::all();
        return Inertia::render('Libros/Create', [
            'autores' => $autores
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_publicacion' => 'required|date',
            'edicion' => 'required|string|max:255',
            'autor_ids' => 'required|array|min:1',
        ]);
        
        $libro = Libro::create([
            'nombre' => $validated['nombre'],
            'fecha_publicacion' => $validated['fecha_publicacion'],
            'edicion' => $validated['edicion'],
        ]);
        
        $libro->autores()->attach($validated['autor_ids']);
        
        return redirect()->route('libros.index');
    }

    public function show($id)
    {
        $libro = Libro::with('autores')->findOrFail($id);
        return Inertia::render('Libros/Show', [
            'libro' => $libro
        ]);
    }

    public function edit($id)
    {
        $libro = Libro::with('autores')->findOrFail($id);
        $autores = Autor::all();
        
        return Inertia::render('Libros/Edit', [
            'libro' => $libro,
            'autores' => $autores
        ]);
    }

    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_publicacion' => 'required|date',
            'edicion' => 'required|string|max:255',
            'autor_ids' => 'required|array|min:1',
        ]);
        
        $libro->update([
            'nombre' => $validated['nombre'],
            'fecha_publicacion' => $validated['fecha_publicacion'],
            'edicion' => $validated['edicion'],
        ]);
        
        $libro->autores()->sync($validated['autor_ids']);
        
        return redirect()->route('libros.index');
    }

    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();
        return redirect()->route('libros.index');
    }
}