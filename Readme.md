1. Prepare Database, I am using mysqli for this crud. create a database with a name of ffuf_crud
- Import database which is located in ../ffuf/database/ffuf_crud.sql

2. Configure your application
- Download and change the folder name to ffuf and place it under the htdocs folder(../htdocs/ffuf)

3. Configure Database
- Open database.php by following this directory ../application/config/database.php

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',	//hostname
	'username' => 'root',		//db username
	'password' => '',			//db password
	'database' => 'ffuf_crud',	//db name
	'dbdriver' => 'mysqli',		//db driver


4. Configure base url
- Open config.php by following this directory ../application/config/config.php
$config['base_url'] = 'http://localhost/ffuf/';


5. Configure route
- Open routes.php by following this directory ../application/config/routes.php
$route['default_controller'] = 'home';


6. Last configure .htaccess
- Open your .htaccess under ffuf folder ../htdocs/ffuf

Check if this is the content of the file, copy and paste if not.

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /ffuf/index.php/$1 [L]
</IfModule>