import serial
import time

Arduino = serial.Serial("/dev/ttyACM1", 9600)

while True:
	Values = Arduino.readline()
	print(Values)
Arduino.close()

