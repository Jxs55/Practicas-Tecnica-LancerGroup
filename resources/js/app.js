import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import Layout from './Layouts/Layout.vue'

// Importar CSS (bootstrap y personalizado)
import '../css/app.css'

// Importar Bootstrap JS
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

// Inicializar el progreso
router.on('start', () => {
    // Lógica para mostrar indicador de carga
})

router.on('finish', () => {
    // Lógica para ocultar indicador de carga
})

// Configurar el token CSRF para todas las solicitudes de Inertia
router.on('before', (event) => {
  // Asegurar que todas las solicitudes tengan el token CSRF
  event.detail.visit.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
  // Si es un método PUT o DELETE, asegurarse de enviar _method
  if (['put', 'patch', 'delete'].includes(event.detail.visit.method.toLowerCase())) {
    if (!event.detail.visit.data._method) {
      event.detail.visit.data._method = event.detail.visit.method;
    }
  }
});

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    
    // Registrar todos los componentes disponibles en la consola
    console.log('Componentes disponibles:', Object.keys(pages));
    
    let page = pages[`./Pages/${name}.vue`]
    
    if (!page) {
      console.error(`No se encontró el componente: ./Pages/${name}.vue`)
      console.log('Buscando en:', `./Pages/${name}.vue`)
      return
    }
    
    // Asignar el layout por defecto a todas las páginas
    page.default.layout = page.default.layout || Layout
    
    return page
  },
  setup({ el, App, props, plugin }) {
    // Configurar CSRF para todas las solicitudes
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Crear la aplicación
    const app = createApp({ render: () => h(App, props) });
    
    // Usar el plugin de Inertia
    app.use(plugin);
    
    // Registrar componente Link
    app.component('Link', Link);
    
    // Montar la aplicación
    app.mount(el);
  },
})