# Tietokantasovelluksen esittelysivu

Yleisiä linkkejä:

* [Linkki sovellukseeni](http://amparkki.users.cs.helsinki.fi/viinisuositus)
* [Linkki dokumentaatiooni](https://www.github.com/victrixia/Tsoha-Bootstrap/tree/master/doc/dokumentaatio.pdf)

## Käynnistys/käyttöohje

Harjoitustyö löytyy ylläolevaa sovelluslinkkiä seuraamalla. Käytössä on tunnukset käyttäjänimi:tarkastaja, salasana: kekkonen1 (älä kysy). Sessiota on käytetty hyväksi lähinnä niin, että rypäleen lisäys ja muokkaus on mahdollista vain kirjautuneelle käyttäjälle. Lisäksi kirjautumisen näkee lähinnä siitä, että ylhäällä oikealla on ei mihinkään johtava 'kirjaudu ulos' -linkki. :P Sovellukseen voi toistaiseksi lisätä yksittäisiä viinejä ja rypäleitä, käyttäjän omia ei ole vielä toteutettu. 

Ylipäätään rypäleen toiminnot ovat pisimmällä, koska taulu on yksinkertaisempi ja helpompi saada toimimaan - php:n kanssa nollasta lähteminen on todella turhauttavaa ja hankalaa kun on tottunut rubyyn :((( 

## Työn aihe: Viinisuositus-websovellus

Järjestelmä muistuttaa itse asiassa jossain määrin valmiiden aiheiden drinkkiarkistoa. Tarkoitus on toteuttaa järjestelmä, josta voi hakea omaan makuunsa tai johonkin tiettyyn ruokalajiin sopivia viinejä ja niiden tarkkoja kuvauksia niiden tyypin, makeusasteen, käytettyjen rypäleiden ja muiden ominaisuuksien mukaan. Viineillä on myös kotimaa. Järjestelmä keskittyy nimenomaan viinirypäleestä käytettyjen juomien listaamiseen, eikä sisällä esim. Oluita tai juomasekoituksia. 

Kunnianhimoinen tavoite olisi luoda järjestelmä, jolla käyttäjä voi siis etsiä uusia suosikkeja tai ruokalajiinsa juuri sopivan viinin, ja systeemin automatisoinnista johtuen saada puolueettomia ideoita.

Viinejä voi myös hakea ainakin nimen, rypäleen, kotimaan ja tyypin mukaan listattuna.  Listat voi myös järjestää aakkosjärjestykseen. 

Viineihin liittyy myös yleistyyppiset ruokalajisuositukset. Ruokalajien kuvaukset eivät ole reseptimäisen pikkutarkkoja, vaan yleisluontoisia, esim. “Vitello Tonnato, vasikanleikettä tonnikalakastikkeella ja kapriksilla”. Ruokalajeihin liittyy ominaisuuksia, joiden perusteella niille suositellaan sopivia viinejä. Tällaisia ominaisuuksia ovat esimerkiksi tulisuus ja rasvaisuus. 

Järjestelmään kirjaudutaan sisään. Tavallinen käyttäjä voi hakea tietokannasta viinejä, ja hänelle ehdotetaan automaattisesti omiin suosikkeihin perustuen uusia viinejä, joita hän ei ole vielä merkinnyt maistetuksi. Käyttäjä voi myös ehdottaa uusien viinien ja ruokalajien sisällyttämistä listoille. Ylläpitäjäkäyttäjä hallinnoi muita käyttäjiä, sekä voi luoda uusia viinejä ja ruokalajeja joko alusta lähtien tai käyttäjien ehdotuksia hyväksymällä. Ylläpitäjä voi myös antaa muille käyttäjille rajoitettuja admin-oikeuksia (ehkä lähinnä uusien viinien tai ruokalajien lisäys). 


