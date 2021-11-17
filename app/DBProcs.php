<?php
	try {
		// Se capturan las opciones por Post
		$opcion = $_POST["opcion"];

		// Se establece la conexion con la BBDD
		$params = parse_ini_file('database.ini');
        if ($params === false) {
            throw new \Exception("Error reading database configuration file");
        }

        // connect to the postgresql database
        $conStr = sprintf("mysql:host=%s;dbname=%s", 
                $params['host'],  
                $params['database']);

		// connect to the postgresql database 
		$connec = new \PDO($conStr, $params['user'], $params['password']);
		$connec->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		$datos = [];
		switch ($opcion) {
			case 'listarpersonal':
				// Se crea el query para obtener el total general
				$sql = "SELECT id, cedula, nombre, empresa,
							DATE_FORMAT(fingreso,'%d-%m-%Y') AS fingreso,
							DATE_FORMAT(fegreso,'%d-%m-%Y') AS fegreso, observacion
						FROM personal
						ORDER BY MID(cedula, '2')";

				// Se obtienen los datos de la BBDD
				$sql = $connec->query($sql);

				// Se prepara el array para almacenar los datos obtenidos
				$datos= [];
				while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$datos[] = array(
						'cedula'      => $row['cedula'],
						'nombre'      => $row['nombre'],
						'empresa'     => $row['empresa'],
						'fingreso'    => $row['fingreso'],
						'fegreso'     => $row['fegreso'],
						'observacion' => $row['observacion'],
						'id'          => $row['id']
					);
				}

				// Se retornan los datos obtenidos
				echo json_encode(array('data' =>  $datos ));
				break;

			case 'guardar_personal':
				// tipo de accion a realizar en la BBDD 1->nuevo | 2->editar | 3->eliminar
				$tipo_accion = $_POST["tipo_accion"];
				// Se genera el query de acuerdo a la acción
				switch ($tipo_accion) {
					case '1':  // nuevo
						$sql = "INSERT INTO ";
						$sql.= "personal(cedula, nombre, empresa, fingreso, ";
						if($_POST['continua']==0) {
							$sql.= 'fegreso, ';
						}
						$sql.= "observacion, creado_por, creado_el) ";
						$sql.= "VALUES ('";
						if($_POST['letra']==1) {
							$sql.= 'V';
						} else {
							$sql.= 'E';
						}
						$sql.= $_POST['cedula'] . "', '";
						$sql.= $_POST['nombreapellido'] . "', '";
						$sql.= $_POST['nombreempresa'] . "', '";
						$sql.= date("Y-m-d",strtotime($_POST['fingreso'])) . "', '";
						$sql.= ($_POST['continua']==0) ? date("Y-m-d",strtotime($_POST['fegreso'])). "', '" : '';
						$sql.= $_POST['observaciones'] . "', '";
						$sql.= "cramirez', '";
						$sql.= date("Y-m-d") . "') "; 
						break;

					case '2':  // editar
						$sql = "UPDATE personal SET cedula = '";
						if($_POST['letra']==1) {
							$sql.= 'V';
						} else {
							$sql.= 'E';
						}
						$sql.= $_POST['cedula'] . "', nombre = '";
						$sql.= $_POST['nombreapellido'] . "', empresa = '";
						$sql.= $_POST['nombreempresa'] . "', fingreso = '";
						$sql.= date("Y-m-d",strtotime($_POST['fingreso'])) . "', 	";
						if($_POST['continua']==0) {
							$sql.= "fegreso = '";
							$sql.= date("Y-m-d",strtotime($_POST['fegreso'])). "', ";
						} else {
							$sql.= "fegreso = null, ";
						}
						$sql.= "observacion = '" . $_POST['observaciones'] . "', ";
						$sql.= "modificado_por = 'cramirez', modificado_el = '" . date("Y-m-d") . "' ";
						$sql.= "WHERE  id = " . $_POST['id'];
						break;

					case '3':  // eliminar
						# code...
						break;
				}
				$sql = $connec->query($sql);
				break;

			default:
				# code...
				break;
		}

		// Se cierra la conexion con la BBDD
		$connec = null;

	} catch (PDOException $e) {
		echo "Error : " . $e->getMessage();
		die();
	}
?>