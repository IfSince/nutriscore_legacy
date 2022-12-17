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
Für das Installieren der node_modules im Frontend ist [NodeJS](https://nodejs.org/en/) mit [npm](https://www.npmjs.com/) notwendig. Anschließend können in der Konsole mit dem Befehl **npm install** alle Dependencies installiert werden.

## Tailwind
Für die Styles wird das CSS-Framework [Tailwind](https://tailwindcss.com/docs/installation) verwendet. Wenn das Projekt nur lauffähig sein und nicht verändert werden soll, muss nichts dafür getan werden. Wenn die Styles verändert werden sollen, dann kann tailwind mit folgendem Befehl gestartet werden:   
**"npx tailwindcss -i public/assets/styles/tailwind.css -o public/assets/styles/dist/tailwind.css --watch --minify"**   


# Öffnen des Projekts
Um das Projekt zu starten, muss der Apache Server gestartet werden. Anschließend kann das Projekt beispielsweise im 
Browser unter **localhost** geöffnet werden.
