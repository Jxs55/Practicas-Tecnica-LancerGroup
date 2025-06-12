<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Autor;
use App\Models\Libro;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear autores
        $autor1 = Autor::create([
            'nombre' => 'Gabriel',
            'apellido' => 'García Márquez',
            'pais' => 'Colombia',
            'fecha_registro' => now(),
        ]);

        $autor2 = Autor::create([
            'nombre' => 'Isabel',
            'apellido' => 'Allende',
            'pais' => 'Chile',
            'fecha_registro' => now()->subDays(5),
        ]);

        $autor3 = Autor::create([
            'nombre' => 'Jorge Luis',
            'apellido' => 'Borges',
            'pais' => 'Argentina',
            'fecha_registro' => now()->subDays(10),
        ]);

        // Crear libros
        $libro1 = Libro::create([
            'nombre' => 'Cien años de soledad',
            'fecha_publicacion' => '1967-05-30',
            'edicion' => 'Primera edición',
        ]);
        
        $libro2 = Libro::create([
            'nombre' => 'La casa de los espíritus',
            'fecha_publicacion' => '1982-01-01',
            'edicion' => 'Original',
        ]);
        
        $libro3 = Libro::create([
            'nombre' => 'El Aleph',
            'fecha_publicacion' => '1949-01-01',
            'edicion' => 'Clásica',
        ]);

        // Asociar autores a libros
        $libro1->autores()->attach($autor1->id);
        $libro2->autores()->attach($autor2->id);
        $libro3->autores()->attach($autor3->id);
        
        // Libro con múltiples autores
        $libro4 = Libro::create([
            'nombre' => 'Antología latinoamericana',
            'fecha_publicacion' => '2020-01-01',
            'edicion' => 'Especial',
        ]);
        
        $libro4->autores()->attach([$autor1->id, $autor2->id, $autor3->id]);
    }
}