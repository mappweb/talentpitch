## TalentPitch Test

### Preparar ambiente de despliegue local (Usando docker)

- Clonar receta de docker [docker-compose-laravel](https://github.com/mappweb/docker-compose-laravel/tree/feature/laravel-php-8.2).
- Ubicarse en la raiz del repositorio clonado.
- Construir la imagen de docker `docker-compose up --build`
- Ubicarse en la carpeta app y clonar el repositorio [talepitch](https://github.com/mappweb/talentpitch) `git clone https://github.com/mappweb/talentpitch.git`
- Ingresar al contenedor `docker exec -it php_app bash`
- Ejecutar el comando `composer install`
- Crear el archivito .env en base al archivo example.env
- Generar la clave de aplicación `php artisan key:generate`
- Ejecutar comando para montar servicio de la aplicación `docker exec -it php_app php artisan serve --host=0.0.0.0 --port=8000`

### Preparar ambiente de despliegue local (Sin docker)

- Instalar php8.2 + dependencias
- Instalar mysql5.7
- Instalar git
- Instalar composer
- Clonar el repositorio [talepitch](https://github.com/mappweb/talentpitch) `git clone https://github.com/mappweb/talentpitch.git`
- Ejecutar el comando `composer install`
- Crear el archivito .env en base al archivo example.env
- Generar la clave de aplicación `php artisan key:generate`
- Ejecutar comando para montar servicio de la aplicación `php artisan serve --host=0.0.0.0 --port=8000`

### Api

- Url base `http://0.0.0.0:8000`
- Documentación con ejemplos `./documents/Talentpitch.postman_collection.json`

### Modelo relacional

- `./documents/relational-model.png`
