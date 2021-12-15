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
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	// $url_site = "http://lfundation";
	$archivo = "registro.txt";
	$registro = false;
	$emails_list = [];
	$email = "";
	$valid_mail = false;

	function charge_emails(){
		global $archivo;
		global $emails_list;
		$saved_file = $archivo;
		$fop = fopen($saved_file, "r");
		while(!feof($fop)){
			$line = fgets($fop);
			// $emails_list[] = isset(explode(",", $line)[1]);
			$emails_list[] = explode(",", $line)[1];
		}
		fclose($fop);
		return $emails_list;
	}

	if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['course'])){
		// lectura de emails registrados
		$emails_list = charge_emails();

		// carga de variables y sanitizacion
		$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
		$surname = filter_var($_POST['surname'],FILTER_SANITIZE_STRING);
		$email = filter_var(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),FILTER_SANITIZE_STRING);
		$course = filter_var($_POST['course'],FILTER_SANITIZE_STRING);

		print("el puto email es: ".$email."\n");
		print_r(array_values($emails_list));

		if(!in_array($email,$emails_list)){
			$userdata = $name." ".$surname.", ".$email.", ".$course."\n";
			$fop = fopen($archivo,'a');
			fputs($fop,$userdata);
			fclose($fop);
			$post_reg_message = $name."</br>Registro completo!";
			$registro = true;
		} else {
			$post_reg_message = $name."</br>El email: ".$email."</br> ya está registrado.";
			$registro = false;
		}
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
						<tr><td>*Nombre:</td><td><input type="text" name="name" min="3" max="16" required autocomplete="off"></td></tr>
						<tr><td>*Apellido:</td><td><input type="text" name="surname" min="3" max="16" required autocomplete="off"></td></tr>
						<tr><td>*Email:</td><td><input type="email" name="email" min="16" max="32" required autocomplete="off"></td></tr>
						<tr><td>*Curso:</td><td><input type="text" name="course" min="3" max="32" required autocomplete="off"></td></tr>
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
						echo '<div id="child"><h3 class="align_c color_registro">'.$post_reg_message.'</h3></div>';
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
