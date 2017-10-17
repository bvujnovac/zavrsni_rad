<?php
   	include("connect.php");
	$link=Connection();
  	if (isset($_GET["status"])) {
    
   		$result=mysql_query("SELECT * FROM `button` ",$link);
      
      if($result!==FALSE){
		     while($row = mysql_fetch_array($result)) {
               $d_4=$row['d4'];
               $d_5=$row['d5'];
               $d_6=$row['d6'];
               $d_7=$row['d7'];
               $d_8=$row['d8'];
               $p_wm=$row['pwm'];
               echo 'd4='.$d_4.'d5='.$d_5.'d6='.$d_6.'d7='.$d_7.'d8='.$d_8.'pwm='.$p_wm;
		     }
		     mysql_free_result($result);
		     mysql_close();
		  }
  	}
	else if (isset($_GET["d4"]) && $_GET["d4"] == '0') {
		$query = "UPDATE `button` SET `d4`=0"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
	else if (isset($_GET["d4"]) && $_GET["d4"] == '1') {
		$query = "UPDATE `button` SET `d4`=1"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
else if (isset($_GET["d5"]) && $_GET["d5"] == '0') {
		$query = "UPDATE `button` SET `d5`=0"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
	else if (isset($_GET["d5"]) && $_GET["d5"] == '1') {
		$query = "UPDATE `button` SET `d5`=1"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
else if (isset($_GET["d6"]) && $_GET["d6"] == '0') {
		$query = "UPDATE `button` SET `d6`=0"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
	else if (isset($_GET["d6"]) && $_GET["d6"] == '1') {
		$query = "UPDATE `button` SET `d6`=1"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
else if (isset($_GET["d7"]) && $_GET["d7"] == '0') {
		$query = "UPDATE `button` SET `d7`=0"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
	else if (isset($_GET["d7"]) && $_GET["d7"] == '1') {
		$query = "UPDATE `button` SET `d7`=1"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
else if (isset($_GET["d8"]) && $_GET["d8"] == '0') {
		$query = "UPDATE `button` SET `d8`=0"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
	else if (isset($_GET["d8"]) && $_GET["d8"] == '1') {
		$query = "UPDATE `button` SET `d8`=1"; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
else if (isset($_GET["pwm"]) && $_GET["pwm"] >= '0' && $_GET["pwm"] <= '255') {
 	 	$pWM = $_GET["pwm"];
		$query = "UPDATE `button` SET `pwm`=".$pWM; 
   	
   		mysql_query($query,$link);
		mysql_close($link);
  	}
else {
    header("HTTP/1.1 406 Not Acceptable");
}
?>