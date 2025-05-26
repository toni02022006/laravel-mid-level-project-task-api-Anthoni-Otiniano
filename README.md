# laravel-mid-level-project-task-api-Anthoni-Otiniano

API RESTful de Gestión de Proyectos y Tareas
Este es un proyecto de prueba técnica para desarrollar una API RESTful con Laravel para la gestión de proyectos y tareas.

Características Principales
Relación 1:N entre Proyectos y Tareas: Un proyecto puede tener múltiples tareas.
Validaciones Estrictas: Uso de Form Requests para asegurar la integridad de los datos.
Filtros Dinámicos Avanzados: Permite buscar y filtrar proyectos y tareas por varios criterios.
Auditoría de Acciones: Registra automáticamente las operaciones de creación, actualización y eliminación.
Documentación de API: Generada automáticamente con L5-Swagger.
Monitoreo de Aplicación: Integración con Laravel Telescope para depuración y monitoreo.
Estructura Limpia, Modular y Profesional: Sigue las mejores prácticas de Laravel.
Duración Estimada
Este proyecto está diseñado para ser completado en un máximo de 2 horas (enfocado en las funcionalidades básicas, la extensión completa podría tomar más).

Entidades y Campos
Proyecto (Project)
Campo	Tipo	Validaciones
id	UUID	Requerido, Clave Primaria
name	String	Requerido, Único, 3-100 caracteres
description	Text	Opcional
status	String	Requerido (valores: active, inactive)
created_at	Datetime	Automático
updated_at	Datetime	Automático
Tarea (Task)
Campo	Tipo	Validaciones
id	UUID	Requerido, Clave Primaria
project_id	UUID	Requerido, Clave Foránea (projects.id)
title	String	Requerido, 3-255 caracteres
description	Text	Opcional
status	String	Requerido (valores: pending, in_progress, done)
priority	String	Requerido (valores: low, medium, high)
due_date	Date	Requerido, fecha válida, no puede ser anterior a hoy
created_at	Datetime	Automático
updated_at	Datetime	Automático
Endpoints de la API
Todos los endpoints están prefijados con /api/.

Proyectos (/api/projects)
GET /api/projects: Listado de proyectos con filtros dinámicos (por status, name, date_range).
POST /api/projects: Crear un nuevo proyecto.
GET /api/projects/{id}: Obtener detalles de un proyecto específico.
PUT /api/projects/{id}: Actualizar un proyecto existente.
DELETE /api/projects/{id}: Eliminar un proyecto (se implementa un borrado físico, el soft delete es opcional y requeriría ajustes en el modelo y migración).
Tareas (/api/tasks)
GET /api/tasks: Listado de tareas con filtros dinámicos (por status, priority, due_date, project_id).
POST /api/tasks: Crear una nueva tarea.
GET /api/tasks/{id}: Obtener detalles de una tarea específica.
PUT /api/tasks/{id}: Actualizar una tarea existente.
DELETE /api/tasks/{id}: Eliminar una tarea.
Requisitos del Sistema
Para ejecutar este proyecto, necesitas lo siguiente:

PHP: Versión 8.1 o superior.
Composer: Gestor de dependencias de PHP.
Base de Datos: MySQL (recomendado), PostgreSQL, SQLite, etc.
Node.js y npm: Necesario para compilar los assets de Laravel Telescope (aunque la API funcionará sin ellos, el dashboard de Telescope no se verá correctamente).
Guía de Instalación Paso a Paso
Sigue estos pasos para poner en marcha el proyecto:

Clonar el Repositorio:

Bash

git clone https://github.com/tu-usuario/laravel-mid-level-project-task-api.git
cd laravel-mid-level-project-task-api
(Asegúrate de reemplazar tu-usuario con tu usuario de GitHub si el proyecto está en un repositorio real).

Instalar Dependencias de Composer:

Bash

composer install
Configurar el Archivo de Entorno (.env):
Copia el archivo de ejemplo y genera la clave de la aplicación:

Bash

cp .env.example .env
php artisan key:generate
Abre el archivo .env y configura los detalles de tu base de datos:

Fragmento de código

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos # <--- ¡CAMBIA ESTO!
DB_USERNAME=tu_usuario_de_base_de_datos # <--- ¡CAMBIA ESTO!
DB_PASSWORD=tu_contraseña_de_base_de_datos # <--- ¡CAMBIA ESTO!
Ejecutar Migraciones de Base de Datos:
Esto creará todas las tablas necesarias, incluyendo las de projects, tasks, telescope_entries (para Telescope) y audits (para el sistema de auditoría).

Bash

php artisan migrate
Instalar y Compilar Assets de Node.js (para Telescope):

Bash

npm install
npm run dev # O `npm run build` para producción
Generar Documentación de Swagger:

Bash

php artisan l5-swagger:generate
Iniciar el Servidor de Desarrollo de Laravel:

Bash

php artisan serve
La API estará disponible en http://127.0.0.1:8000.

Cómo Acceder a la Documentación de Swagger
Una vez que la aplicación esté en funcionamiento, puedes ver la documentación interactiva de la API (Swagger UI) en:
http://127.0.0.1:8000/api/documentation

Aquí encontrarás todos los endpoints, sus parámetros esperados, respuestas y modelos de datos.

Cómo Ver Laravel Telescope
Laravel Telescope proporciona un panel de control elegante para monitorear las solicitudes, consultas a la base de datos, tareas en cola, etc. Accede a él en:
http://127.0.0.1:8000/telescope
