<?php
	require('conector.php');
	$con = new conectorBD();
 
	$response['conexion'] = $con->initConexion($con->database);
	if ($response['conexion'] == 'OK'){
		$conexion = $con->getConexion();
		$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha_nacimiento) VALUES (?,?,?,?)');
		$insert->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);

		$d_password = '1234';
		$email = 'ana.otilia@mail.com';
		$nombre = 'Ana Avila';
		$password = password_hash($d_password, PASSWORD_DEFAULT);
		$fecha_nacimiento = '1978-05-12';

		$insert->execute();

		$email = 'fredy.jhon@mail.com';
		$nombre = 'Fredy Avila';
		$password = password_hash($d_password, PASSWORD_DEFAULT);
		$fecha_nacimiento = '2005-02-03';

		$insert->execute();

		$email = 'usuario@mail.com';
		$nombre = 'usuario';
		$password = password_hash($d_password, PASSWORD_DEFAULT);
		$fecha_nacimiento = '1977-10-03';

		$insert->execute();
		$response['resultado'] = "1";
		$response['msg']= 'Información de inicio:';
		$getUsers = $con->consultar(['usuarios'],['*'],$condicion = "");
		while ($fila= $getUsers->fetch_assoc()) {
			$response['msg'].=$fila['email'];
		}
		$response['msg'].= 'Password: '.$d_password;
		}else{
			$response['resultado'] == "0";
			$response['msg'] = 'No se pudo conectar a la Base de Datos';
		}

		echo json_encode($response);

 ?>
