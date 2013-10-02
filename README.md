imi_slotgallery
===============

Über
----

Die imi_slotgallery ist ein Inhaltselement für Contao (ab Version 3.0), welches eine Galerie mit mehreren
"Slots" zur Verfügung stellt. Die Bilder können im Backend einzeln oder über einen Ordner ausgewählt werden.
Im Frontend werden die Bilder per Zufall in die einzelnen "Slots" geladen. Dabei werden Dubletten vermieden.

Die Galerie kann über eigene Templates vollständig angepasst werden.
Einzelne "Slots" (Bilder) können mit `$this->slots[0]` ausgegeben werden.


Systemanforderungen
-------------------

 * Contao >= 3.0
 * MultiColumnWizard (https://github.com/menatwork/MultiColumnWizard)


Installation
------------

 * MultiColumnWizard per FTP oder aus dem Contao-ER unter system/modules/ installieren
 * imi_slotgallery per FTP oder aus dem Contao-ER unter system/modules/ installieren
 * Bei Installation per FTP muss über "Erweiterungsverwaltung" => "Datenbank aktualisieren" die Datenbank aktualisiert werden
