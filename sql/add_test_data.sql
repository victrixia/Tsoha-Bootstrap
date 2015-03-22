-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO viinityyppi (nimi) VALUES ('Punaviini');
INSERT INTO viinityyppi (nimi) VALUES ('Valkoviini');
INSERT INTO viinityyppi (nimi) VALUES ('Kuohuviini');
INSERT INTO viinityyppi (nimi) VALUES ('Roseeviini');
INSERT INTO viinityyppi (nimi) VALUES ('Jälkiruokaviini');
INSERT INTO viinityyppi (nimi) VALUES ('Shampanja');

INSERT INTO kotimaa (nimi,alue) VALUES ('Ranska', 'Vin de France');
INSERT INTO kotimaa (nimi,alue) VALUES ('Saksa', 'Mosel');
INSERT INTO kotimaa (nimi,alue) VALUES ('Italia', 'IGT Costa Toscana');

INSERT INTO rypale(nimi,vari,kuvaus) VALUES ('Pinot Gris', 'Valkoinen', 'Perus maalaisrypäle, suosittu etenkin Alsacessa');
INSERT INTO rypale (nimi, vari, kuvaus) VALUES ('Pinot Noir', 'Punainen', 'Kevyitä, läpikuultavia, hapokkaita ja marjaisia viinejä');

INSERT INTO viini (viinityyppi_id, kotimaa_id, nimi, vuosikerta, alkoholi, happo, makeus, uutos) VALUES (2,2,'Kissanpissa',2014,12.5,5,7,25);

INSERT INTO viinin_rypaleet(viini_id, rypale_id) VALUES (1,1);

INSERT INTO viinin_kuvaus(id,makeus,hapokkuus,tanniinisuus,taytelaisyys,kuvaus) VALUES (1,'Kuiva','Hapokas',null,null,null);

INSERT INTO kayttaja(kayttajanimi,salasana,oikeanimi,kuvaus) VALUES ('annikainen','kekkonen1','Anna Maria', 'töttöröö');

INSERT INTO kayttajan_viinit (viini_id, kayttaja_id) VALUES (1,1);
INSERT INTO kayttajan_rypaleet (rypale_id, kayttaja_id) VALUES (2,1);