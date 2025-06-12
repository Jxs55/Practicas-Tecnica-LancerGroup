<template>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1>Nuevo Autor</h1>
      <Link href="/autores" class="btn btn-secondary">
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
            <label for="apellido" class="form-label">Apellido</label>
            <input 
              type="text" 
              class="form-control" 
              id="apellido" 
              v-model="form.apellido"
              :class="{ 'is-invalid': form.errors.apellido }"
            >
            <div v-if="form.errors.apellido" class="invalid-feedback">
              {{ form.errors.apellido }}
            </div>
          </div>
          
          <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input 
              type="text" 
              class="form-control" 
              id="pais" 
              v-model="form.pais"
              :class="{ 'is-invalid': form.errors.pais }"
            >
            <div v-if="form.errors.pais" class="invalid-feedback">
              {{ form.errors.pais }}
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

const form = useForm({
  nombre: '',
  apellido: '',
  pais: '',
});

const submit = () => {
  form.post('/autores');
};
</script>