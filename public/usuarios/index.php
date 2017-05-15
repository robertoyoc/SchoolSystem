<?php
	session_start();
	if(is_null($_SESSION['perfil']))
		header("Location: ../../");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Control de Asistencia</title>
	<link rel="stylesheet" type="text/css" href="../css/usuarios.css">
	<link rel="shorcout icon" href="../img/notebook.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
</head>

<body>
<header>
		<ul id="menu">
			<li class="item"><a href="../admin">Inicio</a></li>
			<li class="item"><a href="../alumnos">Alumnos</a></li>
			<li class="item"><a href="../cursos">Cursos</a></li>
			<li class="item"><a href="../usuarios">Usuarios</a></li>
			<li class="item"><a href="#Nosotros">Nosotros</a></li>
			<li class="item"><a href="#Ayuda">Ayuda</a></li>
			<li class="item"><a href="../../php/logout.php">Salir</a></li>

		</ul>
</header>
<section class="container">
	<section class="initial-data">
		<h3>Registrar nuevo administrador</h3>
		<form id="adminregister">
			<p>Usuario: </p> <input type="text" id="r_usuario" name="usuario" required><br>
  			<p>Contraseña: </p>  <input type="password" id="r_contrasena" name="contrasena" required><br><br>
  			<input type="submit" value="Registrar">
  		</form>
	</section>
	<section class="initial-data">
		<h3>Actualizar información del usuario </h3>
		<form id="adminsearch">
  			<p>Usuario:</p>  <input name="usuario" id="usuariofield" required="">
  			<input type="submit" value="Buscar">
  		</form>
  		<br>
  		<form id="adminmodify">
  			<p>Usuario: </p> <input type="text" id="u_usuario" name="usuario" readonly=""><br>
  			<p>Nueva contraseña: </p> <input type="password" id="u_contrasena" name="contrasena"><br><br>
  			<input type="button" id="admindelete" value="Borrar">
  			<input type="button" id="adminupdate" value="Actualizar">
  		</form>
	</section>

</section>
<section class="container">
	<section class="initial-data">
		<h3>Registrar nuevo usuario</h3>
		<form>
			<p>Nombre (s): </p> <input type="text" id="f_name" name="f_name" required><br>
  			<p>Apellido Paterno:</p>  <input type="text" id="ap_pat" name="ap_pat" required><br>
  			<p>Apellido Materno:</p>  <input type="text" id="ap_mat" name="ap_mat" required><br>
  			<p>Matrícula:</p>  <input type="text" id="matricula" name="id" required=""><br><br>
  			<input type="submit" value="Registrar">
  		</form>
	</section>
	<section id="search">
		<h3>Buscar información del alumno </h3>
		<form onsubmit=" return search()">
  			<p>Matrícula:</p>  <input type="text" id="findmatricula" name="id" required="">
  			<input type="submit" value="Buscar">
  		</form>
  		<br>
  		<form>
  			<p>Nombre (s): </p> <input type="text" id="rf_name" name="rf_name" readonly><br>
  			<p>Apellido Paterno:</p>  <input type="text" id="rap_pat" name="rap_pat" readonly><br>
  			<p>Apellido Materno:</p>  <input type="text" id="rap_mat" name="rap_mat" readonly><br>
  			<p>Matrícula:</p>  <input type="text" id="rmatricula" name="rmatricula" readonly><br><br>
  		</form>
	</section>

</section>
	<div id="message">

	</div>
	

</body>

<script type="text/javascript">

	var message = $("#message");

	function showMessage(text, time){
		message.text(text);
		message.css("visibility", "visible");
		setTimeout(function(){message.css("visibility", "hidden");  }, time);
	}
	
	$("#adminregister").on("submit", function (e){
		e.preventDefault();
		var JSONdata = $("#adminregister").serializeArray();
			
		$.ajax({
			url: "../../php/adminregister.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 3000);
				$("#r_usuario").val('');
				$("#r_contrasena").val('');
			}
		
		})
			
	});
	$("#adminsearch").on("submit", function (e){
		e.preventDefault();
		var JSONdata = $("#adminsearch").serializeArray();

		$("#usuariofield").val("");

		$.ajax({
			url: "../../php/adminsearch.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				if(data.status=="Encontrado"){
					$("#u_usuario").val(data.usuario);
					showMessage(data.status, 2000);
				}
				else{
					showMessage(data.status, 3000);
				}
				
			}	
		
		})
			
	});
	$("#admindelete").on("click", function(){
		var JSONdata = $("#adminmodify").serializeArray();
			
		$.ajax({
			url: "../../php/admindelete.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 3000);
				$("#u_usuario").val('');
				$("#u_contrasena").val('');
			}
		
		})

	});
	$("#adminupdate").on("click", function(){
		var JSONdata = $("#adminmodify").serializeArray();
			
		$.ajax({
			url: "../../php/adminupdate.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 3000);
				$("#u_usuario").val('');
				$("#u_contrasena").val('');
			}
		
		})

	});



</script>
</html>