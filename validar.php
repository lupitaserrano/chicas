<?php


$usuario = $_POST['nombuser'];
$pass = $_POST['pass'];
$captcha = sha1($_POST['captcha']);
$cookie_captcha = $_COOKIE['captcha'];

$KeySecret = '6LeMi8IUAAAAAEooLHpr3TaLSUqHTw96ykdfQSl8';

/*
$captcha = sha1($_POST['captcha']);
$cookie_captcha = $_COOKIE['captcha'];
echo $_POST['nombuser'];
echo $_POST['pass'];
echo $_POST['captcha'];
echo $_COOKIE['captcha'];
exit();
*/



if ($captcha != $cookie_captcha) { 
		echo "El captcha es incorretco";
}else{


	$usuario = stripslashes($_POST["nombuser"]);
	$pass = stripslashes($_POST["pass"]);
	
 
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LeMi8IUAAAAAEooLHpr3TaLSUqHTw96ykdfQSl8',
		'response' => $recaptcha
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);

	
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success = json_decode($verify);
	if ($captcha_success->success) {
		// No eres un robot, continuamos con el envío del email
		// ...
		// ...
		$conexion = new mysqli('localhost','root','','usuarios');
		mysqli_set_charset($conexion,'utf8');

		$sql = "SELECT * from usuario where Nombre='" . $usuario . "'";

$resultado = $conexion->query($sql);

if($row = $resultado->fetch_array()){
	if($row['password'] ==  $pass ){
	
		session_start();
		$_SESSION['usuario'] = $usuario;
		header("Location: contenido.php");
	
	}else{

		header("Location: index.html");
		exit();
	}
}else{
	header("Location: index.html");
	exit();

}



	} else {
		// Eres un robot!
		echo "Valida el captcha";
	}




// if(empty($usuario) || empty($pass)){
// 	header("Location: index.html");
// 	exit();
// }



// if ($conexion->connect_errno) {
// 	echo "No hay conexion a la bd";
// }




?>
