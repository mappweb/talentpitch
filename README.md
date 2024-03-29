## TalentPitch Test

### Preparar ambiente de despliegue local (Usando docker)

- Clonar receta de docker [docker-compose-laravel](https://github.com/mappweb/docker-compose-laravel/tree/feature/laravel-php-8.2).
- Ubicarse en la raiz del repositorio clonado.
- Construir la imagen de docker `docker-compose up --build`
- Ubicarse en la carpeta app y clonar el repositorio [talepitch](https://github.com/mappweb/talentpitch) `git clone https://github.com/mappweb/talentpitch.git`
- Ingresar al contenedor `docker exec -it db_mysql bash`
- Ejecutar comando `GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '12345678';` y después `FLUSH PRIVILEGES;`. Cerrar terminal.
- Ingresar al contenedor `docker exec -it php_app bash`
- Ejecutar el comando `composer install`
- Crear el archivito .env en base al archivo example.env
- Generar la clave de aplicación `php artisan key:generate`
- Correr las migraciones `php artisan migrate`
- Ejecutar comando para montar servicio de la aplicación `docker exec -it php_app php artisan serve --host=0.0.0.0 --port=8000`

### Preparar ambiente de despliegue local (Sin docker)

- Instalar php8.2 + dependencias
- Instalar mysql5.7 (Crear base de datos talentpitch, y setear los datos de acceso en el archivo DB_* .env)
- Instalar git
- Instalar composer
- Clonar el repositorio [talepitch](https://github.com/mappweb/talentpitch) `git clone https://github.com/mappweb/talentpitch.git`
- Ejecutar el comando `composer install`
- Crear el archivito .env en base al archivo example.env
- Generar la clave de aplicación `php artisan key:generate`
- Correr las migraciones `php artisan migrate`
- Ejecutar comando para montar servicio de la aplicación `php artisan serve --host=0.0.0.0 --port=8000`

### Interactuar con la aplicación

- Crear un usuario `/api/v1/register`
- Login para obtener el token `/api/v1/login`
- Configurar token de autorización de tipo Bearer para usar los endpoints de la Api.

### Api

- Url base `http://0.0.0.0:8000`
- Documentación con ejemplos `./documents/Talentpitch.postman_collection.json`

### Modelo relacional

- `./documents/relational-model.png`

### ChatGPT Mock Generate

Agregar [API KEY](https://platform.openai.com/api-keys) a la variable de  configuración contenida en el archivo .env:
OPENAI_API_KEY=

