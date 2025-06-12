<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = ['nombre', 'fecha_publicacion', 'edicion'];

    public function autores()
    {
        return $this->belongsToMany(Autor::class);
    }
}
