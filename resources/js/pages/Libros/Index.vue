<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>Libros</h1>
      <Link href="/libros/create" class="btn btn-primary">
        Nuevo Libro
      </Link>
    </div>
    
    <div class="card">
      <div class="card-body">
        <div v-if="libros.length === 0" class="alert alert-info">
          No hay libros registrados. ¡Añade uno!
        </div>
        
        <table v-else class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Fecha de publicación</th>
              <th>Edición</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="libro in libros" :key="libro.id">
              <td>{{ libro.nombre }}</td>
              <td>{{ formatDate(libro.fecha_publicacion) }}</td>
              <td>{{ libro.edicion }}</td>
              <td>
                <div class="btn-group btn-group-sm">
                  <Link :href="`/libros/${libro.id}`" class="btn btn-info">Ver</Link>
                  <Link :href="`/libros/${libro.id}/edit`" class="btn btn-warning">Editar</Link>
                  <button @click="eliminarLibro(libro.id)" class="btn btn-danger">Eliminar</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  libros: Array
});

// Función para formatear fechas
const formatDate = (dateString) => {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  return new Intl.DateTimeFormat('es-ES').format(date);
};

const eliminarLibro = (id) => {
  if (confirm('¿Estás seguro de que quieres eliminar este libro?')) {
    // Usar POST en lugar de DELETE
    router.post(`/libros/${id}`, { _method: 'DELETE' }, {
      preserveScroll: true,
      onSuccess: () => {
        console.log('Libro eliminado correctamente');
      },
      onError: (error) => {
        console.error('Error al eliminar el libro:', error);
      }
    });
  }
};
</script>