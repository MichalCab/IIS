TRUNCATE TABLE Zoznam;
TRUNCATE TABLE Recept;
TRUNCATE TABLE Surovina;
TRUNCATE TABLE Pecivo;
TRUNCATE TABLE Objednavka;
TRUNCATE TABLE OblastRozvozu;
TRUNCATE TABLE Adresa;
TRUNCATE TABLE Clen;
TRUNCATE TABLE Stav;

INSERT INTO Clen VALUES(0,'admin','a',1,'ADM','Alex','Brzobohaty');
INSERT INTO Clen VALUES(0,'driver','a',1,'VOD','Jan','Novak');
INSERT INTO Clen VALUES(0,'pavel_novotny','a',1,'VOD','Pavel','Novotny');
INSERT INTO Clen VALUES(0,'customer','a',1,'ZAK','Jozef','Mrkvicka');
INSERT INTO Clen VALUES(0,'frantisek_svetly','a',0,'ZAK','Frantisek','Svetly');
INSERT INTO Clen VALUES(0,'matyas_krc','a',1,'ZAK','Matyas','Krc');
INSERT INTO Clen VALUES(0,'otakar_hluchy','a',1,'ZAK','Otakar','Hluchý');

INSERT INTO Adresa VALUES(0,NULL,(SELECT id FROM Clen WHERE login = 'otakar_hluchy'),'Tomkova 24, Brno');
INSERT INTO Adresa VALUES(0,NULL,(SELECT id FROM Clen WHERE login = 'customer'),'Mladi 245, Ostrava');
INSERT INTO Adresa VALUES(0,NULL,(SELECT id FROM Clen WHERE login = 'customer'),'Celni 290/3, Brno');
INSERT INTO Adresa VALUES(0,NULL,(SELECT id FROM Clen WHERE login = 'matyas_krc'),'Bezrucova 2, Brno');
INSERT INTO Adresa VALUES(0,NULL,(SELECT id FROM Clen WHERE login = 'matyas_krc'),'Jasenska 4, Praha');
INSERT INTO Adresa VALUES(0,NULL,(SELECT id FROM Clen WHERE login = 'matyas_krc'),'Divadelni 987/1, Praha');

INSERT INTO OblastRozvozu VALUES(0,'Brno Stred',(SELECT id FROM Clen WHERE login = 'driver'));
INSERT INTO OblastRozvozu VALUES(0,'Brno Kr. Pole',(SELECT id FROM Clen WHERE login = 'driver'));
INSERT INTO OblastRozvozu VALUES(0,'Brno Jih',(SELECT id FROM Clen WHERE login = 'pavel_novotny'));

INSERT INTO Objednavka VALUES(0,NULL,CURDATE(),11059.59,1,(SELECT id FROM Clen WHERE login = 'driver'),(SELECT id FROM Clen WHERE login = 'otakar_hluchy'),(SELECT id FROM Adresa WHERE adresa = 'Tomkova 24, Brno'));
INSERT INTO Objednavka VALUES(0,NULL,CURDATE(),1039.23,1,(SELECT id FROM Clen WHERE login = 'pavel_novotny'),(SELECT id FROM Clen WHERE login = 'customer'),(SELECT id FROM Adresa WHERE adresa = 'Mladi 245, Ostrava'));
INSERT INTO Objednavka VALUES(0,NULL,CURDATE(),7000.50,1,(SELECT id FROM Clen WHERE login = 'pavel_novotny'),(SELECT id FROM Clen WHERE login = 'customer'),NULL);
INSERT INTO Objednavka VALUES(0,NULL,CURDATE(),9089.20,1,(SELECT id FROM Clen WHERE login = 'driver'),(SELECT id FROM Clen WHERE login = 'matyas_krc'),(SELECT id FROM Adresa WHERE adresa = 'Bezrucova 2, Brno'));
INSERT INTO Objednavka VALUES(0,NULL,CURDATE(),13450.21,1,(SELECT id FROM Clen WHERE login = 'pavel_novotny'),(SELECT id FROM Clen WHERE login = 'matyas_krc'),(SELECT id FROM Adresa WHERE adresa = 'Jasenska 4, Praha'));
INSERT INTO Objednavka VALUES(0,NULL,CURDATE(),12000.00,0,(SELECT id FROM Clen WHERE login = 'driver'),(SELECT id FROM Clen WHERE login = 'matyas_krc'),NULL);
INSERT INTO Objednavka VALUES(0,NULL,CURDATE(),800.00,0,(SELECT id FROM Clen WHERE login = 'pavel_novotny'),(SELECT id FROM Clen WHERE login = 'otakar_hluchy'),NULL);

INSERT INTO Pecivo VALUES(0,'rohlik','bily rohlik',1.20,1);
INSERT INTO Pecivo VALUES(0,'chleb','kminovy chleb',28.50,1);
INSERT INTO Pecivo VALUES(0,'makovnik','tradicni od babicky',27.90,1);
INSERT INTO Pecivo VALUES(0,'bageta','dlouha bageta',8.20,1);
INSERT INTO Pecivo VALUES(0,'kobliha','cokoladova kobliha',12.20,1);

INSERT INTO Surovina VALUES(0,'mouka',1000.20,1200.6);
INSERT INTO Surovina VALUES(0,'cukr',1200.20,1000);
INSERT INTO Surovina VALUES(0,'vejce',2900,10000);
INSERT INTO Surovina VALUES(0,'kyprici prasek',300,56.5);
INSERT INTO Surovina VALUES(0,'maslo',70.50,85.2);
INSERT INTO Surovina VALUES(0,'mak',10,750.6);
INSERT INTO Surovina VALUES(0,'sul',150,645.5);
INSERT INTO Surovina VALUES(0,'mleko',25,980.2);
INSERT INTO Surovina VALUES(0,'cokolada',150,430.2);

INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'mouka'),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),0.01);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cukr'),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),0.02);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'vejce'),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),0.03);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'maslo'),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),0.01);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cokolada'),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),0.10);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'kyprici prasek'),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),0.50);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'maslo'),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),0.40);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cukr'),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),0.10);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'mouka'),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),0.30);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'sul'),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),0.10);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'vejce'),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),0.05);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cukr'),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),0.07);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'kyprici prasek'),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),0.01);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cokolada'),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),0.10);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'mouka'),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),0.20);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cokolada'),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),0.10);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cokolada'),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),0.02);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'kyprici prasek'),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),0.01);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'vejce'),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),0.02);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'mouka'),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),0.10);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cukr'),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),0.07);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'maslo'),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),0.03);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'vejce'),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),0.02);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'sul'),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),0.01);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'cokolada'),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),0.02);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'kyprici prasek'),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),0.10);
INSERT INTO Recept VALUES(0,(SELECT id FROM Surovina WHERE nazov = 'vejce'),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),0.04);

INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 11059.59),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),180);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 11059.59),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),190);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 11059.59),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),240);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 11059.59),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),10);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 11059.59),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),50);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 1039.23),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),180);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 1039.23),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),190);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 1039.23),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),240);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 1039.23),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),10);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 1039.23),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),50);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 7000.50),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),180);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 7000.50),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),190);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 7000.50),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),240);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 7000.50),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),10);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 7000.50),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),50);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 9089.20),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),180);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 9089.20),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),190);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 9089.20),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),240);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 9089.20),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),10);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 9089.20),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),50);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 13450.21),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),180);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 13450.21),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),190);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 13450.21),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),240);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 13450.21),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),10);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 13450.21),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),50);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 12000.00),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),180);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 12000.00),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),190);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 12000.00),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),240);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 12000.00),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),10);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 12000.00),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),50);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 800.00),(SELECT id FROM Pecivo WHERE nazov = 'rohlik'),180);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 800.00),(SELECT id FROM Pecivo WHERE nazov = 'chleb'),190);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 800.00),(SELECT id FROM Pecivo WHERE nazov = 'makovnik'),240);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 800.00),(SELECT id FROM Pecivo WHERE nazov = 'bageta'),10);
INSERT INTO Zoznam VALUES(0,(SELECT id FROM Objednavka WHERE suma = 800.00),(SELECT id FROM Pecivo WHERE nazov = 'kobliha'),50);
