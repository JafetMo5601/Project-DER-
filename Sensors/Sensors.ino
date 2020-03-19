#include <DHT.h> 
#define DHTPIN 7 
#define DHTTYPE DHT11 

 
DHT dht(DHTPIN, DHTTYPE); 

void setup() {
  
Serial.begin(9600);
dht.begin(); 

}

void loop(){

  delay(3000);

  float h = dht.readHumidity(); 
  float t = dht.readTemperature(); 
  float f = dht.readTemperature(true);
  
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println("Error, there's no values!");
    return;
  }
 
  float hif = dht.computeHeatIndex(f, h); 
  float hic = dht.computeHeatIndex(t, h, false); 

  int MQ8_Value = analogRead(A0);

  float sensor_volt;
  float RS_gas; 
  float ratio; // 
  int sensorValue = analogRead(A1);
  sensor_volt=(float)sensorValue/1024*5.0;
  RS_gas = (5.0-sensor_volt)/sensor_volt; 
  ratio = RS_gas/0.40; 

  Serial.println();
  Serial.println();
  Serial.println();
  Serial.println();
  Serial.println();
  Serial.print("---- * Recognition System  * ----");
  Serial.println();
  Serial.println();
  Serial.print("  Humidity: ");
  Serial.print(h);
  Serial.print("% ");
  Serial.println();
  Serial.print("  Temperature: ");
  Serial.print(t);
  Serial.print("C° ");
  Serial.print(f);
  Serial.print("F°");
  Serial.println();
  Serial.print("  Heat Index : ");
  Serial.print(hic);
  Serial.print("C° ");
  Serial.print(hif);
  Serial.println("F°");  
  Serial.println();
  Serial.println("  Hydrogen Concentration: ");
  Serial.print("  ");
  Serial.print(MQ8_Value);
  Serial.print(" value");
  Serial.println();
  Serial.println();
  Serial.println("  CO2, CH4, LPG Concentration.");
  Serial.print("  Sensor V: ");
  Serial.println(sensor_volt);
  Serial.print("  RS Ratio: ");
  Serial.println(RS_gas);
  Serial.print("  Rs/RO: ");
  Serial.println(ratio);
  Serial.println();
  Serial.print("----- *UPDATING VALUES...* -----");
  Serial.println();
  Serial.println();
  Serial.println();
  Serial.println();
  Serial.println();
  
  
}
