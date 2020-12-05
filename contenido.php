<!DOCTYPE html>
<html lang="es">
<body background="images\hola.png">
	<center>

<form method="POST" action="index.html">
	<center><button type="submit">Cerrar Sesion</button></center>

</form>
</html>
</body>
<?php

session_start();

echo "H O L A " . $_SESSION['usuario'];

?>


