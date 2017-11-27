# geval-api - `API del generador de evaluaciones`

 Para ver las especificaciones de la API:  
 - Ir a http://editor.swagger.io/
 - En otra pestaña ir a https://github.com/GRUPOANAYA/geval-api/blob/master/assets/swagger.yaml
 - Clickar en raw, copiar la url y pegarla en File / Import Url del editor.swagger.io

## Requisitos

- Apache >= 2
- PHP >= 5.6
- Mysql
- phpmyadmin
- Ubuntu o disttribución basada en Debian
- [Composer][3]

## Instalación
En la terminal, emplea los siguientes comandos, modificando la versión y el dominio:  

```
cd /var/www/html/
git clone https://github.com/GRUPOANAYA/geval-api
composer install

#comprobar que existen los directorios definidos en src/config.php
```  

## Depuración

En general, si se pone ?debug en cualquier script php se activará el modo DEBUG. Se puede configurar
su valor por defecto en src/config.php.
Para ejecutar los tests se requiere [phpunit][2].

## Depuración de POST
Para depurar cualquier solicitud via post, emplear curl, o [POSTMAN][1] p.e. para depurar la generación de words:

```
curl --data "contents=hola&materia=Depuraci%C3%B3n+de+tpl&opcion=Opci%C3%B3n+A&nivel_curso=Primaria+1&tipo=Enunc&codigo=11" --request POST --header "Content-Type:application/x-www-form-urlencoded" http://localhost/a-geval/v1/src/lib/saveas/saveas.php
```

[1]: https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop
[2]: https://phpunit.de/
[3]: https://getcomposer.org/
