<?php
while(1){
    // mostramos un mensaje de bienvenida y una breve explicacion
    echo "Por favor ingrese un ticket, 'q' para salir: ";
    
    // eliminamos espacion en blanco del principio y fin de la cadena
    // y obtenemos los que se escribio
    $input = trim(fgets(STDIN));
    // si el usuario presiono Q pues lo sacamos de la aplicacion
    if ($input == 'q'){exit;}
    // si escribio una indentificacion mostramos lo que sera enviado
    echo "n\r\n\rIdentificacion enviada al server = $input ";
    
    // creo el socket
    // SOL_TCP el tipo de protocolo que se utilizara para la transmision (SOL_TCP - SOL_UDP)
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    
    // La comparacion para verificar si el socket se creo correctamente
    // debe ser con triple =
    if($socket === FALSE){
        echo 'n\r\n\rCreacion del socket fallida.';
    }else{
        // nos conectamos al socket servidor
        $resultado = socket_connect($socket, '127.0.0.1', '7002');
        if($resultado === FALSE){
            echo 'n\r\n\rConexion al socket fallida.'; 
        }else{
            // ahora escribimos en el socket para que el servidor
            // lea lo que nosotros le enviamos
            socket_write($socket, $input, strlen($input));
            // leemos el resultado que el socket nos envio
            $result = socket_read($socket, 1024);
            // imprimimos el resultado que leimos
            echo "\n\r\n\r$result\n\r\n\r";
        }
    }
}
?>