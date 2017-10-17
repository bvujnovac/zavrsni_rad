<?php 
include("connect.php");
	$file = '/var/www/html/uploads/prijave.json';
	$link=Connection();

	$result=mysql_query("SELECT * FROM (SELECT TIME_FORMAT(`timeStamp`, '%H:%i:%s') AS `time`, `light`, `temperature` FROM `tempLog`  ORDER BY `time` DESC LIMIT 11) sub ORDER BY `time` ASC",$link);

function mysql_field_array($query) {

    $field = mysql_num_fields($query);

    for ($i = 0; $i < $field; $i++) {
        $names[] = mysql_field_name($query, $i);
    }
    return $names;
}

if($result!==FALSE){
		     while($row = mysql_fetch_assoc($result)) {
               $b[] = $row; 
		     }
             $a = mysql_field_array($result);
             $c [] = $a;
             foreach ($b as $key => $value) {
               $br = 0;
               $variable [$br] = $value["time"];
               $variable [$br+1] = intval($value["light"]);
               $variable [$br+2] = intval($value["temperature"]);
               $br++;
               $c [] = $variable;
             }
			//var_dump($c);
            $jsonTable = json_encode($c);
  			//var_dump($jsonTable);
  			//echo $jsonTable;
  			//$json = json_encode($jsonTable);
  if (isset($c)) {
    file_put_contents($file, json_encode($c, true), FILE_APPEND);
}
  			 //file_put_contents($file, json_encode($c, true), FILE_APPEND);
		     mysql_free_result($result);
		     mysql_close();
		  }
?>
<?=$jsonTable?>