<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1>Nuevo Libro</h1>
      <Link href="/libros" class="btn btn-secondary">
        Volver
      </Link>
    </div>
    
    <div class="card">
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input 
              type="text" 
              class="form-control" 
              id="nombre" 
              v-model="form.nombre"
              :class="{ 'is-invalid': form.errors.nombre }"
            >
            <div v-if="form.errors.nombre" class="invalid-feedback">
              {{ form.errors.nombre }}
            </div>
          </div>
          
          <div class="mb-3">
            <label for="fecha_publicacion" class="form-label">Fecha de publicación</label>
            <input 
              type="date" 
              class="form-control" 
              id="fecha_publicacion" 
              v-model="form.fecha_publicacion"
              :class="{ 'is-invalid': form.errors.fecha_publicacion }"
            >
            <div v-if="form.errors.fecha_publicacion" class="invalid-feedback">
              {{ form.errors.fecha_publicacion }}
            </div>
          </div>
          
          <div class="mb-3">
            <label for="edicion" class="form-label">Edición</label>
            <input 
              type="text" 
              class="form-control" 
              id="edicion" 
              v-model="form.edicion"
              :class="{ 'is-invalid': form.errors.edicion }"
            >
            <div v-if="form.errors.edicion" class="invalid-feedback">
              {{ form.errors.edicion }}
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Autores</label>
            <div v-if="form.errors.autor_ids" class="alert alert-danger">
              {{ form.errors.autor_ids }}
            </div>
            <div class="card card-body bg-light">
              <div v-if="autores.length === 0" class="alert alert-warning">
                No hay autores registrados. Por favor, crea autores primero.
              </div>
              <div v-else class="form-check" v-for="autor in autores" :key="autor.id">
                <input 
                  class="form-check-input" 
                  type="checkbox" 
                  :id="'autor-' + autor.id" 
                  :value="autor.id" 
                  v-model="form.autor_ids"
                >
                <label class="form-check-label" :for="'autor-' + autor.id">
                  {{ autor.nombre }} {{ autor.apellido }} ({{ autor.pais }})
                </label>
              </div>
            </div>
          </div>
          
          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary" :disabled="form.processing">
              {{ form.processing ? 'Guardando...' : 'Guardar' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
  autores: Array
});

const form = useForm({
  nombre: '',
  fecha_publicacion: '',
  edicion: '',
  autor_ids: []
});

const submit = () => {
  if (form.autor_ids.length === 0) {
    alert('Debe seleccionar al menos un autor');
    return;
  }
  
  form.post('/libros');
};
</script>