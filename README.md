Arduino sensor monitoring, quality assessment of soil and environmental conditions for plants growth.

Sensors: Eh (oxidation reduction potential), temperature, light and soil moisture

How it works(work in progress): 

-arduino gets data from sensors and forwards strings to esp8266 (decision making is still not implemented, by decision making I mean automatic controll of temperature and moisture,PI or PID regulator).


-esp8266 recives a string of data and forwards them to the server to be written in mysql database.


-esp8266 pulls some response (while he is not reciveing in serial input) from sql database on server and forwards them to arduino serial input where he parses string and turns ON or OFF digital pins depending on the value from server response


-web application is designed(written in PHP, HTML, CSS, JAVASCRIPT) to show values of sensors from readings written in sql database in time graph.

-web application can controll pins on arduino by setting values in sql database. Esp8266 will pick up values and send them to arduino(only needs internet connection)
