#include "Timer.h"
#include "RestClient.h"
#include <ESP8266WiFi.h>
#include <ESP8266mDNS.h>
#include <WiFiUdp.h>
#include <ArduinoOTA.h>
// Port defaults to 8266
Timer t;

String response;
String data = "";

RestClient client = RestClient("privserver.ddns.net");

//Setup
void setup() {
  Serial.begin(9600);
  client.begin("Mr", "mobitel16");
  ArduinoOTA.setHostname("ESP8266-zavrsni");
  ArduinoOTA.onStart([]() {
    Serial.println("Start");
  });
  ArduinoOTA.onEnd([]() {
    Serial.println("\nEnd");
  });
  ArduinoOTA.onProgress([](unsigned int progress, unsigned int total) {
    Serial.printf("Progress: %u%%\r", (progress / (total / 100)));
  });
  ArduinoOTA.onError([](ota_error_t error) {
    if (error == OTA_AUTH_ERROR) Serial.println("Auth Failed");
    else if (error == OTA_BEGIN_ERROR) Serial.println("Begin Failed");
    else if (error == OTA_CONNECT_ERROR) Serial.println("Connect Failed");
    else if (error == OTA_RECEIVE_ERROR) Serial.println("Receive Failed");
    else if (error == OTA_END_ERROR) Serial.println("End Failed");
  });
  ArduinoOTA.begin();
  //Serial.println("Ready");
  //Serial.print("IP address: ");
  //Serial.println(WiFi.localIP());
  t.every(3000, execute);
}
void loop() {
  ArduinoOTA.handle();
  if (Serial.available() > 0) {
    data = Serial.readString();
    String stringOne = "/meteo/add.php?" + data;
    String stringtwo = String(stringOne + " HTTP/1.1");
    char __dataFileName[stringtwo.length()];
    stringtwo.toCharArray(__dataFileName, stringtwo.length() + 1);
    int statusCode = client.get(__dataFileName);
    data.remove(0);
    stringOne.remove(0);
    stringtwo.remove(0);
  }
  else {
    t.update();
  }
}

void execute() {
  response = "";
  int statusCode1 = client.get("/meteo/button.php?status HTTP/1.1", &response);
  Serial.print(response);
  //Serial.print(statusCode1);
}
