<?php  
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
    
  
    $msg=''; //variable del mensaje de respuesta
    if($req!=''){
     $substrings=explode('/',$req);
    if(sizeof($substrings)==3){
        $libro=$substrings[0];
        $usuario=$substrings[1];
        $fecha=$substrings[2];
        
        /*Respuesta = OK/ERROR

OK=“PRESTAMO=“ ( Aceptado / Denegado )
	Aceptado = “ACEPTADO“ SP1 Devolución		; Si se acepta la petición
		Devolución=Fecha				; Fecha máxima de devolución como 									  formato de fecha definido											  anteriormente
		Denegado = “DENEGADO” SP1 Causa	; Si se deniega la petición
		Causa = 5*50 ALPHA				; Breve explicación de la causa

ERROR=“ERROR ” Causa
		Causa = “PETICIÓN INCORRECTA” / “LIBRO NO ENCONTRADO”

                    SP1="/"         */
        
        
        $substrings2=explode('-',$libro);
        if(sizeof($substrings2)==2){
            $isbn=$substrings2[0];
            $propietario=$substrings2[1];
            
            for($i=0;$i<9;$i++){
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
            }// fin del for
            if($msg==''){// si el libro no se encuentra entre los libros registrados
                $msg='ERROR LIBRO NO ENCONTRADO';
                    echo $msg;
            }
        }else{//if(sizeof(substring)!=2
            $msg='ERROR PETICIÓN INCORRECTA(particionusuario)';
            echo $msg;
        }
    }else{ // if(sizeof(substrings)!=3)
        $msg='ERROR PETICIÓN INCORRECTA(particionparametros)';
        echo $msg;
    }
    }else{ //if(req=="")
        $msg='ERROR PETICION INCORRECTA(peticionentera)';
        echo $msg;
    }
    ?>
    
