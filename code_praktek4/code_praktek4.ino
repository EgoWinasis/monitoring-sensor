// Wifi
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
// Buat object Wifi
#include <WiFiClient.h>

WiFiClient wiFiClient;

ESP8266WiFiMulti WiFiMulti;
// Buat object http
HTTPClient http;
#define USE_SERIAL Serial

//send data
String urlSimpan = "http://192.168.224.146/praktek4-ultrasonik-server-lokal/data/simpan?jarak=";
String urlSimpanFlame = "http://192.168.224.146/praktek4-ultrasonik-server-lokal/data/flame?status=";
String respon = "";

//get data
String urlGetRelay = "http://192.168.224.146/praktek4-ultrasonik-server-lokal/data/getRelay";
String statusRelay = "";
String statusRelayDua = "";
String getStatus = "";
//wifi
#define WIFI_SSID "POCO M5"
#define WIFI_PASSWORD "uwiw2000!"

// Timer variables
unsigned long lastTime = 0;
unsigned long timerDelay = 5000;

// Sensor Ultrasonik
#define echoPin D7
#define trigPin D6
//sensor flame
#define FLAME_PIN D5
int bacasensor = 0;  
//relay

#define RELAY_PIN D8
#define RELAY2_PIN D9

void setup() {
  Serial.begin(115200);

  USE_SERIAL.begin(115200);
  USE_SERIAL.setDebugOutput(false);

  for(uint8_t t = 4; t > 0; t--) {
      USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
      USE_SERIAL.flush();
      delay(1000);
  } 

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP(WIFI_SSID, WIFI_PASSWORD);

  for (int u = 1; u <= 5; u++)
  {
    if ((WiFiMulti.run() == WL_CONNECTED))
    {
      USE_SERIAL.println("Terhubung ke wifi");
      USE_SERIAL.flush();
      delay(1000);
    }
    else
    {
      Serial.println("Wifi belum terhubung");
      delay(1000);
    }
  }
  
  pinMode(echoPin, INPUT);
  pinMode(trigPin, OUTPUT);
  pinMode(FLAME_PIN, INPUT);
  pinMode(RELAY_PIN, OUTPUT);
  pinMode(RELAY2_PIN, OUTPUT);
}

void loop() {
//  cek status relay
  ambil_data();

      if (statusRelay == "1" && statusRelayDua == "1") {
         digitalWrite(RELAY_PIN, LOW);
        Serial.println("--------- SENSOR JARAK -----");
        Serial.println("Buzzer Aktif");
        Serial.println("Sensor Jarak Non-aktif");
        Serial.println("--------- SENSOR API -----");
        Serial.println("LED Aktif");
        Serial.println("Sensor Api Non-aktif");
      } 
      else if(statusRelay == "1" && statusRelayDua == "0"){
        digitalWrite(RELAY_PIN, LOW);
        Serial.println("--------- SENSOR JARAK -----");
        Serial.println("Buzzer Aktif");
        Serial.println("Sensor Jarak Non-aktif");
        flame();
      }
      else if(statusRelay == "0" && statusRelayDua == "1"){
         digitalWrite(RELAY2_PIN, LOW);
        jarak();
        Serial.println("--------- SENSOR API -----");
        Serial.println("LED Aktif");
        Serial.println("Sensor Api Non-aktif");
      }
      else {
          
        jarak();
        flame(); 
  }
  Serial.println();
  delay(1000);
}

void flame(){
  //flame
        bacasensor = digitalRead(FLAME_PIN);
        String statusFlame = "";
        String led = "";
        
           //  flame
        
          Serial.println("--------- SENSOR API -----");
          if (bacasensor == LOW) {
            // turn LED on:
            digitalWrite(RELAY2_PIN, LOW);
            Serial.println("Terdeteksi Panas Api");
            Serial.println("LED Menyala");
            statusFlame = "true";
          } else {
            // turn LED off:
            digitalWrite(RELAY2_PIN, HIGH);
            Serial.println("Tidak Terdeteksi Panas Api");
            Serial.println("LED Tidak Menyala");
            statusFlame = "false";
          }
          
          Serial.println();
          if ((millis() - lastTime) > timerDelay) {
            Serial.println("--------- KIRIM DATA SENSOR API -----");
            kirim_flame(statusFlame);
            
            lastTime = millis();
          }
          
}
void jarak(){

  int durasi, jarak, pos=0;
          String buzzer = "";
          digitalWrite(trigPin, HIGH);
          delayMicroseconds(10);
          digitalWrite(trigPin, LOW);
          durasi = pulseIn(echoPin, HIGH);
          jarak = (durasi / 2) / 29.1;
  //
          if (jarak < 0) {
            jarak = 0;
          } else if (jarak > 100) {
            jarak = 100;
          }
        
        //buzzer
          if(jarak < 50){
             digitalWrite(RELAY_PIN, LOW);
             buzzer = "Berbunyi";
          }else{
             digitalWrite(RELAY_PIN, HIGH);
             buzzer = "Tidak Berbunyi";
          }
        
          Serial.println("--------- SENSOR JARAK -----");
          Serial.print("Jarak : ");
          Serial.print(jarak);
          Serial.println(" cm");
          
          Serial.print("Buzzer : ");
          Serial.print(buzzer);
          Serial.println();

          if ((millis() - lastTime) > timerDelay) {
            // Kirim Data Sensor Ultrasnoik ke Database
            Serial.println("--------- KIRIM DATA SENSOR JARAK -----");
            kirim_database(jarak);
            
            lastTime = millis();
          }
}
void kirim_database(int jrk) {
  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    USE_SERIAL.print("[HTTP] Memulai...\n");
    
    http.begin( wiFiClient, urlSimpan + (String) jrk );
    
    USE_SERIAL.print("[HTTP] Kirim ke database ...\n");
    int httpCode = http.GET();

    if(httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK) // kode 200 
      {
        respon = http.getString();
        USE_SERIAL.println("Respon : " + respon);
        delay(200);
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }
}

void kirim_flame(String flame) {
  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    USE_SERIAL.print("[HTTP] Memulai...\n");
    
    http.begin( wiFiClient, urlSimpanFlame + flame );
    
    USE_SERIAL.print("[HTTP] Kirim ke database ...\n");
    int httpCode = http.GET();

    if(httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK) // kode 200 
      {
        respon = http.getString();
        USE_SERIAL.println("Respon : " + respon);
        delay(200);
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }
}


void ambil_data() {
  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    USE_SERIAL.print("[HTTP] Memulai...\n");
    
    http.begin( wiFiClient, urlGetRelay );
    
    USE_SERIAL.print("[HTTP] Ambil data dari database ...\n");
    int httpCode = http.GET();

    if(httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK) // kode 200 
      {
        getStatus = http.getString();
        statusRelay = getStatus.substring(0,1);
        statusRelayDua = getStatus.substring(2);
        USE_SERIAL.println("Status Relay 1: " + statusRelay);
        USE_SERIAL.println("Status Relay 2: " + statusRelayDua);
        delay(200);
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }
}
