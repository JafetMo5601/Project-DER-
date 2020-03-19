import serial
import time

Arduino = serial.Serial("/dev/ttyACM0", 9600)

while True:
	Values = Arduino.readline()
	print(Values)
Arduino.close()

