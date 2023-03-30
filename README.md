# Proyecto # 1 UML

Proyecto Empleados para la Empresa Logistic, usando mysql cómo base de Datos y PHP 8, Bootstrap 5 para el diseño de la Página Web.

## Tech Stack

**Client:** PHP, Bootstrap 5, css3, html5

**Server:** Ubuntu Server
## comando para el nuevo usuario
adduser sammy (enter)
## comando para darle el rol de root
usermod -aG sudo sammy 

## activad el firewall
comando para activar el firewall --> ufw enable
comando para verificar si el firewall esta habilitado --> ufw status
** validar los puertos que esten habilitados en el firewall
ufw app list
** Habilitar una app en el firewall
ufw allow OpenSSH <-->estoy habilitando el acceso al nuevo usuario

## Habilitar acceso externo para el usuario recien creado

comando ssh sammy@your_server_ip (desde una nueva terminal)

## Ahora se procede a instalar LAMP (LINUX,APACHE, MYSQL, PHP) LEMP(LINUX,NGX, MYSQL, PHP)
### LAMP
1- sudo apt update (actializar repositorios)
2- sudo apt install apache2 (isntala apache2 en ubuntu)
3- sudo ufw app list
4- sudo ufw allow in "Apache"
# Tercer Paso Configuracion de Firewall
-comando que verifica que aplicaciones estan en firewall --> ufw app list (sudo)
    - OpenSSH
-comando OpenSSH --> ufw allow OpenSSH 
-comando para avilitar firewall --> ufw enable
-comando para validar estado del firewall --> ufw status

# Cuarto Paso LAMP (LINUX, APACHE, MYSQL, PHP) LEMP(LINUX, NGINX, MYSQL, PHP)
-Recuerde siempre actualizar sus respositorios (sudo apt update, upgrade)
-sudo apt install apache2
-sudo ufw app list
-sudo ufw allow in "Apache"
-sudo ufw status
-Comando para encontrar la IP Publica de su servidor
    -iproute2 (herramienta para obtener la direccion)
    -ip addr show ens3 | grep inet | awk '{print $2;}' | sed 's/\/.*$//'
# Quinto paso es instalar Mysql
-comando --> sudo apt install mysql-server


## primero hacer esto
-comando para darle accesos al usuario root 
-> sudo mysql
--> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Supassword';
--> exit


### Una vez instalado Mysql se debe correr un script presintalado anteriormente
--comando --> mysql_secure_installation

## sexto paso para instalar PHP
-comando --> sudo apt install php libapache2-mod-php php-mysql
-comando para validar que version de php tenermos --> php -v (8.x)


## SEPTIMO para crear un host virtual que funcion hacia nuestro sitio web
-comando para crear un directorio --> sudo mkdir /var/www/SuNombreProyecto
-comando para asignar al usuario --> sudo chown -R $samuel:$samuel /var/www/SuNombreProyecto

-comando para modificar el directorio que me permite crear mis virtual host
    --> sudo nano /etc/apache2/sites-available/SuNombreProyecto.conf    
    ** A este directorio en blanco le colocamos la siguiente instruccion
## configuracion virtual host
        <VirtualHost *:80>
            ServerName SuNombreProyecto
            ServerAlias www.SuNombreProyecto 
            ServerAdmin webmaster@localhost
            DocumentRoot /var/www/SuNombreProyecto
            ErrorLog ${APACHE_LOG_DIR}/error.log
            CustomLog ${APACHE_LOG_DIR}/access.log combined
        </VirtualHost>
    --comando -> CTRL + X, luego Y --> ENTER
## comanddo para configurar directorio de apache

-comando para primero deshabilitar el directorio default 
    -> sudo a2dissite 000-default
-comando para verificar que nuestro virtualhost no tenga errores
    -> sudo apache2ctl configtest
-comando para recargar apache2
    -> sudo systemctl reload apache2







## GIT

https://github.com/rortizs/Prrimera_App_Sanarate.git

## Used By

This project is used by the following companies:

- Ingeniero Richard Ortiz | UMG Guastatoya
