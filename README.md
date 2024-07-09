## Comentarios:
Usar el archivo env.example y configurarlo a su puerto o dominio local.

## Pasos:

1. Al momento de clonar creen una nuevar rama y partan de la rama dev.
2. Una vez clonado, muevete a tu rama y usa **composer install** para instalar todas las dependencias
3. Despues **npm install**
4. Crea tu base de datos de acuerdo al nombre que deses (configurar tu .env)
5. Genere una nueva llave **php artisan key:generate**
6. Ahora asegurate de eliminar el acceso directo storage de C:\xampp\htdocs\ecommerce\public\storage y volver a generarlo con **php artisan storage:link**
7. Ahora puedes hacer **php artisan migrate:fresh --seed**
