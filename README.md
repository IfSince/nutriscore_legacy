
# Voraussetzung
***
Um das Projekt ausführen zu können ist ein Web-Server notwendig.
Dieser kann beispielsweise mit [XAMPP](https://www.apachefriends.org/de/index.html) oder [MAMP](https://www.mamp.info/de/windows/)
bereitgestellt werden. Auf dem Server muss PHP installiert sein.

# Hinzufügen des Projekts
***
Nach Installation des Web-Servers muss das Projekt noch in dem hinterlegten Verzeichnis hinzugefügt werden.  
Für XAMPP ist dies standardmäßig das Verzeichnis **xampp/htdocs** oder **MAMP/htdocs** hinterlegt.

## Ändern des DocumentRoot für Apache
Das Projekt sollte auf der Top-Level-Domain laufen (localhost:80 statt localhost:80/my-project).  
Dafür in die Konfigurationsdatei **httpd.conf** (in XAMPP unter Apache -> Config -> httpd.conf) nach **htdocs** zu suchen und 
den dort hinterlegten Pfad anpassen, beispielsweise **"xampp/htdocs/my-project"**.

# Frontend Dependencies
***
Für das Installieren der Dependencies im Frontend ist [NodeJS](https://nodejs.org/en/) inkl. [npm](https://www.npmjs.com/) notwendig.
Anschließend können in der Konsole mit dem Befehl ```npm install``` alle Dependencies installiert werden.

## Tailwind
Für die Styles wird das CSS-Framework [Tailwind](https://tailwindcss.com/docs/installation) verwendet.
Mit dem in der **package.json** hinterlegten ```build-css``` Skript kann tailwind gestartet werden.
Dies ist nur notwendig, wenn die Styles der Seite angepasst werden sollen.
In jedem neu angelegten Template ist außerdem die von Tailwind generierte **dist/tailwind.css** einzubinden. 


# Backend Dependencies
***
Für das Installieren der Dependencies im Backend ist der Paketmanager [Composer](https://getcomposer.org/) notwendig.
Anschließend kann über das Terminal der Befehl ```composer install``` ausgeführt werden.

# Setup
***
Bevor das Projekt gestartet werden kann, muss zunächst die Datenbank importiert und konfiguriert werden.
Dafür muss die **.env.example** als **.env** kopiert werden und die Variablen müssen angepasst werden. 

# Öffnen des Projekts
***
Um das Projekt zu starten, muss der Apache Server gestartet werden. Anschließend kann das Projekt beispielsweise im 
Browser unter **localhost** geöffnet werden.

## Testdaten
### User inkl. erfassten Testdaten:
Username: mmustermann  
Passwort: Passwort123!

Beispiel Diary-Einträge erfasst am 27.02.

### Beispiele für Nahrungsmittel-Suche:
* Apple
* Banana
* Oatmeal
* Skyr
