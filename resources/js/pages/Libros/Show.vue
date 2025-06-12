<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>{{ libro.nombre }}</h1>
      <div>
        <Link href="/libros" class="btn btn-secondary me-2">
          Volver
        </Link>
        <Link :href="`/libros/${libro.id}/edit`" class="btn btn-warning">
          Editar
        </Link>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">
            Información del libro
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-4">Nombre:</dt>
              <dd class="col-sm-8">{{ libro.nombre }}</dd>
              
              <dt class="col-sm-4">Fecha de publicación:</dt>
              <dd class="col-sm-8">{{ formatDate(libro.fecha_publicacion) }}</dd>
              
              <dt class="col-sm-4">Edición:</dt>
              <dd class="col-sm-8">{{ libro.edicion }}</dd>
            </dl>
          </div>
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Autores
          </div>
          <div class="card-body">
            <div v-if="libro.autores.length === 0" class="alert alert-info">
              Este libro no tiene autores asignados.
            </div>
            <ul v-else class="list-group">
              <li v-for="autor in libro.autores" :key="autor.id" class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  {{ autor.nombre }} {{ autor.apellido }} 
                  <span class="text-muted">({{ autor.pais }})</span>
                  <span v-if="autor.deleted_at" class="badge bg-secondary ms-2">Oculto</span>
                </div>
                <Link v-if="!autor.deleted_at" :href="`/autores/${autor.id}`" class="btn btn-sm btn-info">
                  Ver autor
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  libro: Object
});

// Función para formatear fechas
const formatDate = (dateString) => {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  return new Intl.DateTimeFormat('es-ES').format(date);
};
</script>