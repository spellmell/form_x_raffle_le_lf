<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width", user-scalable="no", initial-scale="1.0", maximum-scale="1.0", minimum-scale="1.0">
  <title>Linux Español - Registro para sorteo de Linux Fundation</title>
  <link rel="stylesheet" type="text/css" title="Cool stylesheet" href="css/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
	<?php
	// debug: mostrar errores
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	$archivo = "registro.cvs";
	$registro = false;
	$email = "";
	$post_reg_message = "";

	function check_mail($name,$surname,$email,$course){
		global $archivo;
		global $registro;
		global $email;
		global $post_reg_message;
		// search email in the .txt
		$search = $email;
		$lines = file($archivo);
		$found = false;
		foreach($lines as $line){
			if(strpos($line, $search) !== false){
				$found = true;
			}
		}
		// if not found the email, register a new line in the .txt
		if(!$found){
			$userdata = $name." ".$surname.",".$email.",".$course."\n";
			$fop = fopen($archivo,'a');
			fputs($fop,$userdata);
			fclose($fop);
			$post_reg_message = $name."</br>Registro completo!";
			$registro = true;
			return $registro;
		} else {
			$post_reg_message = $name."</br>El email: ".$email."</br> ya está registrado.";
			$registro = false;
			return $registro;
		}
	}

	// si el formulario fue enviado
	if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['course'])){
		// carga de variables y sanitizacion
		$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
		$surname = filter_var($_POST['surname'],FILTER_SANITIZE_STRING);
		$email = filter_var(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),FILTER_SANITIZE_STRING);
		$course = filter_var($_POST['course'],FILTER_SANITIZE_STRING);
		// check mail y registro
		$registro = check_mail($name,$surname,$email,$course);
	}

	// cuenta regresiva
	function cronometro(){
		$today = time();
		$event = mktime(0,0,0,12,31,2021);
		$countdown = round(($event - $today)/86400);
		echo "faltan $countdown días para el sorteo";
	}
	?>
	<div id="master_conteiner">
		<div id="child_of_master"></div>
		<div id="child_of_master">
			<div id="conteiner">
				<div id="child"><h2 class="align_c">Linux Español</h2></div>
				<div id="child"><h3 class="align_c">Registro para el sorteo de Linux Fundation</h3></div>
				<?php if($registro == false){
				echo '<div id="child">
					<form name="registrar" method="post">
					<label for="registrar"></label>
					<table id="formulario">
						<tr><td>*Nombre:</td><td><input type="text" name="name" required autocomplete="off"></td></tr>
						<tr><td>*Apellido:</td><td><input type="text" name="surname" required autocomplete="off"></td></tr>
						<tr><td>*Email:</td><td><input type="email" name="email" required autocomplete="off"></td></tr>
						<tr><td>*Curso:</td><td><input type="text" name="course" required autocomplete="off"></td></tr>
						<tr>
							<td></td>
							<td>
								<div id="conteiner_buttons">
									<div id="child_button">
										<button type="reset" value="delete" class="align_l">Borrar</button>
									</div>
									<div id="child_button">
										<button type="submit" value="submit">Registrate</button>
									</div>
								</div>
							</td>
						</tr>
					</table>
					</form>
				</div>';
				}
				?>
				<?php
					if(($registro || !$registro) && !empty($post_reg_message)){
						if($registro){
							$color = "color_registro";
						} else {
							$color = "color_alert";
						}
						echo '<div id="child"><h3 class="align_c '.$color.'">'.$post_reg_message.'</h3></div>';
					} elseif(!$registro && empty($post_reg_message)){
						echo '<div id="child"><h5 class="align_c">Todos los campos son requeridos *</h5></div>';
					}
				?>
				<div id="child">
					<h3 class="align_c"><?php cronometro(); ?></h3>
				</div>
				<div id="child">
					<div id="social_icons_conteiner">
						<div id="social_icons_child" class="align_c">
							<a href="https://www.facebook.com/groups/linuxesp/" target="_blank"><img src="img/social/06-facebook.svg" width="48px" height="48px"></a>
						</div>
					</div>
				</div>
				</div>
		</div>
	</div>
</body>
</html>
