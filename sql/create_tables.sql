-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE viinityyppi (
  id   SERIAL PRIMARY KEY,
  nimi VARCHAR(50) NOT NULL UNIQUE

);

CREATE TABLE kotimaa (
  id   SERIAL PRIMARY KEY,
  nimi VARCHAR(50) NOT NULL,
  alue VARCHAR(100)
);



CREATE TABLE rypale (

  id       SERIAL PRIMARY KEY,
  nimi     VARCHAR(50) NOT NULL UNIQUE,
  vari     VARCHAR(20) NOT NULL,
  kuvaus   TEXT        NOT NULL

);

CREATE TABLE viini (
  id             SERIAL PRIMARY KEY,
  viinityyppi_id INT REFERENCES viinityyppi (id),
  kotimaa_id     INT REFERENCES kotimaa (id),
  nimi           VARCHAR(255)                  NOT NULL,
  vuosikerta     SMALLINT CHECK (vuosikerta > 1800),
  alkoholi       DECIMAL CHECK (alkoholi >= 0) NOT NULL,
  happo          DECIMAL CHECK (happo >= 0)    NOT NULL,
  makeus         SMALLINT CHECK (makeus >= 4), -- Makeus on joko 4g/l tai yli, muuten null
  uutos          SMALLINT CHECK (uutos > 0)


);

CREATE TABLE viinin_rypaleet(
  viini_id INT REFERENCES viini(id) ON DELETE CASCADE ON UPDATE CASCADE,
  rypale_id INT REFERENCES rypale(id) ON DELETE CASCADE ON UPDATE CASCADE
  -- Tähän pitäisi jotenkin saada rajoite rypäleiden määrälle, mutta en osaa, enkä löydä ohjeita. Apua.

);

CREATE TABLE viinin_kuvaus(
  id INT REFERENCES viini(id),
  makeus  VARCHAR(30),
  hapokkuus VARCHAR(30),
  tanniinisuus VARCHAR(30),
  taytelaisyys VARCHAR(30),
  kuvaus         TEXT

);


CREATE TABLE kayttaja (
  id           SERIAL PRIMARY KEY,
  kayttajanimi VARCHAR(30)                             NOT NULL UNIQUE,
  salasana     VARCHAR(20)  NOT NULL,   -- Tän vois sit toteuttaa hashilla ku dedis ei hengitä niskaan koska tietoturva pls
  oikeanimi    VARCHAR(255),
  kuvaus       VARCHAR(500)

);

CREATE TABLE kayttajan_viinit(
  viini_id INTEGER REFERENCES viini(id) ON DELETE CASCADE ON UPDATE CASCADE,
  kayttaja_id INTEGER REFERENCES kayttaja(id) ON DELETE CASCADE ON UPDATE CASCADE

);

CREATE TABLE kayttajan_rypaleet(
  rypale_id INTEGER REFERENCES rypale(id) ON DELETE CASCADE ON UPDATE CASCADE,
  kayttaja_id INTEGER REFERENCES kayttaja(id) ON DELETE CASCADE ON UPDATE CASCADE

);




