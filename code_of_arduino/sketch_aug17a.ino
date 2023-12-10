
#include "BluetoothSerial.h"
#include "ELMduino.h"
#include <WiFi.h>
#include <HTTPClient.h>
#include<string.h>
BluetoothSerial SerialBT;
#define ELM_PORT   SerialBT
#define DEBUG_PORT Serial
ELM327 myELM327;
String BuildINString;
String WorkingString;
String WorkingStringB;
String WorkingStringC;
String WorkingStringB1;
String WorkingStringD;
String WorkingStringD1;
String WorkingStringE;
String WorkingStringF;
String WorkingStringG;
String WorkingStringH;
String WorkingStringI;
String WorkingStringL;
String WorkingStringM;
long B;
long BB;
long C;
long D;
long DD;
long E;
long F;
long G;
long H;
long I;
long L;
long M;
long A;
long DisplayValue;
long DisplayValue1;
long DisplayValue2;
long DisplayValue3;
long DisplayValue4;
long DisplayValue5;
long DisplayValue6;
long DisplayValue7;
long DisplayValue8;



byte inData;
char inChar;
String coolingTemp = "";
String RPM="";
String IMP="";
String MAF="";
String THP="";
String Speed="";
String Evap="";
String DPF="";
String FR="";



const char* ssid = "TheRock.CO";
const char* password =  "0597791295";
//const char* ssid = "Jehad";
//const char* password =  "123456789";
//const char* ssid = "Rayq caffe 2";
//const char* password =  "20002000";

void setup() {
DEBUG_PORT.begin(115200);

ELM_PORT.begin("ArduHUD", true);
  if (!ELM_PORT.connect("OBDII"))
  {DEBUG_PORT.println("Couldn't connect to OBD scanner - Phase 1");
    while(1); }
  if (!myELM327.begin(ELM_PORT))
  {Serial.println("Couldn't connect to OBD scanner - Phase 2");
    while (1); }
   Serial.println("Connected to ELM327");
   l:SerialBT.println("ATZ");
   delay(500);
    ReadData();
    if (BuildINString.substring(2,8)=="ELM327")
  {Serial.println("done the ELM Connection");
    SerialBT.println("0100");
     delay(500);}
  else
  goto l;

 
  
WiFi.begin(ssid, password);
while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi..");
  }

 Serial.println("Connected to the WiFi network");

}

void loop() {
 //***********************Start Read Cooling Temp****************************
 ll:BuildINString = "";  
  SerialBT.println("0105");  // pid cODE
  delay(250);
  ReadData();  
  WorkingString = BuildINString.substring(6,8);   
  A = strtol(WorkingString.c_str(),NULL,16);  //convert hex to decimnal
  DisplayValue = A;
   coolingTemp = String(DisplayValue - 40) ;  //eQUATION
  Serial.print("Cooling temp: "); Serial.println(coolingTemp);
  //***********************End Read Cooling Temp****************************
//***********************Start Read RPM****************************
BuildINString = "";
SerialBT.println("010C"); 
delay(250);
 ReadData();
 WorkingStringB = BuildINString.substring(6,8);
WorkingStringB1 = BuildINString.substring(9,11);
B = strtol(WorkingStringB.c_str(),NULL,16);  //convert hex to decimnal
BB = strtol(WorkingStringB1.c_str(),NULL,16);  //convert hex to decimnal

 DisplayValue1=(((B*256)+BB)/4);
 RPM =DisplayValue1;
Serial.print("RPM: "); Serial.println(RPM);

//***********************End Read RPM****************************
//*************************Start Intake msanufuld pressur Read**********************
BuildINString = "";
SerialBT.println("010B");
delay(250);

ReadData();
WorkingStringC = BuildINString.substring(6,8);
C = strtol(WorkingStringC.c_str(),NULL,16);
 IMP=C;
 Serial.print("intake manafuld pressure: "); Serial.println(IMP);
 

//********************End Intake msanufuld pressur Read**************************
//*************************Start MAF Read**********************
BuildINString = "";
SerialBT.println("0110");
delay(250);
 ReadData();
  WorkingStringD = BuildINString.substring(6,8);
WorkingStringD1 = BuildINString.substring(9,11);
D = strtol(WorkingStringB.c_str(),NULL,16);  
DD = strtol(WorkingStringB1.c_str(),NULL,16);
DisplayValue3=((256*D)+DD)/100;
MAF=DisplayValue3;
Serial.print("MAF: "); Serial.println(MAF);
 

//*************************End MAF Read**********************
//*************************Start TH position Read**********************
BuildINString = "";
SerialBT.println("0111");
delay(250);
 ReadData();
 WorkingStringE = BuildINString.substring(6,8);
 E=strtol(WorkingStringE.c_str(),NULL,16);
DisplayValue4=E;
THP=DisplayValue4;
Serial.print("Throttle position: "); Serial.println(THP);



//*************************End TH position Read**********************
//*************************Start Speed Read**********************
BuildINString = "";
SerialBT.println("010D");
delay(250);
 ReadData();
 WorkingStringF = BuildINString.substring(6,8);
 F=strtol(WorkingStringF.c_str(),NULL,16);
DisplayValue5=F;
Speed=DisplayValue5;
Serial.print("Vehicle Speed: "); Serial.println(Speed);



//*************************End Speed Read**********************
//***********************Start Read Evap. System Vapor Pressure****************************
BuildINString = "";
SerialBT.println("0132");
delay(250);
 ReadData();
 WorkingStringG = BuildINString.substring(6,8);
 WorkingStringH = BuildINString.substring(9,11);
 G=strtol(WorkingStringG.c_str(),NULL,16);
H=strtol(WorkingStringH.c_str(),NULL,16);
DisplayValue6=((256*G)+H)/4;
Evap=DisplayValue6;
Serial.print("Evap. System Vapor Pressure: "); Serial.println(Evap);


//*************************End Evap. System Vapor Pressure Read**********************
//***********************Start Read Diesel Particulate filter (DPF) temperature ****************************
BuildINString = "";
SerialBT.println("017C");
delay(250);
 ReadData();
 WorkingStringI = BuildINString.substring(6,8);
 WorkingStringL = BuildINString.substring(9,11);
 I=strtol(WorkingStringI.c_str(),NULL,16);
L=strtol(WorkingStringL.c_str(),NULL,16);
DisplayValue7=(((256*I)+L)/10)-40;
DPF=DisplayValue7;
Serial.print("Diesel Particulate filter (DPF) temperature : "); Serial.println(DPF);


//***********************End Read Diesel Particulate filter (DPF) temperature ****************************
//***********************Start Read Diesel Particulate filter (DPF) temperature ****************************
BuildINString = "";
SerialBT.println("015E");
delay(250);
 ReadData();
 WorkingStringM = BuildINString.substring(6,8);
 M=strtol(WorkingStringM.c_str(),NULL,16);
DisplayValue8=M;
FR=DisplayValue8;
Serial.print("Engine fuel rate: "); Serial.println(FR);
//***********************End Read Diesel Particulate filter (DPF) temperature ****************************
//**************************Sending live data *******************************************
  
   if ((WiFi.status() == WL_CONNECTED)) {
    HTTPClient http;
    http.begin("http://192.168.1.123/cars/public/external/addError/?car_id=5&value1=" + coolingTemp+"&value2="+RPM+"&value3="+IMP+"&value4="+MAF+"&value5="+THP+"&value6="+Speed+"&value7="+Evap+"&value8="+DPF+"&value9="+FR);
    
     Serial.print("sending the data to server");
     l:int httpCode = http.GET(); 
     if (httpCode > 0) { //Check for the returning code
 
        String payload = http.getString();
        //Serial.println(httpCode);
        Serial.println(payload);
        
        if(payload=="\"check\"")
       {
        Serial.print("Checking the Car");

SerialBT.println("03");
delay(1000);
ReadData();

String EC11=BuildINString.substring(3,5);
String EC12=BuildINString.substring(6,8);
String EC21=BuildINString.substring(9,11);
String EC22=BuildINString.substring(12,14);
String EC31=BuildINString.substring(15,17);
String EC32=BuildINString.substring(18,20);
String EC1="P"+EC11+EC12;
String EC2="P"+EC21+EC22;
String EC3="P"+EC31+EC32;
EC1.replace(" ","");
EC2.replace(" ","");
 EC3.replace(" ","");


 Serial.println(EC1+"   "+EC2+"    "+EC3);
 
HTTPClient http;
//Serial.print("http://taxinablus.com/cars/public/external/addError/?car_id=982357&value1=P0100&value2="+EC2+"&value3="+EC3+"&value4="+EC71+"&value5="+EC72+"&value6="+EC73);

    http.begin("http://taxinablus.com/cars/public/external/addError/?car_id=982357&value1="+EC1+"&value2="+EC2+"&value3="+EC3);
 Serial.println(" sending check data to server");
        //Check for the returning code
        //delay(5000);
         if (httpCode > 0) { //Check for the returning code
 
        String payload = http.getString();
       // Serial.println(httpCode);
        //Serial.println(payload);
        
      int httpCode = http.GET();                                        
 
    
        
      }
 
     // Serial.print(payload);
        if(payload=="\"check\"")
        
        goto l;
        
        Serial.print(payload);
        
        
      
        
        
        
        
        }
        if(payload=="\"done\"")
        goto ll;
        
        
       SerialBT.println("04");
        Serial.print("Clear the car errors");
        delay(3000);
        goto l;
   
 http.end(); //Free the resources 
   //**************
        
     if (httpCode > 0) { //Check for the returning code
 
        String payload = http.getString();
       // Serial.println(httpCode);
        //Serial.println(payload);
        
      int httpCode = http.GET();   
       if(payload=="\"check1\"\"check1\"\"check1\""|| payload=="\"check1\"\"check1\""||payload=="\"check1\"")
        {SerialBT.println("04");
        Serial.print("Clear the car errors");
        delay(3000);
        goto l;
        }                                     
 
    
        
      }
 
  
        }
     else
     {Serial.print("Error in HTTP");}

 
    http.end(); //Free the resources
  
 
  delay(1000);
  
  
  
  
  
  
  
  
  
  
  
  }

        


   
 

  








}
void ReadData()
{
BuildINString="";  
  while(SerialBT.available() > 0)
  {
    inData=0;
    inChar=0;
    inData = SerialBT.read();
    inChar=char(inData);
    BuildINString = BuildINString + inChar;
  } }
  
