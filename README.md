# Proyecto Final 2º Trimestre para el modulo de Desarrolo de Aplicaciones Web en Entorno Servidor
## Autor: Javier Martínez Garcia

# Descripción
Este proyecto consiste en la creación de una aplicación web que permite la gestion de una escuela de hosteleria.En la cual se pueden registrar usuarios, y crear, editar y eliminar cursos y ponentes.

# Instalación
Para poder instalar el proyecto, es necesario tener instalado en el equipo el servidor web Apache, el lenguaje de programación PHP y la base de datos MySQL.
Primeros creamos la base de datos, para ello ejecutamos el script que se encuentra en la carpeta "database" del proyecto.
Una vez creada la base de datos, copiamos el proyecto en la carpeta "htdocs" del servidor web Apache.
Para el correo de confirmación de registro, instalar Papercut SMTP Server, que es un servidor SMTP de prueba que se puede descargar desde GitHub. Con este servidor SMTP podremos ver los correos que se envian desde la aplicación. Y asi poder comprobar que el registro se ha realizado correctamente.


# Investigacion sobre el archivo procfile
El archivo Procfile es un archivo de texto plano que se utiliza para definir los procesos que se ejecutarán en una aplicación web en la plataforma de Heroku. Este archivo es utilizado por Heroku para iniciar el proceso de construcción de la aplicación y para configurar el entorno de ejecución.

En el caso de PHP, si la aplicación utiliza el servidor web integrado de PHP (como lo hace el proyecto que hemos estado desarrollando), el archivo Procfile se utiliza para indicar el comando que se debe ejecutar para iniciar el servidor web.

Por ejemplo, si queremos iniciar el servidor web integrado de PHP en la carpeta public de nuestro proyecto, el archivo Procfile tendría la siguiente línea:

web: vendor/bin/heroku-php-apache2 public/

Aquí, web es el nombre del proceso que se está definiendo, y vendor/bin/heroku-php-apache2 public/ es el comando que se debe ejecutar para iniciar el servidor web. public/ indica la carpeta raíz de nuestra aplicación.

En resumen, el archivo Procfile es necesario en las aplicaciones de Heroku para definir los procesos que se deben ejecutar, y en el caso de aplicaciones web basadas en PHP, se utiliza para definir el comando que se debe ejecutar para iniciar el servidor web integrado

### Enlace al repositorio de GitHub:
https://github.com/Clonico00/hosteleria/tree/master

### Enlace para descargar este proyecto:

https://github.com/Clonico00/hosteleria.git

### Enlace para descargar Papercut SMTP Server:
https://github.com/ChangemakerStudios/Papercut-SMTP/releases/tag/6.2.0.build.723