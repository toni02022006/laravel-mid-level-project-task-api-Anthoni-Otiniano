# API RESTful de Gestión de Proyectos y Tareas

Esta API RESTful está diseñada para la gestión eficiente de proyectos y las tareas asociadas a ellos. Ofrece un conjunto de endpoints validados para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre ambas entidades.

## 🚀 Tecnologías Utilizadas

* **Framework:** Laravel (versión 10.x/11.x)
* **Lenguaje de Programación:** PHP (versión 8.x)
* **Base de Datos:** MySQL
* **ORM:** Eloquent
* **Validación de Datos:** Laravel Form Requests
* **Identificadores Únicos:** UUIDs
* **Herramienta de Pruebas:** Postman
* **Documentación API:** L5-Swagger (OpenAPI/Swagger UI)

## 📦 Instalación y Configuración

Sigue estos pasos para poner en marcha el proyecto en tu entorno local.

1.  **Clonar el repositorio (si aplica):**
    ```bash
    git clone https://github.com/toni02022006/laravel-mid-level-project-task-api-Anthoni-Otiniano.git
    cd Prueba
    ```

2.  **Instalar dependencias de Composer:**
    ```bash
    composer install
    ```

3.  **Configurar el archivo `.env`:**
    * Copia el archivo de ejemplo:
        ```bash
        cp .env.example .env
        ```
    * Genera la clave de aplicación:
        ```bash
        php artisan key:generate
        ```
    * Edita el archivo `.env` y configura tus credenciales de base de datos (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Ejecutar las migraciones de la base de datos:**
    Esto creará las tablas `projects` y `tasks` en tu base de datos.
    ```bash
    php artisan migrate
    ```

5.  **Iniciar el servidor de desarrollo de Laravel:**
    ```bash
    php artisan serve
    ```
    La API estará disponible en `http://127.0.0.1:8000`.

## ⚙️ Estructura de la Base de Datos

La base de datos consta de dos tablas principales relacionadas: `projects` y `tasks`.

### `projects` Tabla

* `id` (UUID): Clave primaria única.
* `name` (string): Nombre del proyecto (requerido, único, 3-100 caracteres).
* `description` (text): Descripción del proyecto (opcional).
* `status` (string): Estado del proyecto ("active", "inactive").
* `created_at` (timestamp)
* `updated_at` (timestamp)

### `tasks` Tabla

* `id` (UUID): Clave primaria única para cada tarea.
* `project_id` (UUID): Clave foránea que referencia el `id` de `projects` (requerido).
* `title` (string): Título de la tarea (requerido, 3-100 caracteres).
* `description` (text): Descripción de la tarea (opcional).
* `status` (string): Estado de la tarea ("pending", "in_progress", "done").
* `priority` (string): Prioridad de la tarea ("low", "medium", "high").
* `due_date` (date): Fecha de vencimiento (requerido, no puede ser una fecha pasada).
* `created_at` (timestamp)
* `updated_at` (timestamp)

## 📋 Endpoints de la API

Todos los endpoints base están bajo `/api`.

### Proyectos (`/api/projects`)

| Método | Ruta               | Descripción                                            | Request Body (JSON) | Response (JSON)                                |
| :----- | :----------------- | :----------------------------------------------------- | :------------------ | :--------------------------------------------- |
| `POST` | `/api/projects`    | Crea un nuevo proyecto.                                | `name`, `description` (opcional), `status` | `201 Created` + Objeto `Project`               |
| `GET`  | `/api/projects`    | Lista todos los proyectos.                             | _Ninguno_           | `200 OK` + Array de `Project`s                 |
| `GET`  | `/api/projects/{id}` | Obtiene los detalles de un proyecto específico.      | _Ninguno_           | `200 OK` + Objeto `Project` o `404 Not Found`  |
| `PUT`  | `/api/projects/{id}` | Actualiza un proyecto existente.                       | `name`, `description` (opcional), `status` | `200 OK` + Objeto `Project` actualizado o `422 Unprocessable Entity` |
| `DELETE` | `/api/projects/{id}` | Elimina un proyecto.                                   | _Ninguno_           | `204 No Content` o `404 Not Found`             |

**Filtros para `GET /api/projects`:**
* `?status=active` o `?status=inactive`
* `?name=mi_nombre_parcial`
* Combinación: `?status=active&name=mi_nombre`

### Tareas (`/api/tasks`)

| Método | Ruta               | Descripción                                            | Request Body (JSON) | Response (JSON)                                |
| :----- | :----------------- | :----------------------------------------------------- | :------------------ | :--------------------------------------------- |
| `POST` | `/api/tasks`       | Crea una nueva tarea.                                  | `project_id`, `title`, `description` (opcional), `status`, `priority`, `due_date` | `201 Created` + Objeto `Task`                  |
| `GET`  | `/api/tasks`       | Lista todas las tareas.                                | _Ninguno_           | `200 OK` + Array de `Task`s                    |
| `GET`  | `/api/tasks/{id}` | Obtiene los detalles de una tarea específica.          | _Ninguno_           | `200 OK` + Objeto `Task` o `404 Not Found`     |
| `PUT`  | `/api/tasks/{id}` | Actualiza una tarea existente.                         | `project_id`, `title`, `description` (opcional), `status`, `priority`, `due_date` | `200 OK` + Objeto `Task` actualizado o `422 Unprocessable Entity` |
| `DELETE` | `/api/tasks/{id}` | Elimina una tarea.                                     | _Ninguno_           | `204 No Content` o `404 Not Found`             |

**Filtros para `GET /api/tasks`:**
* `?status=pending`, `?status=in_progress` o `?status=done`
* `?priority=low`, `?priority=medium` o `?priority=high`
* `?due_date=YYYY-MM-DD`
* `?project_id=UUID_DEL_PROYECTO`
* Combinaciones (ej. `?status=pending&priority=high`)

## 📄 Documentación Interactiva (Swagger UI)

Para una vista interactiva de la API, puedes acceder a la interfaz de Swagger UI.

1.  **Instala el paquete L5-Swagger:**
    ```bash
    composer require "darkaonline/l5-swagger"
    ```
2.  **Publica la configuración y los assets:**
    ```bash
    php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
    ```
3.  **Genera el archivo de documentación OpenAPI:**
    ```bash
    php artisan l5-swagger:generate
    ```
4.  **Accede a la documentación en tu navegador:**
    ```
    [http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)
    ```

**Nota:** Para que la documentación interactiva muestre los detalles de los parámetros, modelos y respuestas, deberás añadir anotaciones PHPDoc (utilizando `zircote/swagger-php`) en tus controladores, modelos y Form Requests. (Esto sería el siguiente paso si deseas documentar más a fondo).

## 🚀 Pruebas con Postman

Se recomienda utilizar Postman (o una herramienta similar) para probar los endpoints.
* Asegúrate de establecer el método HTTP correcto (GET, POST, PUT, DELETE).
* Para peticiones `POST` y `PUT`, configura el `Content-Type` de la cabecera como `application/json` y envía el cuerpo de la petición en formato JSON.

---

Espero que esto te sea de gran utilidad para presentar tu proyecto. Si logras solucionar el problema con la visualización de Swagger, el siguiente paso sería añadir las anotaciones específicas para que la documentación interactiva muestre todos los detalles de los endpoints.
