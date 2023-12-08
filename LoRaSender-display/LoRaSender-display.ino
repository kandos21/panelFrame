
#include "LoRaWan_APP.h"
//#include "Arduino.h"
#include <OneWire.h>                                           // libreria para conexion con sensor de temperatura
#include "HT_SSD1306Wire.h"                                  // librerias de display
#include <DallasTemperature.h>                              //libreria del sensor de temperaatura
//#include "WiFi.h"
#include "ESPAsyncWebServer.h"
//#include "SPIFFS.h"
#include <Arduino_JSON.h>
//#include <AsyncElegantOTA.h>

#define RF_FREQUENCY                                915000000 // Hz
#define TX_OUTPUT_POWER                             5        // dBm
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
#define BUFFER_SIZE                                 60  //define el tamño de buffer
char txpacket[BUFFER_SIZE];                             //declaracion de la variable de mensaje transmision
//char rxpacket[BUFFER_SIZE];                             //declaracion de la variable de mensaje recepcion
String versions= "V 1.1.7S";
String id;
const int ledPin = 35;
String temperatura1;
String temperatura2;
String temperatura3;

String humedad1;
String humedad2;
String humedad3;
double txNumber =0;                                     //declaracion del contador de datos enviados  LORA              
int64_t chipid;                                      //declaracion de variable para obtener el ID HEX
bool lora_idle=true;                                 //declaracion de la bandera para el estado de LORA
static RadioEvents_t RadioEvents;
void OnTxDone( void );
void OnTxTimeout( void );
SSD1306Wire  methat_display(0x3c, 500000, SDA_OLED, SCL_OLED, GEOMETRY_128_64, RST_OLED); // addr , freq , i2c group , resolution , rst
#define pinT1 19                                       //pin donde se conecta el sensor 1 de Temperatura
//#define pinT2 20                                       //pin donde se conecta el sensor 2 de Temperatura 
//#define pinT3 21                                       //pin donde se conecta el sensor 2 de Temperatura     
#define pinH1 7                                        // Pin donde se conecta el sensor 1 de Humedad
#define pinH2 6                                        // Pin donde se conecta el sensor 1 de Humedad
#define pinH3 5                                        // Pin donde se conecta el sensor 1 de Humedad
OneWire ourWire1(pinT1);                               // Instancia a las clases OneWire
//OneWire ourWire2(pinT2);                               // Instancia a las clases OneWire
//OneWire ourWire3(pinT3);                               // Instancia a las clases OneWire
DallasTemperature sensors(&ourWire1);                 //Se declara una variable u objeto para el sensor 1 de temperatura  
//DallasTemperature sensor2(&ourWire2);                 //Se declara una variable u objeto para el sensor 1 de temperatura  
//DallasTemperature sensor3(&ourWire3);                 //Se declara una variable u objeto para el sensor 1 de temperatura                                          
//const int Valor_Sensor_Aire = 2725, Valor_Sensor_Agua = 1200;     // Valores de calibracion del sensor de humedad tanto en aire como agua , SA=760 VA335
const int Valor_Sensor_Aire = 2430, Valor_Sensor_Agua = 1150; 
int valorH1 = 0, valorH2 = 0, valorH3 = 0, porcentaje1 = 0, porcentaje2 = 0,porcentaje3 = 0; //declaracion de variables para sensor de humedad
int  sensorCantidad;
float tem1,tem2,tem3;

//float ahtValue;                               //to store T/RH result
//AsyncWebServer server(80);
//AsyncWebSocket ws("/ws");
void setup() 
{
    Serial.begin(9600);
    pinMode(ledPin, OUTPUT); 
    pinMode(pinT1, INPUT);
    //pinMode(pinT2, INPUT);
    //pinMode(pinT3, INPUT);
    sensors.begin();
    //sensor2.begin();
    //sensor3.begin();
    Mcu.begin();
    if(! methat_display.init()) 
    {
      Serial.println(("SSD1306 display fallo")); //Se muestra el texto en el monitor serial en caso que falle la pantalla
    }
    id = getDeviceID();
     methat_display.drawString(0, 50, versions+"  "+id);
     methat_display.display();
     delay(5000);
      methat_display.clear();
     //methat_display.setFont(ArialMT_Plain_16);
    //WIFISetUp();
  // Print ESP32 Local IP Address
    RadioEvents.TxDone = OnTxDone;
    RadioEvents.TxTimeout = OnTxTimeout;
    Radio.Init( &RadioEvents );
    Radio.SetChannel( RF_FREQUENCY );
    Radio.SetTxConfig( MODEM_LORA, TX_OUTPUT_POWER, 0, LORA_BANDWIDTH,
                                   LORA_SPREADING_FACTOR, LORA_CODINGRATE,
                                   LORA_PREAMBLE_LENGTH, LORA_FIX_LENGTH_PAYLOAD_ON,
                                   true, 0, 0, LORA_IQ_INVERSION_ON, 3000 ); 
   }

void loop()
{      

   //display.clear();
    //display.display();
      methat_display.screenRotate(ANGLE_180_DEGREE);
      //display.setFont(ArialMT_Plain_16);
      //methat_display.drawString(methat_display.getWidth()/2, methat_display.getHeight()/2-16/2, "ROTATE_180");
      methat_display.clear();  //limpiamos pantalla
      //id = getDeviceID(); //mandamos a traer el metodo getDeviceID()   //Serial.print("IDESP32:"+String(id));// Low 4bytes.
      //methat_display.drawString(0, 50, versions+"  "+id);
      //methat_display.display();  
      temperatura();
      humedad();
      delay(5000);
      sendLora();       
}

void sendLora()
{    
      methat_display.drawString(0, 30, "H1:"+String(porcentaje1)); 
      methat_display.drawString(45, 30, "H2:"+String(porcentaje2)); 
      methat_display.drawString(90, 30, "H3:"+String(porcentaje3));
  
  if(lora_idle == true)
	    { 
        if(txNumber==99.99)
        { txNumber=00.01;}
        else
        { txNumber += 00.01;}
		      sprintf(txpacket,"%12s,%0.2f,%0.2f,%0.2f,%2d,%2d,%2d,%0.2f",id,tem1,tem2,tem3,porcentaje1,porcentaje2,porcentaje3,txNumber);  //start a package
		      Serial.printf("\r\ send \"%s\" , length %d\r\n",txpacket, strlen(txpacket));
		      Radio.Send( (uint8_t *)txpacket, strlen(txpacket) ); //send the package out
          //methat_display.drawString(0, 40, "data:"+String(txpacket));
          methat_display.drawString(0, 40, "IDS:"+String(txNumber)+"   L:"+String(strlen(txpacket)));
          lora_idle = false;
          temperatura1=String(tem1);
          temperatura2=String(tem2);
          temperatura3=String(tem3);
          humedad1=String(porcentaje1);
          humedad2=String(porcentaje2);
          humedad3=String(porcentaje3);
          /* server.on("/", HTTP_GET, [](AsyncWebServerRequest *request){
          request->send(SPIFFS, "/index.html");
           });
          server.on("/chart.min.js", HTTP_GET, [](AsyncWebServerRequest *request){
         request->send(SPIFFS, "/chart.min.js", "text/js");
         });
          server.on("/bootstrap.min.css", HTTP_GET, [](AsyncWebServerRequest *request){
         request->send(SPIFFS, "/bootstrap.min.css", "text/css");
         });
         server.on("/bootstrap.min.js", HTTP_GET, [](AsyncWebServerRequest *request){
         request->send(SPIFFS, "/bootstrap.min.js", "text/js");
         });
  
        server.on("/temperature1", HTTP_GET, [](AsyncWebServerRequest *request){
        request->send_P(200, "text/plain", temperatura1.c_str());
        });
        server.on("/temperature2", HTTP_GET, [](AsyncWebServerRequest *request){
       request->send_P(200, "text/plain", temperatura2.c_str());
       });
       server.on("/temperature3", HTTP_GET, [](AsyncWebServerRequest *request){
       request->send_P(200, "text/plain", temperatura3.c_str());
      });
      server.on("/humidity1", HTTP_GET, [](AsyncWebServerRequest *request){
      request->send_P(200, "text/plain",humedad1.c_str());
     });

  server.on("/humidity2", HTTP_GET, [](AsyncWebServerRequest *request){
    request->send_P(200, "text/plain",humedad2.c_str());
  });

  server.on("/humidity3", HTTP_GET, [](AsyncWebServerRequest *request){
    request->send_P(200, "text/plain",humedad3.c_str());
  });
  
   server.on("/id", HTTP_GET, [](AsyncWebServerRequest *request){
    request->send_P(200, "text/plain",id.c_str());
  });

  server.on("/id", HTTP_GET, [](AsyncWebServerRequest *request){
    request->send_P(200, "text/plain",versions.c_str());
  });*/
  
  //AsyncElegantOTA.begin(&server);    // Start ElegantOTA
  //server.begin();
  }
      Radio.IrqProcess( );
      digitalWrite(ledPin, HIGH); 
      methat_display.display();
      delay(5000);
      digitalWrite(ledPin, LOW);    
}

String getDeviceID() {
  uint64_t chipid = ESP.getEfuseMac(); // The chip ID is essentially its MAC address(length: 6 bytes).
  uint16_t chip = (uint16_t)(chipid >> 32);
  char devID[40];
  snprintf(devID, 40, "%04X%08X", chip, (uint32_t)chipid);
  return devID;
}

void humedad()
{
     valorH1 = analogRead(pinH1);
     valorH2 = analogRead(pinH2);
     valorH3 = analogRead(pinH3);
     porcentaje1 = map(valorH1, Valor_Sensor_Agua, Valor_Sensor_Aire, 100, 0);
     porcentaje2 = map(valorH2, Valor_Sensor_Agua, Valor_Sensor_Aire, 100, 0);
     porcentaje3 = map(valorH3, Valor_Sensor_Agua, Valor_Sensor_Aire, 100, 0);
     
     if(porcentaje1 < 0) porcentaje1 = 0;                                                  // Evita porcentajes negativos (bajo 0) en la medida del sensor
     if(porcentaje1 > 100) porcentaje1 = 100; 

     if(porcentaje2 < 0) porcentaje2 = 0;                                                  // Evita porcentajes negativos (bajo 0) en la medida del sensor
     if(porcentaje2 > 100) porcentaje2 = 100; 

     if(porcentaje3 < 0) porcentaje3 = 0;                                                  // Evita porcentajes negativos (bajo 0) en la medida del sensor
     if(porcentaje3 > 100) porcentaje3 = 100; 
      
      Serial.println("H1:"+String(porcentaje1)+"%");
      Serial.println("H1A:"+String(valorH1));
      Serial.println("");
      Serial.println("H2:"+String(porcentaje2)+"%");
      Serial.println("H2A:"+String(valorH2));
      Serial.println("");
      Serial.println("H3:"+String(porcentaje3)+"%");
      Serial.println("H3A:"+String(valorH3));
      Serial.println("");
      /*methat_display.drawString(0, 30, "H1:"+String(porcentaje1)); 
      methat_display.drawString(45, 30, "H2:"+String(porcentaje2)); 
      methat_display.drawString(90, 30, "H3:"+String(porcentaje3));*/
}

void temperatura()
{  
    sensorCantidad=sensors.getDeviceCount();
   //int sCantidad2=sensor2.getDeviceCount();
   //int sCantidad3=sensor3.getDeviceCount();
   Serial.print("cantidad sensor T:"+String(sensorCantidad));
   if (sensorCantidad>=1)
     {  
        sensors.requestTemperatures(); 
        tem1= sensors.getTempCByIndex(0); //Se obtiene la temperatura en ºC del sensor 1 
        tem2= sensors.getTempCByIndex(1); //Se obtiene la temperatura en ºC del sensor 2 
        tem3= sensors.getTempCByIndex(2); //Se obtiene la temperatura en ºC del sensor 3 
        if(tem1==-127)
         {Serial.print("T1:E-CON"); methat_display.drawString(0, 20, "T1:E");}
        else
         {Serial.println("T1:"+String(tem1));   methat_display.drawString(0, 20, "T1:"+String(tem1));}      

         if(tem2==-127)
         {Serial.print("T2:E-CON"); methat_display.drawString(45, 20, "T2:E");}
        else
         {Serial.println("T2:"+String(tem2));   methat_display.drawString(45, 20, "T2:"+String(tem2));}  
         if(tem3==-127)
         {Serial.print("T3:E-CON"); methat_display.drawString(90, 20, "T3:E");}
        else
         {Serial.println("T3:"+String(tem3));   methat_display.drawString(90, 20, "T3:"+String(tem3));}      
       }
     else{Serial.println("T ERROR"); methat_display.drawString(0, 20,"T-ERROR");  }

     
    
    /* methat_display.display();
     sensorCantidad=sensors.getDeviceCount();
    Serial.print("SensorCantidad:"+String(sensorCantidad));
     if(sensorCantidad >=1)
     {    
      sensors.requestTemperatures(); 
       for(int i=0;sensorCantidad>=i;i++)
        {  
          
           tem[i]=sensors.getTempCByIndex(i);
         if(tem[i]==-127)
          { Serial.print("T"+String(i)+":ERROR CON");
           methat_display.drawString(40, 20,"T"+String(i)+":ERROR CON"); 
           }  
         else
         {
           Serial.print("T"+String(i)+":"+String(temperatura[i]));   
            methat_display.drawString(0, 20,"T:"+String(i)+":"+String(temperatura[i])); 
         }
       }
      }
    else{
               Serial.print("No hay ningun sensor de Temperatura conectado");   
            methat_display.drawString(0, 20,"ST CONECT:0"); 
        }*/
}

/*void WIFISetUp(void)
{
  
    uint64_t chipid = ESP.getEfuseMac(); // The chip ID is essentially its MAC address(length: 6 bytes).
  uint16_t chip = (uint16_t)(chipid >> 32);
  char devID[40];
  
  //snprintf(devID, 40, "%04X%08X", chip, (uint32_t)chipid);
  

  
    const char* ssid = devID;
    

const char* password = "12345678";
IPAddress local_IP(192,168,4,22);
IPAddress gateway(192,168,4,9);
IPAddress subnet(255,255,255,0);
  Serial.println(WiFi.softAP(ssid,password) ? "Ready" : "Failed!");
    Serial.print("Soft-AP IP address = ");
  Serial.println(WiFi.softAPIP());
}*/

void OnTxDone( void )
{
	Serial.println("TX realizado");
	lora_idle = true;
}

void OnTxTimeout( void )
{
    Radio.Sleep( );
    Serial.println("TX fuera de tiempo");
    lora_idle = true;
}
