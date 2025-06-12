<template>
  <div>
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>Autores</h1>
      <Link href="/autores/create" class="btn btn-primary">
        Nuevo Autor
      </Link>
    </div>
    
    <div class="card">
      <div class="card-body">
        <div v-if="autores.length === 0" class="alert alert-info">
          No hay autores registrados.
        </div>
        
        <table v-else class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>País</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="autor in autores" :key="autor.id">
              <td>{{ autor.nombre }}</td>
              <td>{{ autor.apellido }}</td>
              <td>{{ autor.pais }}</td>
              <td>
                <div class="btn-group btn-group-sm">
                  <Link :href="`/autores/${autor.id}`" class="btn btn-info">Ver</Link>
                  <Link :href="`/autores/${autor.id}/edit`" class="btn btn-warning">Editar</Link>
                  <button @click="eliminarAutor(autor.id)" class="btn btn-danger">Ocultar</button>
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
  autores: Array
});

const eliminarAutor = (id) => {
  if (confirm('¿Estás seguro de que quieres ocultar este autor?')) {
        router.post(`/autores/${id}/ocultar`, {}, {
      preserveScroll: true,
      onSuccess: () => {
      // Opcional: Añadir lógica después de eliminar exitosamente
        console.log('Autor eliminado correctamente');
      },
      onError: (error) => {
        // Manejo de errores
        console.error('Error al eliminar el autor:', error);
      }
    });
  }
};
</script>