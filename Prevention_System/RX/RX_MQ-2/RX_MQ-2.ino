#include <nRF24L01.h>
#include <RF24.h>
#include <RF24_config.h>
#include <SPI.h>

int smoke[3];
RF24 radio(9,10);
const uint64_t pipe = 0xE8E8F0F0E1LL;

void setup(void){
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();
  
  Serial.println("******** Fire Detection System ********"); 
  Serial.println("*                                     *");
  Serial.println("*       Initializing System...        *");
  //Serial.println("*                                     *");
  //Serial.println("***************************************");
}
 
void loop(void){
  
  if (radio.available()){ 
    int done = radio.read(smoke, 3);
    int LP = smoke[0];
    
    Serial.println("*                                     *");
    Serial.print("*      Proportion of GLP: ");
    Serial.print(LP);
    Serial.print(" ppm.      * \n");
    Serial.println("*                                     *");
    Serial.println("*       ...Updating Values...         *");
    Serial.println("*                                     *");
    Serial.println("***************************************");
    delay(2000);
    }
}
