import time
import RPi.GPIO as GPIO
import adafruit_dht
import psutil
import mariadb

for proc in psutil.process_iter():
    if proc.name() == "libgpiod_pulsein" or proc.name() == "libgpiod_pulsei":
        proc.kill()

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.cleanup()

dht = adafruit_dht.DHT11(pin=4)

conn = mariadb.connect(user="root", password="kissa123", host="localhost", database="ROOPE_DHT11")
cur = conn.cursor()
timeToSleep = 4

try:
    while True:
        temp = int(dht.temperature)
        moist = int(dht.humidity)
        
        send = (f"INSERT INTO DHT11(lampo, kosteus, aika) VALUES ({temp}, {moist}, now())")
        
        print(f"Lämpötila:{temp} Kosteus:{moist}")
        
        time.sleep(timeToSleep)
        cur.execute(send)
        conn.commit()   
except:
    print("ei toimi :(")
    dht.exit()
    
conn.close()