# IoT Projekti

#### Ryhmätyö: Roope, Leo, David

### 12.9.2022 Projektin suunnitelma

Koko hommaa vasta suunnitellaan, teen figman kautta figjamissa.

![alt text](https://github.com/RoopeKoskelo/IoT-projekti/blob/main/IoT%20suunnitelma.png?raw=true)

![alt text](https://github.com/RoopeKoskelo/IoT-projekti/blob/main/Kaavio.drawio.png?raw=true)

Saatiin Raspbi toimimaan, vielä pitää serveri saada siihen. Käyttöjärjestelmän asennus meni ilman ongelmia.

SFTP protokollaa ei saada laitettua rasbpiin, mutta se ei ole vissiin pakollinen ainakaan vielä.

Toiselta koneelta ei päästä sivulle vielä.

Raspbissa on nyt PIR-anturi kiinni jo.

### 13-19.9.2022 
olin kipeenä

### 20.9.2022
Katsottiin läpi raspberry pi:n terminaalikomentoja.

### 21.9.2022
Tehdään käyttöliittymää Python kielellä Tkinterin avulla. Saimme tekstikentän ja napit toimimaan, sain myös tehtyä "Self Destruct" napin joka sulkee scriptin nappia painaessa.

Tein myös värinvaihtonapit, jotta saat vaihdettua teeman tummaksi tai vaaleaksi.

### 22.9.2022 Testit
#### 1. Tietokannat
a) Tietokantoja on DAVID_LIIKE, LAHTI, LEO_LIIKE, LIIKE, information_schema, mysql, performance_schema, komennolla show databases;

b) Taulun tiedot löytyvät komennolla describe <taulukon nimi>.   komennot menivät SHOW databases; -> USE <tietokannan nimi> -> SHOW tables; -> SELECT * FROM <taulukon nimi> -> DESCRIBE <taulukon nimi>
  
#### 2. String- ja muuttujaharjoitus
a)
  ```
  import time
  import datetime
  import mariadb
  import RPi.GPIO as GPIO
  
  InputPin = 4
  
  GPIO.setmode(GPIO.BCM)
  GPIO.setup(4, GPIO.IN)
  
  
  conn = mariadb.connect(user="root", password="kissa123", host="localhost", database="LIIKE")
  cur = conn.cursor()
  
  
  try:
      while True:
           arvo = GPIO.input(InputPin)    # tekee inputin arvosta muuttujan
  
           sqlStr = (f"INSERT INTO liike_tbl(arvo, aika) VALUES ({arvo}, now())")   # muutettu f-stringiksi

           time.sleep(5)
           cur.execute(sqlStr)
           conn.commit()
  except:
      print("ei toimi :(")
      print(arvo)
  
  conn.close
  ```
#### 26.9.2022 3. DHT11
  Sain DHT11 anturin toimimaan käyttämällä samaa koodia kuin ylempänä näkyy, koska huomasin että vikana ei ollut oma koodi vaan rikkinäinen anturi.

Katsoimme myös läpi HTML perusteita ja aloimme tekemään raspberrylle omaa sivua.

### 27.9.2022
Jatkamme HTML perusteita.

### 29.9.2022
Käymme tänään läpi PHP:tä, muutin aamulla tietokantaa ja koodia siten, että saan lämpöanturilta tietokantaan lämpötilan ja kosteuden tiedon.
Sain koodin lähettämään tiedot sivulle taulukkoon, python koodi ja sivun pohja löytyvät myös tästä repositorysta "DHT11_ROOPE" kansiosta.
  
### 3.10.2022
Asensimme koneille MySQL Workbenchin, jotta voi tehdä sivua ilman raspbia, mutta itse teen sivun suoraan raspberrylle.
