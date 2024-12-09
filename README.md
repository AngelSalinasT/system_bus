
Sistema de Gestión de Boletos de Autobús
========================================

Este proyecto permite gestionar la venta de boletos de autobús, incluyendo administración de usuarios, generación de tickets y reportes, entre otras funciones.

Guía de Instalación y Ejecución
--------------------------------

### Requisitos Previos
- **PHP >= 7.3**
- **Composer**
- **Node.js y NPM**
- **Base de datos MySQL o MariaDB**

### Instalación

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/AngelSalinasT/system_bus.git
   cd system_bus
   ```

2. **Instala las dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Instala las dependencias de Node.js:**
   ```bash
   npm install
   ```

4. **Configura las variables de entorno:**
   Copia el archivo `.env.example` a `.env` y configúralo:
   ```bash
   cp .env.example .env
   ```
   Modifica las variables necesarias para la base de datos y otros servicios.

5. **Genera la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

6. **Ejecuta las migraciones para la base de datos:**
   ```bash
   php artisan migrate
   ```

7. **Compila los recursos del frontend:**
   ```bash
   npm run dev
   ```

### Ejecución

1. **Inicia el servidor de desarrollo:**
   ```bash
   php artisan serve
   ```

2. **Accede al sistema:**
   [http://localhost:8000](http://localhost:8000)

APIs Disponibles
----------------

### Usuarios
- **GET /api/v1/users**: Lista todos los usuarios.
- **POST /api/v1/users**: Crea un nuevo usuario.
- **PUT /api/v1/users/{id}**: Actualiza un usuario.
- **DELETE /api/v1/users/{id}**: Elimina un usuario.

### Tickets
- **GET /api/v1/tickets**: Lista todos los tickets.
- **POST /api/v1/tickets**: Crea un nuevo ticket.
- **DELETE /api/v1/tickets/{id}**: Elimina un ticket.

Ejemplo de Consumo
------------------

Utiliza la URL para consultar las tablas:
```
http://localhost:8000/api/v1/users
```
Puedes reemplazar `users` por cualquiera de las tablas de la base de datos para realizar consultas similares.

Estructura del Código
---------------------

### Ejemplo: `ApiFilter.php`

```php
class ApiFilter {
    protected $safeParams = []; // Parámetros seguros
    protected $columnMap = [];  // Mapeo de columnas
    protected $operatorMap = []; // Mapeo de operadores

    public function transform(Request $request) {
        // Implementación de transformación de filtros
    }
}
```
