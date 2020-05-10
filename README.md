# Sitio web - CITA 
Estos archivos corresponden al sitio web del Centro de Investigación Tecnológico de la Armada de Chile.

## Instalación 
Para instalar este sitio en su hosting o servidor local, primero debe descargar/clonar este proyecto en su computador y guardarlo en la carpeta que estime conveniente. 

## Paso 1: Abrir archivos keys.php y config.php
Luego de haber descargado/clonado el proyecto en su computador, proceda a abrir la carpeta y  haga lo siguiente:
* 1.1: Dirigase a la carpeta "datos-acceso"
* 1.2: Abra los archivos: "keys.php" y "config.php"

## Paso 2: Modificar archivos keys.php y config.php
Estos archivos que acaba de abrir corresponden a los datos de acceso a su hosting, base de datos y su servidor SMTP, por lo que, deberá modificarlos y remplazar donde se indique con sus datos correspondientes a su hosting. Haga los siguientes pasos: 
#### 2.1 En el archivo keys.php, modifique las siguientes lineas de codigo:
Linea 12: En esta línea ud debe reemplazar con la url de la database de su servidor
```php
define('DB_SERVER', 'inserte_aqui_url_servidor_database');
```
Linea 13: Acá, reemplazar con el usuario de la database de su servidor
```php
define('DB_SERVER_USERNAME', 'inserte_aqui_usuario_servidor_database');
```
Linea 14: Acá, reemplazar con el contraseña de la database de su servidor
```php
define('DB_SERVER_PASSWORD', 'inserte_aqui_contraseña_servidor_database');
```
Linea 15: Acá, reemplazar con el nombre de la database de su servidor
```php
define('DB_DATABASE', 'inserte_aqui_nombre_servidor_database');
```
Linea 21: Acá, reemplazar con smtp de su servdidor 
```php
define('SMTP_SERVER', 'inserte_aqui_smtp_servidor');
```
Linea 22: Acá, reemplazar con el username del smtp de su servdidor 
```php
define('SMTP_USERNAME', 'inserte_aqui_username_smtp_servidor');
```
Linea 23: Acá, reemplazar con el password del smtp de su servdidor 
```php
define('SMTP_PASSWORD', 'inserte_aqui_password_smtp_servidor');
```
#### 2.2 En el archivo config.php, haga lo mismo que el paso anterior y modifique las siguientes lineas de codigo:
Linea 8: En esta línea ud debe reemplazar con la url de la database de su servidor
```php
define('DB_SERVER', 'inserte_aqui_url_servidor_database');
```
Linea 9: Acá, reemplazar con el usuario de la database de su servidor
```php
define('DB_SERVER_USERNAME', 'inserte_aqui_usuario_servidor_database');
```
Linea 10: Acá, reemplazar con el contraseña de la database de su servidor
```php
define('DB_SERVER_PASSWORD', 'inserte_aqui_contraseña_servidor_database');
```
Linea 11: Acá, reemplazar con el nombre de la database de su servidor
```php
define('DB_DATABASE', 'inserte_aqui_nombre_servidor_database');
```
## Paso 3: Importar base de datos
El archivo bd_cita.sql es la base de datos del sitio web, para que funcione correctamente el sitio es fundamental que esta base de datos esté instalada. Para ello, deben importarla, en caso de que estén ocupado un servidor local, ingresar a localhost/phpmyadmin e importarla. 



