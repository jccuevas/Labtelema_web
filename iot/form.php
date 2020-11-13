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
    $username = $_POST['user'];
    $password = $_POST['pass'];
	echo "<h1>Acceso por post</h1>";
		if(empty($_POST)) {
        echo "<p>No hay variables por POST</p>"; 
	}
    else {
        echo "<p>";
        print_r($_POST); 
	    echo "</p>";
    }
	
}else if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = $_GET['user'];
    $password = $_GET['pass'];
	echo "<h1>Acceso por get</h1>";
	if(empty($_GET)) {
        echo "<p>No hay variables por GET</p>"; 
	}
    else {
        echo "<p>";
        print_r($_GET); 
	    echo "</p>";
    }
}


?>
</body>
</html>