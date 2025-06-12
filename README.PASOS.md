composer install
cp .env.example .env (y configura los datos de la base de datos)
(luego asegurate de crear la base de datos en tu mysql)
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan storage:link
php artisan serve

## 🚀 Pasos para poner en marcha el proyecto

Sigue estos pasos en orden para ejecutar correctamente el sistema.

### 1. Clonar el repositorio y entrar en el.

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar el entorno

```bash
cp .env.example .env
```

Luego, edita el archivo `.env` con los datos correctos de tu base de datos.

### 4. Crear la base de datos

Asegúrate de tener una base de datos vacía creada en tu servidor MySQL con el mismo nombre que configuraste en `.env`.

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

### 7. Instalar dependencias de JavaScript

```bash
npm install
```

### 8. Compilar los assets de Vue

```bash
npm run build
```

> 🛠️ También puedes usar `npm run dev` si estás en desarrollo y quieres recargar automáticamente los cambios.  
> Para producción, lo ideal es usar `npm run build`.

### 9. Crear enlace simbólico al storage

```bash
php artisan storage:link
```

### 10. Levantar el servidor local

```bash
php artisan serve
```

Luego, accede a `http://localhost:8000` desde tu navegador.

### Y listo 😊
