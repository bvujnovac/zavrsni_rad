      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {

        var data = google.visualization.arrayToDataTable(jsonLight);

        var options = {
          title: 'Osvjetljenje',
          hAxis: {title: 'Vrijeme(dan,sat:minuta)',  titleTextStyle: {color: '#333'}, textStyle : {fontSize: 11}},
          vAxis: {minValue: 0, maxValue: 100},
          colors: ['blue'],
          legend: 'none',
          lineWidth: 3
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }//kraj osvjetljenja
         
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable(jsonTemp);

        var options1 = {
          title: 'Temperatura',
          hAxis: {title: 'Vrijeme(dan,sat:minuta)',  titleTextStyle: {color: '#333'}, textStyle : {fontSize: 11}},
          vAxis: {minValue: 0, maxValue: 40},
          colors: ['red'],
          legend: 'none',
          lineWidth: 3
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart.draw(data, options1);
      }//kraj temperature
         
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable(jsonTemp);

        var options2 = {
          title: 'Vlaga',
          hAxis: {title: 'Vrijeme(dan,sat:minuta)',  titleTextStyle: {color: '#333'}, textStyle : {fontSize: 11}},
          vAxis: {minValue: 0},
          colors: ['black'],
          legend: 'none',
          lineWidth: 3
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
        chart.draw(data, options2);
      }//kraj vlage
         
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart4);

      function drawChart4() {

        var data = google.visualization.arrayToDataTable(jsonTemp);

        var options3 = {
          title: 'pH',
          hAxis: {title: 'Vrijeme(dan,sat:minuta)',  titleTextStyle: {color: '#333'}, textStyle : {fontSize: 11}},
          vAxis: {minValue: 0},
          colors: ['green'],
          legend: 'none',
          lineWidth: 3
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div4'));
        chart.draw(data, options3);
      }//kraj ph
         
         $(window).resize(function(){
  		drawChart1();
  		drawChart2();
        drawChart3();
        drawChart4();
		});
         
      function httpGet(theUrl) {
    	var xmlHttp = new XMLHttpRequest();
    	xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    	xmlHttp.send( null );
    	return xmlHttp.responseText;
	    }
         function ok() {
           $.notify("Upaljeno", "success");
         }
         
         function notok() {
           $.notify("Ugašeno", "error");
         }