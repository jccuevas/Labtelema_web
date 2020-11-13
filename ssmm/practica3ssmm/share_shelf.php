<!--https://www.um.es/docencia/barzana/DAWEB/Desarrollo-de-aplicaciones-web-acceso-mysql-php.html-->

<?php
//require_once '../login.php';





$req;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $req= $_POST['PRESTAMO'];
   
	
}else if($_SERVER['REQUEST_METHOD'] == 'GET') {
     $req= $_GET['PRESTAMO'];
}
    $book1 = array('1111111111111','propietario1',TRUE);
    $book2 = array('2222222222222','propietario2',TRUE);
    $book3 = array('3333333333333','propietario3',FALSE);
    $book4 = array('4444444444444','propietario4',TRUE);
    $book5 = array('5555555555555','propietario5',FALSE);
    $book6 = array('6666666666666','propietario6',TRUE);
    $book7 = array('7777777777777','propietario7',FALSE);
    $book8 = array('8888888888888','propietario8',FALSE);
    $book9 = array('9999999999999','propietario9',TRUE);
    
	
        $db_hostname ='labtelema.ujaen.es';
        $db_username = 'as';
        $db_password = "servidortelematica";
        $db_database = "Share_shelf";

  
    $msg=''; //variable del mensaje de respuesta
    if($req!=''){
     $substrings=explode('/',$req);
    if(sizeof($substrings)==3){
        $libro=$substrings[0];
        $usuario=$substrings[1];
        $fecha=$substrings[2];
        
      
        $substrings2=explode('-',$libro);
        if(sizeof($substrings2)==2){
            $isbn=$substrings2[0];
            $propietario=$substrings2[1];
            echo $isbn."<br>";
            //$hola=hasLibro($isbn,$propietario);
            echo $hola."<br>";
            
               $comm = new mysqli($db_hostname, $db_username, $db_password,$db_database);

	
if ( $comm->connect_errno) {
    echo 'Failed to connect to MySQL: (' .  $comm->connect_errno . ') ' .  $comm->connect_error;
	die("Connection failed: " .  $comm->connect_error);
}
    $query="SELECT 'disponible' FROM 'libro' WHERE 'isbn'=? AND 'propietario'=?;";
    $pre= $comm->prepare($query);
    $query->bind_param('ss', $hisbn,$hpropietario);
    $ejecucion = $pre->execute();
    while ($ejecucion->fetch()) {
        echo $ejecucion;
    
    }
    
          /*  for($i=0;$i<9;$i++){
                $libro='book'.($i+1);
                if(strcasecmp ($$libro[0],$isbn)==0 && strcasecmp($$libro[1], $propietario)==0){ //si el libro coincide con alguno de los registrados
                    if($$libro[2]==FALSE){ //si el libro no está disponible
                    $msg='PRESTAMO=DENEGADO/LIBRO NO DISPONIBLE EN ESTE MOMENTO.';
                    echo $msg;
                }elseif($$libro[2]==TRUE){ // si el libro está disponible
                    //analizar la fecha para devolver la fecha de fin de préstamo
                    $devolucion = date_create($fecha);
                    date_add($devolucion, date_interval_create_from_date_string('1 month'));
                    $msg='PRESTAMO=ACEPTADO/'.date_format($devolucion, 'Y-m-d');
                    echo $msg;
                }
                }
            }// fin del for*/
            
            
            if($msg==''){// si el libro no se encuentra entre los libros registrados
                $msg='ERROR/LIBRO NO ENCONTRADO EN EL SISTEMA.';
                    echo $msg;
            }
        }else{//if(sizeof(substring)!=2
            $msg='ERROR/PETICIÓN INCORRECTA, PARÁMETROS DEL LIBRO MAL FORMATEADOS. ';
            echo $msg;
        }
    }else{ // if(sizeof(substrings)!=3)
        $msg='ERROR/PETICIÓN INCORRECTA, PARÁMETROS DE LA PETICIÓN MAL FORMATEADOS.';
        echo $msg;
    }
    }else{ //if(req=="")
        $msg='ERROR/PETICION INCORRECTA, PETICIÓN MAL FORMATEADA.';
        echo $msg;
    }
	
	
	
	function hasLibro($hisbn, $hpropietario){
	
    $comm = new mysqli($db_hostname, $db_username, $db_password,$db_database);

	
if ( $comm->connect_errno) {
    echo 'Failed to connect to MySQL: (' .  $comm->connect_errno . ') ' .  $comm->connect_error;
	die("Connection failed: " .  $comm->connect_error);
}
    $query="SELECT 'disponible' FROM 'libro' WHERE 'isbn'=? AND 'propietario'=?;";
    $pre= $comm->prepare($query);
    $query->bind_param('ss', $hisbn,$hpropietario);
    $ejecucion = $pre->execute();
    while ($ejecucion->fetch()) {
        echo $ejecucion;
    
    }
    
}
function libroDisp(){
    
}
    ?>
    
