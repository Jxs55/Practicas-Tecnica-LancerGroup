<template>
  <div>
    <!-- Navegación Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
      <div class="container">
        <a class="navbar-brand" href="/">Librería</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <Link class="nav-link" :class="{ active: $page.component === 'Home' }" href="/">Inicio</Link>
            </li>
            <li class="nav-item">
              <Link class="nav-link" :class="{ active: $page.component.includes('Autores') }" href="/autores">Autores</Link>
            </li>
            <li class="nav-item">
              <Link class="nav-link" :class="{ active: $page.component.includes('Libros') }" href="/libros">Libros</Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Contenido principal -->
    <main>
      <slot></slot>
    </main>
    
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const $page = usePage();
</script>