# CursoLaravelVueJS
Webapps de atrás para adelante - EIP 2018
#### Configurar Trabajo Final

Dentro de "Trabajo Final"
```shell
$ composer install
$ npm install
```
#### Crear la base de datos
Ejecutar el comando:
```shell
$ cp .env.example .env
```
Donde debemos configurar la base de la siguiente forma:
```shell
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=EIP
DB_USERNAME=admin
DB_PASSWORD=admin
```

Instalar las migraciones y ejecutarlas
```shell
$ php artisan migrate install
$ php artisan migrate
```
Ejecutar los seeder con los datos de prueba
```shell
$ php artisan db:seed
```
Por ultimo se debe levantar el proyecto:
```shell
$ php artisan serve
$ npm run dev #permite realizar cambios en la vista
```
