<?php
//ini_set('session.gc_maxlifetime', 1*60); // expires in 30 minutes
include("connect.php");
	
	$link=Connection();

	$result=mysql_query("SELECT * FROM (SELECT DATE_FORMAT(`timeStamp`, '%D,%H:%i:%s') AS `time`, `light`, `temperature` FROM `tempLog` ORDER BY `timeStamp` DESC LIMIT 11) sub ORDER BY `time` ASC",$link);
	$result1=mysql_query("SELECT * FROM `button` ",$link);

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
            $columnName = mysql_field_array($result);
            $lightName [] = $columnName[0];
  			$lightName [] = $columnName[1];
  			$lightNames [] = $lightName;
  			
  			$tempName [] = $columnName[0];
  			$tempName [] = $columnName[2];
  			$tempNames [] = $tempName;
            foreach ($b as $key => $value) {
              $br = 0;
              //light
              $osvjetljenje [$br] = $value["time"];
              $osvjetljenje [$br+1] = intval($value["light"]);
              //temperature
              $temperatura [$br] = $value["time"];
              $temperatura [$br+1] = floatval($value["temperature"]);
              $br++;
              //light array
              $lightNames [] = $osvjetljenje;
              //temp arry
              $tempNames [] = $temperatura;
            }

            $jsonTableLight = json_encode($lightNames);
  			$jsonTableTemp = json_encode($tempNames);
  
		     mysql_free_result($result);
		     mysql_close();
		  }

if($result1!==FALSE){
		     while($row1 = mysql_fetch_array($result1)) {
               //$d_4=$row['d4'];
               //$d_5=$row['d5'];
               //$d_6=$row['d6'];
               //$d_7=$row['d7'];
               //$d_8=$row['d8'];
               $p_wm=$row1['pwm'];
               //echo 'd4='.$d_4.'d5='.$d_5.'d6='.$d_6.'d7='.$d_7.'d8='.$d_8.'pwm='.$p_wm;
		     }
		     mysql_free_result($result1);
		     mysql_close();
		  }
session_start();

if (isset($_POST['username']) && $_POST['username'] == 'student' &&
        isset($_POST['password']) && $_POST['password'] == 'zavrsnirad'
) {
    $_SESSION['is_logged_in'] = true;
    header('Location: /meteo/index.php');
}
?>
<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.0/css/bootstrap-slider.min.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
      	<script type="text/javascript" src="./js/custom.js"></script>
       <script type="text/javascript">
      var jsonLight = <?=$jsonTableLight?>;
      var jsonTemp = <?=$jsonTableTemp?>;
    </script>
        <title>FERIT Završni rad</title>
    </head>
    <body>
        <header>
          <?php
              if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
           echo '<nav class="navbar navbar-inverse">
                <div class="container">
                <ul class = "nav navbar-nav">
        			<li class="dropdown">
        			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Meni<span class="caret"></span></a>
        			<ul class="dropdown-menu">
          			<li><a href="#">Opcija 1</a></li>
          			<li><a href="#">Opcija 2</a></li>
          			<li><a href="#">Opcija 3</a></li>
        			</ul>
                    <li><a href="index.php">Osvježi</a></li>
                    </ul>
                    <ul class = "nav navbar-nav navbar-right">
                        <li><a href = "/meteo/logout.php">Odlogiraj me</a></li>
                        </ul>
                        </div>
                        </nav>';
              }
          ?>
        </header>

        <main class="container-fluid text-center">

            <?php
            if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): {
                    //echo '<div id="chart_div" style="width: 100%; height: 500px;"></div>';
              $str = "httpGet('http://privserver.ddns.net/zavrsni/button.php?but=1')";
              echo '<div class="row content">
  <div class="col-md-12 text-center">
    <h2>Sustav nadzora i ocjene kakvoće tla i uvjeta za uzgoj bilja</h2>
  </div>
  <div class="col-md-4 col-md-offset-4">
    <hr />
  </div>
  <div class="clearfix"></div>
  <!--<div class="col-md-2 sidenav">
      <div id="table_div">
      <p>Prostor za tablicu</p>
      </div>
    </div>-->
  <div class="col-md-6">
    <div id="chart_div1" class="chart"></div>
    <div class="row centered">
    <button class="btn btn-success" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d4=1&#39;); ok();">Upali svijetlo</button><button class="btn btn-danger" style="margin: auto;" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d4=0&#39;); notok();">Ugasi svijetlo</button>
    </div>
  </div>
  <div class="col-md-6">
    <div id="chart_div2" class="chart"></div>
    <div class="row centered">
    <button class="btn btn-success" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d5=1&#39;); ok();">Upali grijanje</button><button class="btn btn-danger" style="margin: auto;" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d5=0&#39;); notok();">Ugasi grijanje</button>
    <button class="btn btn-success" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d6=1&#39;); ok();">Upali ventilaciju</button><button class="btn btn-danger" style="margin: auto;" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d6=0&#39;); notok();">Ugasi ventilaciju</button>
    </div>
  </div>
</div>

<div class="row content">
<!--<div class="col-md-2 sidenav">
      <div class="row centered">
    </div>
    </div>-->
  <div class="col-md-6">
    <div id="chart_div3" class="chart"></div>
    <div class="row centered">
    <button class="btn btn-success" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d7=1&#39;); ok();">Upali pumpu vode</button><button class="btn btn-danger" style="margin: auto;" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d7=0&#39;); notok();">Ugasi pumpu vode</button>
    </div>
  </div>
  <div class="col-md-6">
    <div id="chart_div4" class="chart"></div>
     <div class="row centered">
    <button class="btn btn-success" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d8=1&#39;); ok();">Upali custom</button><button class="btn btn-danger" style="margin: auto;" onclick="httpGet(&#39;https://privserver.ddns.net/meteo/button.php?d8=0&#39;); notok();">Ugasi custom</button>
    </div>
  </div>
</div>
<input type="text" name="slider" data-provide="slider" data-slider-min="0" data-slider-max="255" data-slider-step="1" data-slider-value='.$p_wm.' '.'data-slider-tooltip="always">
';}?>
            <?php else: ?>
                <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Za nastavak je potrebna prijava</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form method="post" class="form-signin">
                <input type="text" name="username" class="form-control" placeholder="Email(student)" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password(zavrsnirad)" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
          <!--<a href="#" class="text-center new-account">Create an account </a>-->
        </div>
    </div>
</div>
        <?php endif ?>
    </main>

    <footer class="footer">
        <p class="container">&copy; Ferit Završni rad, 2017 by Benjamin Vujnovac</p>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.0/bootstrap-slider.min.js"></script>
      <script type="text/javascript">
      var mySlider = $("input.slider").slider();
      var value = mySlider.slider('getValue');
      console.log(value);
    </script>
    </footer>

</body>
</html>
