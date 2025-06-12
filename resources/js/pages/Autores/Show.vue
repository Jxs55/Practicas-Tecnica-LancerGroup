<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1>Detalles del Autor</h1>
      <div>
        <Link :href="`/autores/${autor.id}/edit`" class="btn btn-warning me-2">
          Editar
        </Link>
        <Link href="/autores" class="btn btn-secondary">
          Volver
        </Link>
      </div>
    </div>
    
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="card-title mb-0">Información del autor</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Nombre:</strong> {{ autor.nombre }}</p>
            <p><strong>Apellido:</strong> {{ autor.apellido }}</p>
            <p><strong>País:</strong> {{ autor.pais }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Fecha de registro:</strong> {{ formatDate(autor.fecha_registro) }}</p>
            <p><strong>Cantidad de libros:</strong> {{ autor.libros.length }}</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Libros del autor</h5>
      </div>
      <div class="card-body">
        <div v-if="autor.libros.length === 0" class="alert alert-info">
          Este autor no tiene libros registrados.
        </div>
        <div v-else>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Edición</th>
                <th>Fecha de publicación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="libro in autor.libros" :key="libro.id">
                <td>{{ libro.nombre }}</td>
                <td>{{ libro.edicion }}</td>
                <td>{{ formatDate(libro.fecha_publicacion) }}</td>
                <td>
                  <Link :href="`/libros/${libro.id}`" class="btn btn-sm btn-info">
                    Ver
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  autor: Object
});

// Función para formatear fechas
const formatDate = (dateString) => {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  return new Intl.DateTimeFormat('es-ES').format(date);
};
</script>