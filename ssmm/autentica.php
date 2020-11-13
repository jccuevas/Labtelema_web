<?php  
$username = "";
$password = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];
	
}else if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = $_GET['user'];
    $password = $_GET['pass'];
}

if($username!="" && $password!=""){
 
// Usuarios correctos:
// 		user1 pass=12345
// 		user2 pass=12345
// 		user3 pass=12345

    $expires = mktime(date("H")+1, date("i"), date("s"), date("m")  , date("d"), date("Y"));
	if(($username=="user1" || $username=="user2" || $username=="user3") && $password=="12345"){
    	echo 'SESSION-ID=SID'.$username.base64_encode(sha1($username.$password.$expires)).'&EXPIRES='.date('Y-m-d-H-i-s',$expires);
	}else
		echo 'ERROR BAD USER OR PASSWORD';
}else
    echo 'ERROR WRONG REQUEST';		 
?>


