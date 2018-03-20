Ejemplo basico de uso de sockets con PHP

Cliente-Servidor

Para el desarrollo de este ejemplo se uso WAMP con la version de APACHE==> 2.4.27 y PHP==>5.6.31

================== Recomendaciones ======================
Es necesario verificar en el php.ini la extension php_sockets este habilitada. De lo contrario 
no funcionara el ejemplo

Para el uso del comando php es necesario añadir la ruta del php.exe a la variable de entorno  PATH de windows.

en mi caso C:\wamp64\bin\php\php5.6.31 

===============Instrucciones de ejecucion ==========================
para ejecutar el server 
basta con correr el archivo socket.php con este comando

php -f C:wamp64\www\sockets_exercises\server_date\socket.php

Ahora que el servidor esta corriendo
 y a la espera de peticiones, vamos a correr el cliente 
en otra consola con este comando

php C:wamp64\www\sockets_exercises\server_date\socket_test.php


IMPORTANTE: 
Si nos sale el error de que el server no permitio la conexion con el server 
es necesario deshabilitar el firewall

para eso corremos este comando

NetSh Advfirewall set allprofiles state off

una vez hayamos visto el ejemplo en funcionamiento es de vital importancia que volvamos a activarlo

NetSh Advfirewall set allprofiles state on


Si ya siguieron las recomendaciones y aun siguen teniendo problemas para levantar el server 
es necesario que verifiquen con este comando

php --ini

si por algun extraña razon hay algun otro archivo llamado php.ini, bine sea porque tienen otra aplicacion 
como wamp instalada

En este caso la eliminan, buscan posibles soluciones para que apunte a el php.ini configurado, o editan el php.ini hacia el que esta apuntando 



