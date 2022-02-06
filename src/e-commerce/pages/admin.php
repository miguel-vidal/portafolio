<?php

	session_start();
	if(isset($_SESSION["idUser"]) && $_SESSION["rol"] == "1"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<?php 
		include("partials/cabeceras.html");
	?>
</head>
<body>

<?php
	include("partials/menu.html");
?>

<script src="../js/menuHamburger.js"></script>
<?php
	include("partials/footer.html");


}else{

		include("partials/404.html");
	}
?>