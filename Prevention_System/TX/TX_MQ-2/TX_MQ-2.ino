#include <nRF24L01.h>
#include <RF24.h>
#include <RF24_config.h>
#include <SPI.h>

#define MQ1                       (0)     
#define RL_VALOR             (5)    
#define RAL       (9.83)
#define GAS_LP                      (0)
String inputstring = "";                                                        
float LPCurve[3]={2.3,0.21,-0.47};
float Ro=10;

int smoke[3];

RF24 radio(9,10);                        
const uint64_t pipe = 0xE8E8F0F0E1LL;    

void setup(void){
  
  Serial.begin(9600);
  Serial.println("Iniciando ...");
  Serial.print("Calibrando...\n");
  Ro = Calibracion(MQ1);                        
  Serial.print("Calibracion finalizada...\n");
  
  Serial.print("Ro=");
  Serial.print(Ro);
  Serial.print("kohm");
  Serial.print("\n");

  radio.begin();
  radio.openWritingPipe(pipe);
}
 
void loop(void){
  int s = porcentaje_gas(lecturaMQ(MQ1)/Ro,GAS_LP);
  Serial.print("LP:");
  Serial.print(s);
  Serial.print( "ppm" );
  Serial.print("    ");
  Serial.print("\n");
  delay(200);

  smoke[0] = s;
  radio.write(smoke, 3);
}
 
float calc_res(int raw_adc){
  return ( ((float)RL_VALOR*(1023-raw_adc)/raw_adc));
}
 
float Calibracion(float mq_pin){
  int i;
  float val=0;
    for (i=0;i<50;i++) {                                                                               
    val += calc_res(analogRead(mq_pin));
    delay(500);
  }
  val = val/50;                                                                                         
  val = val/RAL;
  return val;
}
 
float lecturaMQ(int mq_pin){
  int i;
  float rs=0;
  for (i=0;i<5;i++) {
    rs += calc_res(analogRead(mq_pin));
    delay(50);
  }
  rs = rs/5;
  return rs;
}
 
int porcentaje_gas(float rs_ro_ratio, int gas_id){
  if ( gas_id == GAS_LP ){
    return porcentaje_gas(rs_ro_ratio,LPCurve);
    }
    return 0;
}
 
int porcentaje_gas(float rs_ro_ratio, float *pcurve){
  return (pow(10, (((log(rs_ro_ratio)-pcurve[1])/pcurve[2]) + pcurve[0])));
}
