<?php
   	include("connect.php");
  if (isset($_GET["temp1"]) && isset($_GET["light1"])) {
    
 	
   	$link=Connection();

	$temp1=$_GET["temp1"];
	$light1=$_GET["light1"];

	$query = "INSERT INTO `tempLog` (`temperature`, `light`) 
		VALUES ('".$temp1."','".$light1."')"; 
   	
   	mysql_query($query,$link);
	mysql_close($link);
  }

else {
    header("HTTP/1.1 406 Not Acceptable");
}
?>
