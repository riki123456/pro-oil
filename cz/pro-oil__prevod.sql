VYROBCI
========================================================================================
INSERT INTO rk_vyrobce (id, nazev, alias, keywords, description, display, _rm_updated_by)
SELECT id, nazev, alias, keywords, description, display, 3
FROM test.vyrobci;

KONTAKTY 
========================================================================================
INSERT INTO rk_kontakty (id, name, mail, tel, position, poradi, _rm_updated_by)
SELECT id, name, mail, phone, position, 99, 3
FROM test.contacts;

SLIDESHOW
========================================================================================
INSERT INTO rk_slideshow (id, img, link, display, _rm_updated_by)
SELECT id, img, link, 1, 3 FROM test.slideshow;

PAGES - nepouzivat, mame jiz upravene html v pro-oil databazi
========================================================================================
INSERT INTO rk_pages (name, content, _rm_updated_by)
SELECT name, text, 3 FROM test.text;

KATEGORIE
========================================================================================
INSERT INTO rk_kategorie (id, nazev, alias, keywords, description, display, poradi, _rm_updated_by)
SELECT id, nazev, alias, keywords, description, 1, 99, 3 FROM test.kategorie

ITEMS
========================================================================================
-- !!! V DB MUSIM MIT DEFINOVANE FUNKCI toDigit()
/*
DROP FUNCTION IF EXISTS toDigit; 
DELIMITER | 
CREATE FUNCTION toDigit( str CHAR(32) ) RETURNS CHAR(16) 
BEGIN 
  DECLARE i, len SMALLINT DEFAULT 1; 
  DECLARE ret CHAR(32) DEFAULT ''; 
  DECLARE c CHAR(1); 
  SET len = CHAR_LENGTH( str ); 
  REPEAT 
    BEGIN 
      SET c = MID( str, i, 1 ); 
      IF c REGEXP '[[:digit:]]' THEN 
        SET ret=CONCAT(ret,c); 
      END IF; 
      SET i = i + 1; 
    END; 
  UNTIL i > len END REPEAT; 
  RETURN ret; 
END | 
DELIMITER ;
*/

INSERT INTO rk_polozka (id, kategorie_id, vyrobce_id, dostupnost_id, nazev, popis_kratky, popis_dlouhy, 
specifikace_sae, 
specifikace_api,
specifikace_acea,
specifikace_vyrobce,
cena_bez_dph, 
baleni_pocet, baleni_mj, 
page_main, page_akce, img, alias, keywords, _rm_updated_by)
SELECT id, kategorie, vyrobce, 1, nazev, kratky_popis, popis, 
SUBSTRING_INDEX(SUBSTRING_INDEX(specifikace, ',', 1), ',', -1),
SUBSTRING_INDEX(SUBSTRING_INDEX(specifikace, ',', 2), ',', -1),
SUBSTRING_INDEX(SUBSTRING_INDEX(specifikace, ',', 3), ',', -1),
SUBSTRING_INDEX(SUBSTRING_INDEX(specifikace, ',', 4), ',', -1),
cena, 
toDigit(baleni) as baleni_pocet, 
UPPER(REPLACE(baleni, toDigit(baleni), '')) as baleni_mj,
mainpage, akce, img, alias, keywords, 3 FROM test.zbozi;

ORDERS
========================================================================================
CREATE TEMPORARY TABLE temp 
as (
SELECT o.*, op.kod_zbozi, op.cena as cena_polozky, op.pocet, op.id_obj radek_id_obj, 
SUBSTRING(ou.jmeno, 1, LOCATE(' ', ou.jmeno)) jmeno, 
SUBSTRING(ou.jmeno, LOCATE(' ', ou.jmeno), LENGTH(ou.jmeno)) prijmeni,
ou.firma, ou.ico, ou.platce, ou.tel, ou.mail, ou.ulice, ou.mesto, ou.psc, ou.legal,
SUBSTRING(ou.djmeno, 1, LOCATE(' ', ou.djmeno)) djmeno, 
SUBSTRING(ou.djmeno, LOCATE(' ', ou.djmeno), LENGTH(ou.djmeno)) dprijmeni,
ou.dmail, ou.dtel, ou.dulice, ou.dmesto, ou.dpsc, ou.id id_obj_zakaznik,
z.nazev polozka_nazev, z.cena polozka_cena_bez_dph, (z.cena * 1.21) polozka_cena_s_dph, z.baleni polozka_baleni_mj
FROM test.objednavky o
left join test.objednavky_polozky op ON o.id = op.id_obj 
LEFT JOIN test.objednavky_uzivatele ou ON o.id = ou.id_obj
LEFT JOIN test.zbozi z ON op.kod_zbozi = z.kod_zbozi
);

INSERT INTO rk_objednavka_hlavicka
(id, doprava_nazev, doprava_cena_bez_dph, doprava_cena_s_dph, platba_cena_s_dph, platba_nazev, platba_cena_bez_dph,
cena_bez_dph, cena_s_dph, datum, stav, ciselna_rada, note)
select id, '', 0, 0, postovne, '', 0, cena, cena_dph, datum, 
CASE stav
    WHEN -1 THEN 3 #zruseno
    WHEN 0 THEN 1 #nova
    WHEN 1 THEN 2 #potvrzena
    ELSE -1
END stav, 
id_obj, note from temp
GROUP BY id, postovne, doprava, cena, cena_dph, datum, stav, id_obj, note;	

# -- objednavka radky
INSERT INTO rk_objednavka_radky (objednavka_id, 
polozka_dostupnost, polozka_nazev, polozka_cena_bez_dph, polozka_cena_s_dph, polozka_baleni_pocet, polozka_baleni_mj,
polozka_pocet)
SELECT radek_id_obj, 
'Skladem', polozka_nazev, polozka_cena_bez_dph, polozka_cena_s_dph, 0, polozka_baleni_mj,
pocet from temp WHERE polozka_nazev IS NOT NULL; 

# -- objednavka zakaznik
INSERT INTO rk_objednavka_zakaznik (id, objednavka_hlavicka_id, user_type, platce_dph, firma, ico)
SELECT id_obj_zakaznik, radek_id_obj, 
CASE
	WHEN legal = '' THEN 1 
	WHEN legal IS NULL THEN 1 
	WHEN legal = NULL THEN 1
	WHEN legal = 0 THEN 2
	WHEN legal = 1 THEN 3
	WHEN legal = 2 THEN 1
	ELSE legal
END legal, 
CASE
	WHEN platce = '' THEN 0 
	WHEN platce IS NULL THEN 0 
	WHEN platce = NULL THEN 0
	ELSE platce
END platce, 
firma, ico from temp WHERE id_obj_zakaznik IS NOT NULL 
GROUP BY radek_id_obj, legal, platce, firma, ico;

# -- objednavka zakaznik adresy - typ: hlavni
INSERT INTO rk_objednavka_zakaznik_adresy (objednavka_zakaznik_id, address_type, jmeno, prijmeni, email, telefon, ulice, mesto, psc, stat)
SELECT id_obj_zakaznik, 1, jmeno, prijmeni, mail, tel, ulice, mesto, psc, '' FROM temp WHERE id_obj_zakaznik IS NOT NULL
GROUP BY id_obj_zakaznik, 1, jmeno, prijmeni, mail, tel, ulice, mesto, psc;

# -- objednavka zakaznik adresy - typ: dodaci
INSERT INTO rk_objednavka_zakaznik_adresy (objednavka_zakaznik_id, address_type, jmeno, prijmeni, email, telefon, ulice, mesto, psc, stat)
SELECT id_obj_zakaznik, 2, djmeno, dprijmeni, dmail, dtel, dulice, dmesto, dpsc, '' FROM temp WHERE djmeno != '' AND dmail != ''
GROUP BY id_obj_zakaznik, 2, djmeno, dprijmeni, dmail, dtel, dulice, dmesto, dpsc;