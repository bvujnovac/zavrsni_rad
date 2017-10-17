#include "Timer.h"
#include <SoftwareSerial.h>

Timer t;

//helper variables
int temp_val;
int ldr_val;
int ph_val;
int moist_val;
String data = "";
String tempData = "";
String lightData = "";
String stringTemp = "";
String stringLight = "";
//pin strings to search
char d4[] = "d4=1";
char d5[] = "d5=1";
char d6[] = "d6=1";
char d7[] = "d7=1";
char d8[] = "d8=1";
char d10[] = "pwm=";

//sensor pins
int tempPin = A0;
int ldr = A1;
int ph = A2;
int moist = A3;
//serial pins
int rx = 3;
int tx = 2;
//control pins
int pn4 = 4;
int pn5 = 5;
int pn6 = 6;
int pn7 = 7;
int pn8 = 8;
int pn10 = 10;

unsigned int minut = (1000 * 60);
unsigned long minute = (minut * 15L);

SoftwareSerial esp(rx, tx); // RX, TX

void setup()
{
  Serial.begin(9600);
  esp.begin(9600);
  pinMode(LED_BUILTIN, OUTPUT);
  t.every(minute, execute);
}
void temperature()
{
  temp_val = analogRead(tempPin);
  delay(10);
  temp_val = analogRead(tempPin);
  float mv = ( temp_val / 1024.0) * 4700;
  float cel = mv / 10;
  tempData = cel;
  stringTemp = "temp1=" + tempData;
  tempData.remove(0);
}
void light() {
  ldr_val = analogRead(ldr);
  delay(10);
  ldr_val = analogRead(ldr);
  float mv1 = ( 100 / 1019.0);
  int light = ldr_val * mv1;
  lightData = light;
  stringLight = "light1=" + lightData;
  lightData.remove(0);
}

int find_text(String needle, String haystack) {
  int foundpos = -1;
  for (int i = 0; i <= haystack.length() - needle.length(); i++) {
    if (haystack.substring(i, needle.length() + i) == needle) {
      foundpos = 1;
    }
  }
  return foundpos;
}

int find_text1(String needle, String haystack) {
  int foundpos = -1;
  for (int i = 0; i <= haystack.length() - needle.length(); i++) {
    if (haystack.substring(i, needle.length() + i) == needle) {
      foundpos = i;
    }
  }
  return foundpos;
}
void loop()
{
  if (esp.available() > 0) {
    data = esp.readString();
    int pin4 = find_text(d4, data);
    int pin5 = find_text(d5, data);
    int pin6 = find_text(d6, data);
    int pin7 = find_text(d7, data);
    int pin8 = find_text(d8, data);
    int pin10 = find_text1(d10, data);

    String pwm = data.substring(pin10);
    String pwmValue = pwm.substring(4);
    int pwmInt = pwmValue.toInt();

    if (pin4 == 1) {
      digitalWrite(pn4, HIGH);
      pin4 = 0;
    }
    else {
      digitalWrite(pn4, LOW);
    }
    if (pin5 == 1) {
      digitalWrite(pn5, HIGH);
      pin5 = 0;
    }
    else {
      digitalWrite(pn5, LOW);
    }

    if (pin6 == 1) {
      digitalWrite(pn6, HIGH);
      pin6 = 0;
    }
    else {
      digitalWrite(pn6, LOW);
    }

    if (pin7 == 1) {
      digitalWrite(pn7, HIGH);
      pin7 = 0;
    }
    else {
      digitalWrite(pn7, LOW);

    }

    if (pin8 == 1) {
      digitalWrite(pn8, HIGH);
      pin8 = 0;
    }
    else {
      digitalWrite(pn8, LOW);
    }
    analogWrite(pn10, pwmInt);
    data.remove(0);
    //pwm.remove(0);
    //pwmValue.remove(0);
  }

  else {
    t.update();
  }
}
void execute() {
  temperature();
  light ();
  String sendData = stringTemp + "&" + stringLight;
  esp.print(sendData);
  stringTemp.remove(0);
  stringLight.remove(0);
}
