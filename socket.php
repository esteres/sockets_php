<?php
// dejamos en cero para que la conexion acepte la conexiones a ese y esta nunca se cierre
set_time_limit(0);
 
// la ip del servidor en la cual se va a crear el socket
$ip = '127.0.0.1';
// el puerto por el cual escuchara peticiones
$puerto = '7002';
 
/* CREANDO EL SOCKET 
AF_INET sirve para especifcar el protocolo en que se basara la conexion (AF_INET - AF_INET6 - AF_UNIX)
SOCK_STREAM indica como se enviaran y recibiran los bytes en la conexion
*/
$socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
// vinculamos el puerto a la IP
socket_bind($socket, $ip, $puerto) or die ('No se puede vincular el puerto a la IP');
// en caso de error lo mostramos para saber que pasa
echo socket_strerror(socket_last_error());
// hacemos que socket escuche peticiones
socket_listen($socket);
 
$i=0;
while(1){
    // aceptamos la conexion que nos entre
    $cliente[++$i] = socket_accept($socket);
    // leemos la informacion que nos envian
    $input = socket_read($cliente[$i], 1024);
    // quitamos espacios y saltos de linea de lo que se lee
    $identificacion = preg_replace("/\s/", "", $input);
    // escribimos lo que recibimos
    echo "Indetificacion recibida: $identificacion\n\r";
    
	#extraemos la informacion del archivo 
	$file = file(__dir__."\date_by_user.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	
	//Por default seteamos result con el mensaje de error
	// si no existe pues le decimos que lo que
	// busco no esta dentro del contenido
	$result = "No se encontro ninguna fecha asociada con la identificacion recibida";
		
	//buscamos en cada linea del archivo la identificacion recibida
	foreach($file as $key => $line){
		#si la identificacion esta en esta linea
		if(strpos($line, intval($identificacion)) != false){
			#entonces obtenemos la fecha y salimos
			$result = "La fecha asociada con el usuario ingresado es: ".explode(",", $line)[1]; #obtenemos la fecha del usuario
			break;
		}
	}

    // escribimos los resultados que encontramos dentro del
    // array en el socket para que el cliente los lea
    socket_write($cliente[$i], $result . "\n\r", 1024);
    // cerramos la conexion de ese cliente
    socket_close($cliente[$i]);
}
// cerramos la conexion global
socket_close($socket);
?>

