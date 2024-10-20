> [!IMPORTANT]
>
>## Comandos para clonar plataforma de Control de asistencia a eventos ## 
>### Para clonar en produccion o pruebas se deben tener en cuenta los siguientes comandos: ###
---
Comandos necesarios
---

> [!NOTE]
> - [Clonar el repositorio](#).
>   ```bash
>   git clone https://github.com/janluyleonardo/ControlAsistenciaEventos.git
>- [Intalar dependencias del proyecto composer](#).
>   ```bash
>   composer install
>- [Intalar dependencias del proyecto npm](#).
>   ```bash
>   npm install
>- [crear archivo .env a partir del archivo de ejemplo](#).
>   ```bash
>   cp .env.example .env
>- [Generar llave de aplicacion para su correcto funcionamiento](#).
>   ```bash
>   php artisan key:generate
>- [Asignar credenciales de conexion a la DB, usuario y contraseña, en archivo .env ](#).
>   ```bash
>   DB_DATABASE=Database name  
>   DB_USERNAME=user database name  
>   DB_PASSWORD=password database user
>- [Ejecutar migraciones de la base de datos para que se creen las tabla del proyecto ](#).
>   ```bash
>   php artisan migrate
>- [Ejecutar el proyecto en ambiente local o de pruebas](#).
>   ```bash
>   php artisan serve
---
Comandos opcionales
---
> [!WARNING]
> 
>- [Generar enlace simbolico al directorio storage para poder manipular imagenes, archivos desde usuario logueado](#).
>   ```bash
>   php artisan storage:link
>- [Crear carpeta para las fuentes que maneja la plataforma, si se quieren personalizar (ruta: public/storage/fonts)](#).
>   ```bash
>   cd storage
>   mkdir fonts
>- [Ejecutar este comando si se cuenta con datos de prueba iniciales en la base de datos](#).
>   ```bash
>   php artisan migrate --seed

> [!TIP]
> ## Propietarios de la plataforma Control de asistencia a eventos ##
> 
> Janluy Leonardo Moreno Coronado

> [!TIP]
> ## Documentación del proyecto ##
>
> El proyecto será realizado y escrito con el framework laravel en su version 8, esta es su documentación: [Laravel documentation](https://laravel.com/docs/).

> [!TIP]
> ## Licencia ##
>
> La plataforma cuenta con la licencia de código abierto [MIT license](https://opensource.org/licenses/MIT).
