<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width", user-scalable="no", initial-scale="1.0", maximum-scale="1.0", minimum-scale="1.0">
  <title>Linux en español - Registro para sorteo de Linux Fundation</title>
  <link rel="stylesheet" type="text/css" title="Cool stylesheet" href="css/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
<?php
// registro de datos
$registro = False;
if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['course'])){
	$userdata = filter_var($_POST['name']." ".$_POST['surname'].", ".$_POST['email'].", ".$_POST['course'],FILTER_SANITIZE_STRING)."\n";
	$archivo_de_datos = fopen('registro_de_participantes.txt','a');
	fputs($archivo_de_datos,$userdata);
	fclose($archivo_de_datos);
	$name = $_POST['name'];
	$post_reg_message = "Registro completo!";
	$registro = True;
	// unset($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['course']);
} else {
	$post_reg_message = "Registro Incompleto. Falta Información.";
}
// cuenta regresiva
function cronometro(){
	$today = time();
	$event = mktime(0,0,0,12,31,2021);
	$countdown = round(($event - $today)/86400);
	echo "faltan $countdown días para el sorteo";
}
?>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    let formulario = document.getElementById('registrar');
    formulario.addEventListener('submit', function() {
      formulario.reset();
    });
  });
</script>
	<div id="master_conteiner">
		<div id="child_of_master"></div>
		<div id="child_of_master">
			<div id="conteiner">
				<div id="child">
					<div id="social_icons_conteiner">
						<div id="social_icons_child">
							<a href="https://www.facebook.com/groups/linuxesp/" target="_blank"><img src="img/social/06-facebook.svg"></a>
						</div>
					</div>
				</div>
				<div id="child"><h2 class="align_c">Linux Español</h2></div>
				<div id="child"><h3 class="align_c">Registro para el sorteo de Linux Fundation</h3></div>
				<?php if($registro == False){
				echo '<div id="child">
					<form name="registrar" method="post">
					<label for="registrar"></label>
					<table id="formulario">
						<tr><td>*Nombre:</td><td><input type="text" name="name" required></td></tr>
						<tr><td>*Apellido:</td><td><input type="text" name="surname" required></td></tr>
						<tr><td>*Email:</td><td><input type="email" name="email" required></td></tr>
						<tr><td>*Curso:</td><td><input type="text" name="course" required></td></tr>
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
					if($registro && !empty($post_reg_message)){
						echo '<div id="child"><h2 class="align_c color_registro">'.$name."<br/>".$post_reg_message.'</h2></div>';
					}
				?>
				<?php
				if($registro == False){
					echo '<div id="child"><h5 class="align_c">Todos los campos son requeridos *</h5></div>';
				}
				?>
				<div id="child">
					<h3 class="align_c"><?php cronometro(); ?></h3>
				</div>
			<div id="child"><h4 class="align_c">contacto@contacto.com</h4></div>
			</div>
		</div>
		<div id="child_of_master"></div>
	</div>
</body>
</html>