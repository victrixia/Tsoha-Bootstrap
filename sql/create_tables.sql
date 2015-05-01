
CREATE TABLE kotimaa (
  id   SERIAL PRIMARY KEY,
  nimi VARCHAR(50) NOT NULL,
  alue VARCHAR(100)
);



CREATE TABLE rypale (

  id       SERIAL PRIMARY KEY,
  nimi     VARCHAR(50) NOT NULL UNIQUE,
  vari     INTEGER NOT NULL,
  kuvaus   TEXT        NOT NULL

);

CREATE TABLE viini (
  id             SERIAL PRIMARY KEY,
  viinityyppi_id INT CHECK (viinityyppi_id > 0),
  kotimaa_id     INT REFERENCES kotimaa (id),
  nimi           VARCHAR(255)                  NOT NULL,
  vuosikerta     SMALLINT CHECK (vuosikerta > 1800),
  alkoholi       REAL CHECK (alkoholi >= 0) NOT NULL,
  happo          REAL CHECK (happo >= 0)    NOT NULL,
  makeus         SMALLINT CHECK (makeus >= 4), -- Makeus on joko 4g/l tai yli, muuten null
  uutos          REAL CHECK (uutos > 0),
  kuvaus         TEXT NOT NULL


);

CREATE TABLE viinin_rypaleet(
  viini_id INT REFERENCES viini(id) ON DELETE CASCADE ON UPDATE CASCADE,
  rypale_id INT REFERENCES rypale(id) ON DELETE CASCADE ON UPDATE CASCADE
  -- Tähän pitäisi jotenkin saada rajoite rypäleiden määrälle, mutta en osaa, enkä löydä ohjeita. Apua.

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




