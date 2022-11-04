<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ejemplo de formulario</title>
</head>

<body>
<?php  
$username = "";
$password = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo "<h1>Acceso por post</h1>";
		if(empty($_POST)) {
        echo "<p>No hay variables por POST</p>"; 
	}
    else {
        $valor = "";
            $clave = "";
			?>
            <ul>
            <?php
            foreach ($_POST as $clave => $valor) {
                echo "<li><strong>Parámetro:</strong><code>" . htmlspecialchars($clave) . "</code><br><strong>valor=</strong><var>" . htmlspecialchars($valor) . "</var></li>";
            }
			?>
            </ul>
            <?php
    }
	
}else if($_SERVER['REQUEST_METHOD'] == 'GET') {

	echo "<h1>Acceso por get</h1>";
	if(empty($_GET)) {
        echo "<p>No hay variables por GET</p>"; 
	}
    else {
        $valor = "";
            $clave = "";
           ?>
            <ul>
            <?php
            foreach ($_GET as $clave => $valor) {
                echo "<li><strong>Parámetro:</strong><code>" . htmlspecialchars($clave) . "</code><br><strong>valor=</strong><var>" . $valor . "</var></li>";
            }
			?>
            </ul>
            <?php
    }
}


?>
</body>
</html>