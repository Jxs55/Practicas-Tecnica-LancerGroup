
<template>
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h1 class="mb-0">Bienvenido a la Biblioteca</h1>
    </div>
    <div class="card-body">
      <p class="lead">
        Este sistema permite gestionar libros y autores. Utiliza el menú superior para navegar entre las diferentes secciones.
      </p>
      <div class="d-flex gap-3 mt-4">
        <Link href="/autores" class="btn btn-primary">Ver Autores</Link>
        <Link href="/libros" class="btn btn-success">Ver Libros</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>