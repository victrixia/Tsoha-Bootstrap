-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO kotimaa (nimi,alue) VALUES ('Ranska', 'Vin de France');
INSERT INTO kotimaa (nimi,alue) VALUES ('Saksa', 'Mosel');
INSERT INTO kotimaa (nimi,alue) VALUES ('Italia', 'IGT Costa Toscana');

INSERT INTO viini (viinityyppi_id, kotimaa_id, nimi, vuosikerta, alkoholi, happo, makeus, uutos, kuvaus) VALUES (2,2,'Kissanpissa',2014,12.5,5,7,25, 'kamalanmakuinen pinot gris jossa on ihan liikaa kissanpissaa ja tammea');


INSERT INTO rypale(nimi,vari,kuvaus) VALUES ('Pinot Gris', 2, 'Perus maalaisrypäle, suosittu etenkin Alsacessa');
INSERT INTO rypale (nimi, vari, kuvaus) VALUES ('Pinot Noir', 1, 'Kevyitä, läpikuultavia, hapokkaita ja marjaisia viinejä');


INSERT INTO viinin_rypaleet(viini_id, rypale_id) VALUES (1,1);

INSERT INTO kayttaja(kayttajanimi,salasana,oikeanimi,kuvaus) VALUES ('annikainen','kekkonen1','Anna Maria', 'töttöröö');
INSERT INTO kayttaja(kayttajanimi,salasana,oikeanimi,kuvaus) VALUES ('testaaja','kekkonen1','Tsohan Assari', 'töttöröö');
