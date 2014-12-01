--xcabmi00
--xmatej46

DROP TABLE ClenSystemu CASCADE CONSTRAINTS;
DROP TABLE Objednavka CASCADE CONSTRAINTS;
DROP TABLE Pecivo CASCADE CONSTRAINTS;
DROP TABLE Surovina CASCADE CONSTRAINTS;
DROP TABLE Adresa CASCADE CONSTRAINTS;
DROP TABLE OblastRozvozu CASCADE CONSTRAINTS;
DROP TABLE Recept CASCADE CONSTRAINTS;
DROP TABLE Seznam CASCADE CONSTRAINTS;
DROP TABLE Sidli CASCADE CONSTRAINTS;

DROP sequence clensystemu_id;
DROP sequence objednavka_id;
DROP sequence pecivo_id;
DROP sequence adresa_id;
DROP sequence oblastrozvozu_id;
DROP sequence surovina_id;

CREATE TABLE ClenSystemu (
id INTEGER,
prihlasovaci_jmeno VARCHAR(20) NOT NULL,
heslo VARCHAR(20) NOT NULL,
evidovan CHAR(1) NOT NULL,
typ_clena CHAR(3) NOT NULL,
jmeno VARCHAR(20) NOT NULL,
prijmeni VARCHAR(20) NOT NULL
); 

CREATE TABLE Objednavka (
id INTEGER,
termin_dodani DATE NOT NULL,
celkova_cena NUMERIC(7,2) NOT NULL CHECK(celkova_cena > 0) ,
vyrizeno CHAR(1) NOT NULL,
spracoval INTEGER NOT NULL,
podal INTEGER NOT NULL,
id_adresa INTEGER NOT NULL
); 

CREATE TABLE Pecivo (
id  INTEGER,
nazev VARCHAR(20) NOT NULL,
popis VARCHAR(255),
cena NUMERIC(5,2) NOT NULL CHECK(cena > 0)
); 

CREATE TABLE Surovina (
id  INTEGER,
nazev VARCHAR(20) NOT NULL,
nakupni_cena NUMERIC(7,2) NOT NULL CHECK(nakupni_cena > 0),
mnozstvi NUMERIC(8,3) NOT NULL CHECK(mnozstvi > 0)
); 

CREATE TABLE Adresa (
id INTEGER,
adresa VARCHAR(255) NOT NULL,
id_oblast_rozvozu INTEGER
); 

CREATE TABLE OblastRozvozu (
id INTEGER,
id_clen_systemu INTEGER 
);

CREATE TABLE Recept (
id_surovina INTEGER,
id_pecivo INTEGER,
mnozstvi NUMERIC(8,3) NOT NULL CHECK(mnozstvi > 0)
); 

CREATE TABLE  Seznam (
id_objednavka INTEGER,
id_pecivo INTEGER,
pocet INTEGER NOT NULL CHECK (pocet > 0)
); 

CREATE TABLE Sidli (
id_adresa INTEGER,
id_clen_systemu INTEGER
);

create sequence clensystemu_id;
create sequence objednavka_id;
create sequence pecivo_id;
create sequence adresa_id;
create sequence oblastrozvozu_id;
create sequence surovina_id;

ALTER TABLE ClenSystemu ADD CONSTRAINT PK_clen_systemu_id PRIMARY KEY (id);
ALTER TABLE Pecivo ADD CONSTRAINT PK_pecivo_id PRIMARY KEY (id);
ALTER TABLE Surovina ADD CONSTRAINT PK_surovina_id PRIMARY KEY (id);
ALTER TABLE OblastRozvozu ADD CONSTRAINT PK_oblast_rozvozu_id PRIMARY KEY (id);
ALTER TABLE Adresa ADD CONSTRAINT PK_adresa_id PRIMARY KEY (id);
ALTER TABLE Objednavka ADD CONSTRAINT PK_objednavka_id PRIMARY KEY (id);
ALTER TABLE Recept ADD CONSTRAINT PK_recept_id PRIMARY KEY (id_surovina,id_pecivo);
ALTER TABLE Seznam ADD CONSTRAINT PK_seznam_id_objednavka PRIMARY KEY (id_objednavka,id_pecivo);
ALTER TABLE Sidli ADD CONSTRAINT PK_sidli_id PRIMARY KEY (id_adresa,id_clen_systemu);
--ClenSystemu
ALTER TABLE ClenSystemu ADD CONSTRAINT UN_prihlasovaci_jmeno UNIQUE (prihlasovaci_jmeno);
--OblastRozvozu
ALTER TABLE OblastRozvozu ADD CONSTRAINT FK_oblast_rozv_id_clen_systemu FOREIGN KEY (id_clen_systemu) REFERENCES ClenSystemu(id) ON DELETE CASCADE;
--Adresa
ALTER TABLE Adresa ADD CONSTRAINT FK_adresa_id_oblast_rozvozu FOREIGN KEY (id_oblast_rozvozu) REFERENCES OblastRozvozu(id) ON DELETE CASCADE;
--Objednavka
ALTER TABLE Objednavka ADD CONSTRAINT FK_objednavka_spracoval FOREIGN KEY (spracoval) REFERENCES ClenSystemu(id) ON DELETE CASCADE;
ALTER TABLE Objednavka ADD CONSTRAINT FK_objednavka_podal FOREIGN KEY (podal) REFERENCES ClenSystemu(id) ON DELETE CASCADE;
ALTER TABLE Objednavka ADD CONSTRAINT FK_objednavka_id_adresa FOREIGN KEY (id_adresa) REFERENCES Adresa(id) ON DELETE CASCADE;

--Recept
ALTER TABLE Recept ADD CONSTRAINT FK_recept_id_surovina FOREIGN KEY (id_surovina) REFERENCES Surovina(id) ON DELETE CASCADE;
ALTER TABLE Recept ADD CONSTRAINT FK_recept_id_pecivo FOREIGN KEY (id_pecivo) REFERENCES Pecivo(id) ON DELETE CASCADE;
--Seznam
ALTER TABLE Seznam ADD CONSTRAINT FK_seznam_id_objednavka FOREIGN KEY (id_objednavka) REFERENCES Objednavka(id) ON DELETE CASCADE;
ALTER TABLE Seznam ADD CONSTRAINT FK_seznam_id_pecivo FOREIGN KEY (id_pecivo) REFERENCES Pecivo(id) ON DELETE CASCADE;
--Sidli
ALTER TABLE Sidli ADD CONSTRAINT FK_sidli_id_adresa FOREIGN KEY (id_adresa) REFERENCES Adresa(id) ON DELETE CASCADE;
ALTER TABLE Sidli ADD CONSTRAINT FK_sidli_id_clen_systemu FOREIGN KEY (id_clen_systemu) REFERENCES ClenSystemu(id) ON DELETE CASCADE;

INSERT INTO ClenSystemu VALUES(clensystemu_id.nextval,'jan_novak','123456','Y','RID','Jan','Novak');
INSERT INTO ClenSystemu VALUES(clensystemu_id.nextval,'jozef_mrkvicka','password','Y','ZAK','Jozef','Mrkvicka');
INSERT INTO ClenSystemu VALUES(clensystemu_id.nextval,'pavel_novotny','654321','Y','RID','Pavel','Novotny');
INSERT INTO ClenSystemu VALUES(clensystemu_id.nextval,'frantisek_svetly','heslo','N','ZAK','Frantisek','Svetly');
INSERT INTO ClenSystemu VALUES(clensystemu_id.nextval,'matyas_krc','heslo','Y','ZAK','Matyas','Krc');
INSERT INTO ClenSystemu VALUES(clensystemu_id.nextval,'otakar_hluchy','heslo','Y','ZAK','Otakar','Hluchý');
INSERT INTO ClenSystemu VALUES(clensystemu_id.nextval,'admin','ds5ad56s1d56a','Y','ADM','Alex','Brzobohaty');

INSERT INTO OblastRozvozu VALUES(oblastrozvozu_id.nextval,1);
INSERT INTO OblastRozvozu VALUES(oblastrozvozu_id.nextval,3);
INSERT INTO OblastRozvozu VALUES(oblastrozvozu_id.nextval,3);

INSERT INTO Adresa VALUES(adresa_id.nextval,'Tomkova 24, Brno',1);
INSERT INTO Adresa VALUES(adresa_id.nextval,'Mladi 245, Ostrava',2);
INSERT INTO Adresa VALUES(adresa_id.nextval,'Celni 290/3, Brno',1);
INSERT INTO Adresa VALUES(adresa_id.nextval,'Bezrucova 2, Brno',1);
INSERT INTO Adresa VALUES(adresa_id.nextval,'Jasenska 4, Praha',3);
INSERT INTO Adresa VALUES(adresa_id.nextval,'Divadelni 987/1, Praha',3);

INSERT INTO Objednavka VALUES(objednavka_id.nextval, TO_DATE('05-11-2013 11:04:31', 'dd-mm-yyyy hh24:mi:ss'),11059.59,'Y',3,2,6);
INSERT INTO Objednavka VALUES(objednavka_id.nextval, TO_DATE('05-11-2013 13:25:11', 'dd-mm-yyyy hh24:mi:ss'),1039.23,'Y',3,2,6);
INSERT INTO Objednavka VALUES(objednavka_id.nextval, TO_DATE('05-11-2013 18:49:12', 'dd-mm-yyyy hh24:mi:ss'),7000.50,'Y',1,2,1);
INSERT INTO Objednavka VALUES(objednavka_id.nextval, TO_DATE('14-02-2014 19:27:41', 'dd-mm-yyyy hh24:mi:ss'),9089.20,'Y',3,5,2);
INSERT INTO Objednavka VALUES(objednavka_id.nextval, TO_DATE('21-02-2014 18:07:42', 'dd-mm-yyyy hh24:mi:ss'),13450.21,'Y',1,5,3);
INSERT INTO Objednavka VALUES(objednavka_id.nextval, TO_DATE('11-03-2014 21:54:22', 'dd-mm-yyyy hh24:mi:ss'),12000.00,'N',3,5,4);
INSERT INTO Objednavka VALUES(objednavka_id.nextval ,TO_DATE('01-04-2014 20:24:49', 'dd-mm-yyyy hh24:mi:ss'),800.00,'N',3,2,5);

INSERT INTO Sidli VALUES(1,1);
INSERT INTO Sidli VALUES(2,2);
INSERT INTO Sidli VALUES(3,3);
INSERT INTO Sidli VALUES(4,4);
INSERT INTO Sidli VALUES(5,5);
INSERT INTO Sidli VALUES(6,6);

INSERT INTO Pecivo VALUES(pecivo_id.nextval,'rohlik','bily rohlik',1.20);
INSERT INTO Pecivo VALUES(pecivo_id.nextval,'chleb','kminovy chleb',28.50);
INSERT INTO Pecivo VALUES(pecivo_id.nextval,'makovnik','tradicni od babicky',27.90);
INSERT INTO Pecivo VALUES(pecivo_id.nextval,'bageta','dlouha bageta',8.20);
INSERT INTO Pecivo VALUES(pecivo_id.nextval,'kobliha','cokoladova kobliha',12.20);

INSERT INTO Surovina VALUES(surovina_id.nextval,'mouka',1000.20,1200.6);
INSERT INTO Surovina VALUES(surovina_id.nextval,'cukr',1200.20,1000);
INSERT INTO Surovina VALUES(surovina_id.nextval,'vejce',2900,10000);
INSERT INTO Surovina VALUES(surovina_id.nextval,'kyprici prasek',300,56.5);
INSERT INTO Surovina VALUES(surovina_id.nextval,'maslo',70.50,85.2);
INSERT INTO Surovina VALUES(surovina_id.nextval,'mak',10,750.6);
INSERT INTO Surovina VALUES(surovina_id.nextval,'sul',150,645.5);
INSERT INTO Surovina VALUES(surovina_id.nextval,'mleko',25,980.2);
INSERT INTO Surovina VALUES(surovina_id.nextval,'cokolada',150,430.2);

INSERT INTO Recept VALUES(1,1,0.01);
INSERT INTO Recept VALUES(3,1,0.02);
INSERT INTO Recept VALUES(5,1,0.03);
INSERT INTO Recept VALUES(7,1,0.01);
INSERT INTO Recept VALUES(8,1,0.10);
INSERT INTO Recept VALUES(1,2,0.50);
INSERT INTO Recept VALUES(3,2,0.40);
INSERT INTO Recept VALUES(7,2,0.10);
INSERT INTO Recept VALUES(8,2,0.30);
INSERT INTO Recept VALUES(1,3,0.10);
INSERT INTO Recept VALUES(2,3,0.05);
INSERT INTO Recept VALUES(3,3,0.07);
INSERT INTO Recept VALUES(4,3,0.01);
INSERT INTO Recept VALUES(6,3,0.10);
INSERT INTO Recept VALUES(8,3,0.20);
INSERT INTO Recept VALUES(1,4,0.10);
INSERT INTO Recept VALUES(3,4,0.02);
INSERT INTO Recept VALUES(4,4,0.01);
INSERT INTO Recept VALUES(7,4,0.02);
INSERT INTO Recept VALUES(8,4,0.10);
INSERT INTO Recept VALUES(1,5,0.07);
INSERT INTO Recept VALUES(2,5,0.03);
INSERT INTO Recept VALUES(3,5,0.02);
INSERT INTO Recept VALUES(4,5,0.01);
INSERT INTO Recept VALUES(5,5,0.02);
INSERT INTO Recept VALUES(8,5,0.10);
INSERT INTO Recept VALUES(9,5,0.04);

INSERT INTO Seznam VALUES(1,1,180);
INSERT INTO Seznam VALUES(1,2,190);
INSERT INTO Seznam VALUES(1,3,240);
INSERT INTO Seznam VALUES(2,1,10);
INSERT INTO Seznam VALUES(2,2,50);
INSERT INTO Seznam VALUES(2,3,150);
INSERT INTO Seznam VALUES(2,4,180);
INSERT INTO Seznam VALUES(3,1,90);
INSERT INTO Seznam VALUES(3,2,110);
INSERT INTO Seznam VALUES(3,3,180);
INSERT INTO Seznam VALUES(3,4,190);
INSERT INTO Seznam VALUES(4,1,120);
INSERT INTO Seznam VALUES(4,2,10);
INSERT INTO Seznam VALUES(5,3,10);
INSERT INTO Seznam VALUES(5,5,50);
INSERT INTO Seznam VALUES(6,5,70);
INSERT INTO Seznam VALUES(6,1,30);
INSERT INTO Seznam VALUES(6,4,15);
INSERT INTO Seznam VALUES(7,4,40);
INSERT INTO Seznam VALUES(7,5,120);
INSERT INTO Seznam VALUES(7,2,80);

--Seznam oblastí, které spravuje Pavel Novotný
SELECT o.id
FROM oblastrozvozu o
LEFT JOIN clensystemu cs ON cs.id = o.id_clen_systemu
WHERE cs.jmeno = 'Pavel' and cs.prijmeni = 'Novotny';

--Seznam vyřízených objednávek i se jmény objednavatelů
SELECT o.id, o.celkova_cena, o.termin_dodani, cs.jmeno, cs.prijmeni
FROM Objednavka o
LEFT JOIN  ClenSystemu cs  ON cs.id = o.podal
WHERE o.vyrizeno = 'Y';

-- Vypíše recept rohlíku
SELECT s.nazev, s.mnozstvi, p.nazev
FROM Surovina s
LEFT JOIN recept r ON r.id_surovina = s.id
LEFT JOIN pecivo p ON r.id_pecivo = p.id
WHERE p.nazev = 'rohlik';

-- Seznam objednaného pečiva podle množství 
SELECT p.nazev, g.pocet
FROM (
  SELECT s.id_pecivo, COUNT(s.id_objednavka) AS pocet
  FROM Seznam s
  GROUP BY s.id_pecivo) g
LEFT JOIN pecivo p ON g.id_pecivo = p.id
ORDER BY g.pocet DESC;

-- Minimální, maximální a průměrné množství použitých surovin v receptech.
SELECT s.nazev, g.mn as minimum, g.mx as maximum, ROUND(g.av, 2) as prumer 
FROM
  (SELECT r.id_surovina, MIN(r.mnozstvi) as mn, MAX(r.mnozstvi) as mx, AVG(r.mnozstvi) as av 
  FROM recept r
  GROUP BY r.id_surovina) g
LEFT JOIN surovina s ON g.id_surovina = s.id;

-- Seznam zákazníků, patřících do oblasti 1 nebo 3 seřazených sestupně podle příjmení.
SELECT cs.id, cs.prihlasovaci_jmeno ,cs.jmeno, cs.prijmeni
FROM ClenSystemu cs
WHERE cs.id IN (SELECT s.id_clen_systemu
FROM sidli s
WHERE s.id_adresa IN (SELECT a.id  
  FROM adresa a
  WHERE a.id_oblast_rozvozu = 1 or a.id_oblast_rozvozu = 3))
and cs.typ_clena = 'ZAK'
ORDER BY cs.prijmeni;

-- Vypíše seznam objednávek obsahující 100 a více rohlíků
SELECT o.id, o.termin_dodani, o.celkova_cena, cs.jmeno, cs.prijmeni
FROM objednavka o
LEFT JOIN clensystemu cs ON o.podal = cs.id
WHERE EXISTS(
  SELECT *
  FROM pecivo p 
  LEFT JOIN Seznam s ON s.id_pecivo = p.id
  WHERE s.id_objednavka = o.id and p.nazev = 'rohlik' and s.pocet >= 100);

CREATE INDEX pecivo_index ON pecivo (nazev);
CREATE INDEX surovina_index ON surovina (nazev);
  
COMMIT;  