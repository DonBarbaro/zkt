V zadani cislo 1 som vytvoril jednoduchu web stranku pomocou html, php ktorá je prepojena na databazu mysql.

Na spustenie webu potrebujeme docker. Ten si dalej podla návodu stiahne obraz web_php.

------Opis co aplikacia robi:-------

Jednoduchá webová aplikácia sa skladá z troch php súborov, ktore su ulozene v adresari /web/src : index php, udaje.php, connect_db.php
index.php 
- je uvodna stranka webu, ktora služi na jednoduchu registraciu uzivatela
- nachadzaju sa tam jednoduche polia pre meno, priezvysko, vek a pribuzenstvo
- pod poliami sa nachadzaju tlačidla, pre výpis z databázy
- po kliknuti na vypis sa prepneme do udaje.php

udaje.php
- jednoduchy php skript pre vypisovnie z databazy
- tlacidla pre vypis celej databazy alebo jednotlivych stlpcov

connect_db.php
- s tymto kodom sa pripajame na databazu
- ak databaza existuje pripoji sa na už vytvorenu databazu firma, ktora obsahuje tabulku rodina
- ak databaza neexistuje vytvori sa nova s nazvom firma a tabulkou rodina
- pri prvotnom vytvoreni sa automaticky do databazi vložia 3 osoby

------Opis virtualnych sieti a zvazkov, ktore aplikaca vyuziva:------

Siet: web_default
- tato siet funguje ako bridge 
- spaja 3 bežiace kontajnery : 1.) web_db_1
                               2.) web_php_1
                               3.) web_adminer_1
Zvazky: web_mysql_data
- do tohto zvazku sa ukladaju zaznamy z databazy aby nam pri zatvoreni kontajnerov data z tabulky nezmizli

------Opis konfiguracie kontajnerov:-------
Pre spustanie kontajnerov sa pouziva docker-compose
Pri vytvoreni obrazu sa pouziva subor dockerfile

Dockerfile:
- v tomto subore sa definuje na akej vezii php bude strana bezat cize php:7.4-apache apache je nas lokalny server
- dalej sa nainstaluju doplnky k php v tomto pripade mysqli

Docker-compose:
Tento subor ma za ulohu vytvorit z nasho obrazu jednotlive kontajnery
Prepoji ich pomocou virtualnej siete web_default.
Definuje na akých portoch vieme jednotlive kontajnere spustat pomocou prehliadaca
Definuje vytveranie zvazkov, odkial sa subory načitavaju

--------Zoznam pouzitych kontajnerov a ich strucny opis:--------

1.) web_adminer_1 (adminer)
- tento kontajner ma graficke rozhranie
- funguje ako spravca databaz
- pripojime sa pomocou: localhost:8080
- prihlasovacie meno: root
- prihlasovacie heslo: example
- databaza vynechame

2.) web_db_1 (mysql)
- databaza mysql

3.) web_php_1 (web_php)
- kontajner, na ktorom funguje webova aplikacia
- pripojime sa pomocou: localhost:80

---------Navod ako pripravit, spustit, pozastavit, a vymazat aplikaciu-------

1) Stiahneme si subory
2) Otvorime si prostredie WSL a nastavime sa na adresar Z1
3) Naprv pouzijeme prikaz ./prepare-app.sh - tento prikaz ma za ulohy vytvorit obraz web_php
4) Potom prikaz ./start-app.sh - tento prikaz nam z obrazu vytvori jednotlive kontajnery, ktore boli pomenovane vyssie
5) Prikaz ./stop-app.sh - ma za ulohu zastavit vsetky beziace kontajnery a vymazat ich
6) Prikaz ./remove-app.sh - vymaze vsetky pouzite obrazy a vymaze aj zvazky

-------Navod ako si pozriet aplikaciu na webovom prehliadaci--------

1) Otvorime si webovy prehliadac
2) Uistime sa ze nam vsetky kontajnery bezia
3) na localhost:80 si otvorime webovu aplikaciu a zadame potrebne udaje 
4) pomocou webovej aplikacie si skontrolujeme ci sa udaje zapisali do databazy

5)* Na localhost:8080 si otvorime graficke rozhranie databazy mysql pomocou adminer

*len ak chceme upravovat databazu = menit, mazat