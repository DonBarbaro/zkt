--------David Ilas, Zaklady klaudovych technologii, 1.4.2021-------

Ku skuške som si pripravil zadanie cislo 2, vytvoril som jednoduchu web stranku pomocou html, php ktorá je prepojena na databazu mysql.

Na spustenie webu potrebujeme kubernets a účet na microsoft azure. 

------Opis co aplikacia robi:-------

Jednoduchá webová aplikácia sa skladá z troch php súborov, ktore su ulozene v image web_php:9 na dockerhube : index php, udaje.php, connect_db.php

-index.php

je uvodna stranka webu, ktora sluzi na jednoduchu registraciu uzivatela
nachadzaju sa tam jednoduche polia pre meno, priezvisko, vek a pribuzenstvo
pod poliami sa nachadzaju tlacidla, pre vypis z databazy
po kliknuti na vypis sa prepneme do udaje.php

-udaje.php

jednoduchy php skript pre vypisovnie z databazy
tlacidla pre vypis celej databazy alebo jednotlivych stlpcov

-connect_db.php

s tymto kodom sa pripajame na databazu
ak databaza existuje pripoji sa na už vytvorenu databazu firma, ktora obsahuje tabulku rodina
ak databaza neexistuje vytvori sa nova s nazvom firma a tabulkou rodina
pri prvotnom vytvoreni sa automaticky do databazi vložia 3 osoby zo suboru database.sql


--------Zoznam pouzitych kontajnerov a ich strucny opis:--------

1.) web_adminer_1 (adminer)

tento kontajner ma graficke rozhranie
funguje ako spravca databazy
pripojime sa pomocou: 20.82.213.212:8080
server: mysql
prihlasovacie meno: root
prihlasovacie heslo: root
databaza vynechame
2.) web_db_1 (mysql)

databaza mysql
3.) web_php_1 (web_php)

kontajner, na ktorom funguje webova aplikacia
pripojime sa pomocou: 20.82.213.36:80

---------Zoznam Kubernetes objektov a ich strucny opis-----------

1.) deplyment.yaml 
v tomto subore je uloženy deplyment k webu, admineru a mysql 
pri adminer a mysql je všetko nastavene defaultne 
mysql sa dalej odkazuje na PVC
web ma nastaveny image ares152/web_php:9 čo je image uloženy na dockerhube 

2.) service.yaml
v service su definovane pod akýmy meno a porotm su jednotlive služby dostupne 
web a adminer bežia ako Loadbalancer na porte 80 a 8080
mysql je typu ClusterIP

3.) statefulset.yaml
defunove persistent volume claim, ukladanie dat 

4.)ingress.yaml 
služi ako brana do adminer, aby bol spustitelny na internete

-------Slovný opis použitého verejného klaudu, služieb klaudu, Kubernetes alebo Docker objektov, trvalých zväzkov, databáz ktoré ste využili pri tvorbe nasadenia-----

Pre nasadenie do prostredia klaudu som použil klaudoveho poskytovateľa Microsoft Azure. 
Trvalý zväzok sa nachádza v súbore deployment.yaml a statefulset.yaml, použitý je pri databáze mysql kde sa odkazuje umiestnenie potrebných dát v prípade chybovosti aplikácie alebo uzla. 
Ako databázu som si vybral myslq, protože som sa s ňou stretol už v predchadzajúcich ročníkoch. Práca s nou je pomerne jednoduchá.
Pre sprácu databázy som použil adminer, ktorý je taktiež veľmi prehľadný.

---------Navod ako pripravit, spustit, pozastavit, a vymazat aplikaciu-------

1.) Stiahneme si subory
2.) Otvorime si prostredie WSL a nastavime sa na adresar sk1
3.) Naprv pouzijeme prikaz ./prepare-app.sh - tento prikaz ma za ulohy stiahnut obraz ares152/skuska_zktv1 a nasledne otovorit vybudovaný image
4.) Ak sa nadzádzame v bashovom prosterdí image-u prvotne aplikáciu spustime pomocou apríkazu ./start-app.sh ak je už aplikacia už na verejnom klaude vytvorená použijeme príkaz: az aks start --name zkt-skuska --resource-group zkt-skuska
5.)Prikaz ./stop-app.sh - ma za ulohu vymazat namespace skuska cim vymaze vsetky beziace sluzby

-------Podmieniky spustenia---------

Jednou z hlavých podmienok je existennica konta u kaludového poskytovateľa Microsoft Azure.
Pomocou prikazu prepare-app.sh si obraz nevytvoríme sami ale stiahneme si už existujúci obraz, ktorý je nakonfigurovaný a uložený na dockerhube

-------Navod ako si pozriet aplikaciu na webovom prehliadaci--------

Otvorime si webovy prehliadac
Uistime sa ze nam vsetky kontajnery bezia
na 20.82.213.36:80 si otvorime webovu aplikaciu a zadame potrebne udaje
pomocou webovej aplikacie si skontrolujeme ci sa udaje zapisali do databazy
5)* Na 20.82.213.212:8080 si otvorime graficke rozhranie databazy mysql pomocou adminer
server:mysql
meno:root
heslo:root

*len ak chceme upravovat databazu = menit, mazat

!!!Pri prvotnom spusteni webu si chybu : Error performing query ‘': You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ‘‘rodina’’ at line 1 NEVSIMAME!!!

VSETKO FUNGUJE!