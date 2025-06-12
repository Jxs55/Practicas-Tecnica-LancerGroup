<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibroController extends Controller
{
    // Muestra la lista de libros
    public function index()
    {
        $libros = Libro::with('autores')->get();
        return Inertia::render('Libros/Index', [
            'libros' => $libros
        ]);
    }
    // Muestra el formulario para crear un nuevo libro
    public function create()
    {
    $autores = Autor::all();
    return Inertia::render('Libros/Create', [
        'autores' => $autores
    ]);
    }
    // Guarda los libro y sus autores asociados
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
    // Muestra los detalles del libro y sus autores asociados
    public function show($id)
    {
        $libro = Libro::with(['autores' => function ($query) {
            $query->withTrashed(); // Esto incluye los autores eliminados
        }])->findOrFail($id);

        return Inertia::render('Libros/Show', [
            'libro' => $libro
        ]);
    }
    // Trae los datos del libro y los autores asociados para la edición
    public function edit($id)
    {
        $libro = Libro::with('autores')->findOrFail($id);
        $autores = Autor::all();

        return Inertia::render('Libros/Edit', [
            'libro' => $libro,
            'autores' => $autores
        ]);
    }
    // Actualiza el libro y sus autores asociados
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
    // Elimina el libro (en realidad lo oculta)
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();
        return redirect()->route('libros.index');
    }

}
