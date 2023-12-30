//SPANISH

1) Ejecutar Composer Install

2) Configuar .env como corresponde.

3) Ejecutar php bin/console doctrine:database:create o en caso de que falle crear la base de datos a mano con el nombre de aaxis_db.

4) Correr las migraciones utilizando php bin/console doctrine:migrations:migrate.

5) Ejecutar php bin/console doctrine:fixtures:load para generar el usuario admin.

6) Instalar OpenSSL para la correcta generacion de JWT-KEYS.

7) Ejecutar php bin/console lexik:jwt:generate-keypair para generar las claves.

8) En la carpeta Postman van a encontrar un archivo Json el cual deberan importar en su postman para consumir y probar los endpoints creados.

9) En la collection de Postman van a ver los endpoints generados para el uso del sistema. Incluyendo tambien el endpoint correspondiente para obtener el token.

//ENGLISH

1)Run Composer Install.

2) Configure .env as appropriate.

3) Execute php bin/console doctrine:database:create, or in case of failure, manually create the database with the name "aaxis_db."

4) Run migrations using php bin/console doctrine:migrations:migrate.

5) Execute php bin/console doctrine:fixtures:load to generate the admin user.

6) Install OpenSSL for the proper generation of JWT-KEYS.

7) Execute php bin/console lexik:jwt:generate-keypair to generate the keys.

8) In the Postman folder, you will find a JSON file that you should import into your Postman to consume and test the created endpoints.

9) In the Postman collection, you will find the generated endpoints for system usage, including the corresponding endpoint to obtain the token.