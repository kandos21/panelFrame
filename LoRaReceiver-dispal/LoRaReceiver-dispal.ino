//METHAT V 1.1.4-M
#include "LoRaWan_APP.h"
//#include "Arduino.h"
#include <OneWire.h>                                           // libreria para conexion con sensor de temperatura
#include "HT_SSD1306Wire.h"                                  // librerias de display
#include <DallasTemperature.h>                              //libreria del sensor de temperaatura
#include "SPI.h"
#include <WiFi.h>   
#include <HTTPClient.h>    
#include <PubSubClient.h>
#include <SoftwareSerial.h>//incluimos SoftwareSerial
#include <TinyGPS.h>//incluimos TinyGPS
#include <string.h>
#define RF_FREQUENCY                                915000000 // Hz
#define TX_OUTPUT_POWER                             14        // dBm
#define LORA_BANDWIDTH                              0         // [0: 125 kHz,
                                                              //  1: 250 kHz,
                                                              //  2: 500 kHz,
                                                              //  3: Reserved]
#define LORA_SPREADING_FACTOR                       7         // [SF7..SF12]
#define LORA_CODINGRATE                             1         // [1: 4/5,
                                                              //  2: 4/6,
                                                              //  3: 4/7,
                                                              //  4: 4/8]
#define LORA_PREAMBLE_LENGTH                        8         // Same for Tx and Rx
#define LORA_SYMBOL_TIMEOUT                         0         // Symbols
#define LORA_FIX_LENGTH_PAYLOAD_ON                  false
#define LORA_IQ_INVERSION_ON                        false

#define RX_TIMEOUT_VALUE                            1000
#define BUFFER_SIZE                                 60 // Define the payload size here
char txpacket[BUFFER_SIZE];
char rxpacket[BUFFER_SIZE];

IPAddress ip(192, 168, 1, 200);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);
char *datos[34];
char *tem1;
char* tem2;
char* tem3;
char* h1;
char* h2;
char* h3;
char* id; //corresponde al id de dispositivo
char* ids=0;
//tem2,porcentaje1,id;        //declaracion de variales de los paquetes recibidos
//const char* ssid     = "LUIX";
//const char* password = "kandos21.";
const char* ssid     = "LUIX";
const char* password = "kandos21.";
//const char* serverName = "http://192.168.0.136/post-esp-data.php";  //ruta del servidor para realzar la conexion de la base de datos
const char* serverName = "https://me.wafflesbelgas.mx/";  //ruta del servidor para realzar la conexion de la base de datos
String version= "V 1.1.7S";
String idDevice;
String httpRequestData,httpRequestT;
String modulo;
static RadioEvents_t RadioEvents;
int16_t txNumber;
int16_t rssi,rxSize;
int8_t snr;
String httpCode;
bool lora_idle = true;
int year;
byte month, day, hour, minute, second, hundredths;
unsigned long chars;
unsigned short sentences, failed_checksum;
SoftwareSerial serialgps(19,20); //(19, 20);  //(tx,rx)
TinyGPS gps;//Declaramos el objeto gps
SSD1306Wire  methat_display(0x3c, 500000, SDA_OLED, SCL_OLED, GEOMETRY_128_64, RST_OLED); // addr , freq , i2c group , resolution , rst

void setup() 
{ 
   delay(4000);
   // serialgps.begin(9600);//Iniciamos el puerto serie del gps
    Serial.begin(115200);
    Mcu.begin();
    rssi=0;
    if(! methat_display.init()) 
    { Serial.println(F("SSD1306 display fallo"));}
    else
     {  methat_display.clear();  }
      WIFISetUp();
	    //WiFi.disconnect(); //
	    //WiFi.mode(WIFI_STA);
	    delay(100);
     RadioEvents.RxDone = OnRxDone;
     Radio.Init( &RadioEvents );
     Radio.SetChannel( RF_FREQUENCY );
     Radio.SetRxConfig( MODEM_LORA, LORA_BANDWIDTH, LORA_SPREADING_FACTOR,
                               LORA_CODINGRATE, 0, LORA_PREAMBLE_LENGTH,
                               LORA_SYMBOL_TIMEOUT, LORA_FIX_LENGTH_PAYLOAD_ON,
                               0, true, 0, 0, LORA_IQ_INVERSION_ON, true );
}

void loop()
{   
  methat_display.clear();
   idDevice = getDeviceID();
   methat_display.drawString(0, 50, version+"  "+idDevice);
      if(lora_idle)
     {
      lora_idle = false;
      Serial.println("entro mode RX");
      Radio.Rx(0);
     }
      Radio.IrqProcess();
      // SensorGPS();
      delay(4000);
       wifiSendInfo();    
}

void SensorGPS()
{
  while(serialgps.available()>0)
   {  
       
       if (gps.encode( serialgps.read()))
        {
           methat_display.drawString(40, 0,"GPS:Y" );
          float latitude, longitude; 
          gps.f_get_position(&latitude, &longitude);
          Serial.print("Latitud/Longitud: ");
          Serial.print(latitude, 5);
          Serial.print(", ");
          Serial.println(longitude, 5);
          methat_display.drawString(0, 10, "lt:"+String(latitude,5));
          methat_display.drawString(60,10, "lg:"+String(longitude,5));
          methat_display.drawString(0, 20, "date:"+String(day,DEC)+"/"+String(month,DEC)+"/"+String(year));
          methat_display.drawString(0, 30, "hora:"+String(hour,DEC)+":"+String(minute,DEC)+":"+String(second,DEC));
         // display.drawString(0, 50, "velocidad(mph):"+String(gps.f_speed_kmph()));
         // display.drawString(0, 50, "satelites:"+String(gps.satellites()));
          gps.crack_datetime(&year, &month, &day, &hour, &minute, &second, &hundredths);
          Serial.print("Fecha: "); Serial.print(day, DEC); Serial.print("/");
          Serial.print(month, DEC); Serial.print("/"); Serial.print(year);
          Serial.print(" Hora: "); Serial.print(hour, DEC); Serial.print(":");
          Serial.print(minute, DEC); Serial.print(":"); Serial.print(second, DEC);
          Serial.print("."); Serial.println(hundredths, DEC);
          Serial.print("Altitud (metros): ");
          Serial.println(gps.f_altitude());
          Serial.print("Rumbo (grados): "); Serial.println(gps.f_course());
          Serial.print("Velocidad(kmph): ");
          Serial.println(gps.f_speed_kmph());
          Serial.print("Satelites: "); Serial.println(gps.satellites());
          Serial.println();
          gps.stats(&chars, &sentences, &failed_checksum);
          delay(1000);
        }
        else
        {
          Serial.print("G-N");
        }
        methat_display.display();
   }
}

void OnRxDone( uint8_t *payload, uint16_t size, int16_t rssi, int8_t snr )
{ 
    rssi=rssi;
    rxSize=size;
    snr=snr;
    Serial.println("ESTATUS BANDERA LORA RX:"+String(lora_idle));
    memcpy(rxpacket, payload, size );
    rxpacket[size]='\0';
    Radio.Sleep( );
    Serial.printf("\r\paquete recibido \"%s\" with rssi %d , longitud %d\r\n",rxpacket,rssi,rxSize);
  //  methat_display.drawString(0, 50, "d="+String(rxpacket));
    //Serial.print(rxpacket);
    //sscanf(rxpacket,"%d,%f,%f,%f,%d",id,tem1,tem2,porcentaje1,txNumber);
    //char cadena=rxpacket;
    char dlm[]=",";
    char *token=strtok(rxpacket,dlm);
    if(token !=NULL)
    {
      for (int i=0; token!=NULL; i++)
      {
         datos[i]=token;
         //Serial.println("token:"+String(i)+": "+String(token));
         token= strtok(NULL, dlm);   
      }
      id=datos[0];
      tem1=datos[1];
      tem2=datos[2];
      tem3=datos[3];
      h1=datos[4];
       h2=datos[5];
        h3=datos[6];
      ids=datos[7];
       Serial.println("TOKEN id:"+String(id));
       Serial.println("TOKEN tem1:"+String(tem1));
       Serial.println("TOKEN tem2:"+String(tem2));
       Serial.println("TOKEN tem3:"+String(tem3));
       Serial.println("TOKEN h1:"+String(h1));
       Serial.println("TOKEN h2:"+String(h2));
       Serial.println("TOKEN h3:"+String(h3));
       Serial.println("TOKEN ids:"+String(ids));    
        Serial.println("TOKEN tamaño:"+String(rxSize)); 
        Serial.println("TOKEN rssi:"+String(rssi)); 
        methat_display.drawString(0, 40,"L:"+String(rxSize)+"  IDS:"+String(ids)+"   SNR:"+String(snr));       
    }
    	methat_display.display();
     lora_idle = true;
     delay(1000);    
}


String getDeviceID() {
  uint64_t chipid = ESP.getEfuseMac(); // The chip ID is essentially its MAC address(length: 6 bytes).
  uint16_t chip = (uint16_t)(chipid >> 32);
  char devID[40];
  snprintf(devID, 40, "%04X%08X", chip, (uint32_t)chipid);
  return devID;
}

void wifiSendInfo()
{
   if(WiFi.status()== WL_CONNECTED)
  {  
      //Check WiFi connection status
  	methat_display.drawString(0, 0, "WIFI OK."); 
    String LocalIP = String() + WiFi.localIP()[0] + "." + WiFi.localIP()[1] + "." + WiFi.localIP()[2] + "." + WiFi.localIP()[3];
    methat_display.drawString(2,20,LocalIP);
    Serial.println(WiFi.localIP());
    Serial.println("ESTATUS BANDERA LORA wifiSend:"+String(lora_idle));
         if(lora_idle)
         {
           Serial.print("ids::"+String(ids));
        //String httpRequestData="id_modulo="+idDevice+"&id_sensor="+id+"&valor_analogico="+ids+"&h1="+h1+"&tem1="+tem1+"&tem2="+tem2;
         String httpRequestTemperatura1=String()+"id_sensor="+id+"&temperatura="+tem1+"&ids="+ids;
         String httpRequestTemperatura2=String()+"id_sensor="+id+"&temperatura="+tem2+"&ids="+ids;
          String httpRequestTemperatura3=String()+"id_sensor="+id+"&temperatura="+tem3+"&ids="+ids;
         String httpRequestHumedad1=String()+"id_sensor="+id+"&humedad="+h1+"&ids="+ids;
          String httpRequestHumedad2=String()+"id_sensor="+id+"&humedad="+h2+"&ids="+ids;
           String httpRequestHumedad3=String()+"id_sensor="+id+"&humedad="+h3+"&ids="+ids;
        //String httpRequestDispositivo="id_modulo="+idDevice+"&id_sensor="+id+"&cantidad_datos="+rxSize+"&rssi="+rssi+"&ids";
        Serial.print("httpRequestTemperatura1:"+httpRequestTemperatura1);
        //Serial.println(httpRequestTemperatura1);
        modulo="temperatura";
       httpCode= HttpSendDatos(httpRequestTemperatura1,modulo);
       Serial.println("HTTP-CODE Temperatura:"+String(httpCode));
       delay(1000);
       Serial.print("httpRequestTemperatura2:");
       Serial.print(httpRequestTemperatura2);
        httpCode= HttpSendDatos(httpRequestTemperatura2,modulo);
        Serial.println("HTTP-CODE Temperatura:"+String(httpCode));
       delay(1000);
       Serial.print("httpRequestTemperatura3:");
       Serial.print(httpRequestTemperatura3);
         httpCode= HttpSendDatos(httpRequestTemperatura3,modulo);
        Serial.println("HTTP-CODE Temperatura:"+String(httpCode));
      delay(1000);
       
       Serial.print("httpRequestHumedad:");
       Serial.print(httpRequestHumedad1);
       modulo="humedad";
       httpCode=HttpSendDatos(httpRequestHumedad1,modulo);
       Serial.println("HTTP-CODE Humedad:"+String(httpCode));

       Serial.print("httpRequestHumedad2:");
       Serial.print(httpRequestHumedad2);
       httpCode=HttpSendDatos(httpRequestHumedad2,modulo);
       Serial.println("HTTP-CODE Humedad:"+String(httpCode));

        Serial.print("httpRequestHumedad3:");
       Serial.print(httpRequestHumedad3);
       httpCode=HttpSendDatos(httpRequestHumedad3,modulo);
       Serial.println("HTTP-CODE Humedad:"+String(httpCode));
       ids=0;
         }
         else
         {
           Serial.print("NO HAY CONEXION CON SLAVE LORA");
         }
  }
  else 
  {
      Serial.println("WiFi NO CONECTADO");
		  methat_display.drawString(0, 0, "WIFI N2");
      WIFISetUp();
		  //se alamacena en una sd o termina el codigo
  }
   methat_display.display();
   delay(1000);  
}

int HttpSendDatos(String httpRequestData,String modulo)
{
  WiFiClient client;
    HTTPClient http;
    String apiRest=serverName+modulo;
     http.begin(apiRest);// Your Domain name with URL path or IP address with path
       http.addHeader("Content-Type", "application/x-www-form-urlencoded");// Specify content-type header
    int httpResponseCode = http.POST(httpRequestData); // Send HTTP POST request
       if (httpResponseCode>0)
        {
         Serial.print("HTTP Response code:");
         Serial.println(httpResponseCode);
          String response = http.getString();                       //Get the response to the request
          Serial.println(response);           //Print request answer
        }
        else 
        {
         Serial.print("Error code: ");
         Serial.println(httpResponseCode);
        }
        http.end();// Free resources*/
        return httpResponseCode;
}

void WIFISetUp(void)
{
	// Set WiFi to station mode and disconnect from an AP if it was previously connected
	//WiFi.disconnect(true);//desconectamos de la red antenrior
	delay(100);       
	WiFi.mode(WIFI_STA);//ponermos al dispositivo en modo estacion
	WiFi.setAutoConnect(true); //conectara automaticamente cuando se encienda el dispositivo
	WiFi.begin(ssid,password);//claves de acceso al wifi
	delay(100);
	byte count = 0;
  Serial.print("entro al wifi setup");
	while(WiFi.status() != WL_CONNECTED && count < 10) //si el dispositivo esta en estado "desconectado"
	{
		count ++;
		delay(1000);
		methat_display.drawString(30, 0, "WIFI..");
    	
	}
	if(WiFi.status() == WL_CONNECTED)//verificamos si el estado de wifi es "CONECTADO"
	{
		methat_display.drawString(30, 0, "WIFI Y"); 
   String LocalIP = String() + WiFi.localIP()[0] + "." + WiFi.localIP()[1] + "." + WiFi.localIP()[2] + "." + WiFi.localIP()[3];
   methat_display.drawString(2,20,LocalIP);
   Serial.println(WiFi.localIP());
	}
	else//si no hubo conexion el estado es diferente a "CONECTADO"
	{
		methat_display.drawString(30, 0, "WIFI N");
		//while(1);
	}
	methat_display.drawString(0, 10, "TERMINO TEST WIFI");
	methat_display.display();
	delay(1000);
}
