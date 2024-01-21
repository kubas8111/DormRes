-- Table: public.User

-- DROP TABLE IF EXISTS public."User";

CREATE TABLE IF NOT EXISTS public."User"
(
    "UserID" integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
    "Email" text COLLATE pg_catalog."default",
    "Password" text COLLATE pg_catalog."default",
    "isAdmin" boolean,
    CONSTRAINT "User_pkey" PRIMARY KEY ("UserID")
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."User"
    OWNER to root;
    
-- Table: public.UserData

-- DROP TABLE IF EXISTS public."UserData";

CREATE TABLE IF NOT EXISTS public."UserData"
(
    "UserID" integer NOT NULL,
    "Name" text COLLATE pg_catalog."default",
    "Surname" text COLLATE pg_catalog."default",
    "Telephone" text COLLATE pg_catalog."default",
    "StudentCardID" text COLLATE pg_catalog."default",
    CONSTRAINT "UserData_pkey" PRIMARY KEY ("UserID"),
    CONSTRAINT user_id_fk FOREIGN KEY ("UserID")
        REFERENCES public."User" ("UserID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."UserData"
    OWNER to root;

-- Table: public.Dormitory

-- DROP TABLE IF EXISTS public."Dormitory";

CREATE TABLE IF NOT EXISTS public."Dormitory"
(
    "DormitoryID" integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
    "Address" text COLLATE pg_catalog."default",
    "City" text COLLATE pg_catalog."default",
    "Postcode" text COLLATE pg_catalog."default",
    "Telephone" text COLLATE pg_catalog."default",
    CONSTRAINT "Dormitory_pkey" PRIMARY KEY ("DormitoryID")
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Dormitory"
    OWNER to root;

-- Table: public.Room

-- DROP TABLE IF EXISTS public."Room";

CREATE TABLE IF NOT EXISTS public."Room"
(
    "RoomID" integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
    "Roomcode" text COLLATE pg_catalog."default",
    "DormitoryID" integer,
    "Type" integer,
    "Floor" integer,
    CONSTRAINT "Room_pkey" PRIMARY KEY ("RoomID"),
    CONSTRAINT dormitory_id_fk FOREIGN KEY ("DormitoryID")
        REFERENCES public."Dormitory" ("DormitoryID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Room"
    OWNER to root;

-- Table: public.Reservation

-- DROP TABLE IF EXISTS public."Reservation";

CREATE TABLE IF NOT EXISTS public."Reservation"
(
    "ReservationID" integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
    "UserID" integer,
    "RoomID" integer,
    "Time" timestamp without time zone,
    CONSTRAINT "Reservation_pkey" PRIMARY KEY ("ReservationID"),
    CONSTRAINT room_id_fk FOREIGN KEY ("RoomID")
        REFERENCES public."Room" ("RoomID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT user_id_fk FOREIGN KEY ("UserID")
        REFERENCES public."User" ("UserID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Reservation"
    OWNER to root;


-- View UserDetailsView

CREATE VIEW UserDetailsView AS
SELECT 
    U.UserID, 
    U.Email, 
    UD.Name,
    UD.Surname,
    UD.Telephone,
    UD.StudentCardID
FROM "User" U
JOIN UserData UD ON U.UserID = UD.UserID
WHERE U.isAdmin = false;

-- DODAWANIE AKADEMIKOW

INSERT INTO "Dormitory" ("Address", "City", "Postcode", "Telephone")
VALUES
  ('ul. Akademicka 1', 'Kraków', '30-001', '+48 123 456 789'),
  ('ul. Uniwersytecka 5', 'Kraków', '30-002', '+48 987 654 321'),
  ('ul. Studencka 10', 'Kraków', '30-003', '+48 555 123 789'),
  ('ul. Naukowa 15', 'Kraków', '30-004', '+48 111 222 333'),
  ('ul. Wykładowa 20', 'Kraków', '30-005', '+48 999 888 777');

-- Akademik ID: 1, Adres: ul. Akademicka 1, Kraków

INSERT INTO "Room" ("Roomcode", "DormitoryID", "Type", "Floor")
VALUES
  -- Parter
  ('001', 1, 1, 0), ('002', 1, 1, 0), ('003', 1, 2, 0), ('004', 1, 2, 0),
  ('005', 1, 3, 0), ('006', 1, 3, 0), ('007', 1, 1, 0), ('008', 1, 2, 0),
  
  -- Piętro 1
  ('101', 1, 1, 1), ('102', 1, 1, 1), ('103', 1, 2, 1), ('104', 1, 2, 1),
  ('105', 1, 3, 1), ('106', 1, 3, 1), ('107', 1, 1, 1), ('108', 1, 2, 1),
  
  -- Piętro 2
  ('201', 1, 1, 2), ('202', 1, 1, 2), ('203', 1, 2, 2), ('204', 1, 2, 2),
  ('205', 1, 3, 2), ('206', 1, 3, 2), ('207', 1, 1, 2), ('208', 1, 2, 2),
  
  -- Piętro 3
  ('301', 1, 1, 3), ('302', 1, 1, 3), ('303', 1, 2, 3), ('304', 1, 2, 3),
  ('305', 1, 3, 3), ('306', 1, 3, 3), ('307', 1, 1, 3), ('308', 1, 2, 3),
  
  -- Piętro 4
  ('401', 1, 1, 4), ('402', 1, 1, 4), ('403', 1, 2, 4), ('404', 1, 2, 4),
  ('405', 1, 3, 4), ('406', 1, 3, 4), ('407', 1, 1, 4), ('408', 1, 2, 4);

-- Akademik ID: 2, Adres: ul. Uniwersytecka 5, Kraków

INSERT INTO "Room" ("Roomcode", "DormitoryID", "Type", "Floor")
VALUES
  -- Parter
  ('001', 2, 1, 0), ('002', 2, 1, 0), ('003', 2, 2, 0), ('004', 2, 2, 0),
  ('005', 2, 3, 0), ('006', 2, 3, 0),
  
  -- Piętro 1
  ('101', 2, 1, 1), ('102', 2, 1, 1), ('103', 2, 2, 1), ('104', 2, 2, 1),
  ('105', 2, 3, 1), ('106', 2, 3, 1),
  
  -- Piętro 2
  ('201', 2, 1, 2), ('202', 2, 1, 2), ('203', 2, 2, 2), ('204', 2, 2, 2),
  ('205', 2, 3, 2), ('206', 2, 3, 2),
  
  -- Piętro 3
  ('301', 2, 1, 3), ('302', 2, 1, 3), ('303', 2, 2, 3), ('304', 2, 2, 3),
  ('305', 2, 3, 3), ('306', 2, 3, 3),
  
  -- Piętro 4
  ('401', 2, 1, 4), ('402', 2, 1, 4), ('403', 2, 2, 4), ('404', 2, 2, 4),
  ('405', 2, 3, 4), ('406', 2, 3, 4),
  
  -- Piętro 5
  ('501', 2, 1, 5), ('502', 2, 1, 5), ('503', 2, 2, 5), ('504', 2, 2, 5),
  ('505', 2, 3, 5), ('506', 2, 3, 5),
  
  -- Piętro 6
  ('601', 2, 1, 6), ('602', 2, 1, 6), ('603', 2, 2, 6), ('604', 2, 2, 6),
  ('605', 2, 3, 6), ('606', 2, 3, 6),
  
  -- Piętro 7
  ('701', 2, 1, 7), ('702', 2, 1, 7), ('703', 2, 2, 7), ('704', 2, 2, 7),
  ('705', 2, 3, 7), ('706', 2, 3, 7);

-- Akademik ID: 3, Adres: ul. Studencka 10, Kraków

INSERT INTO "Room" ("Roomcode", "DormitoryID", "Type", "Floor")
VALUES
  -- Parter
  ('001', 3, 1, 0), ('002', 3, 1, 0), ('003', 3, 1, 0), ('004', 3, 1, 0),
  ('005', 3, 1, 0), ('006', 3, 1, 0), ('007', 3, 2, 0), ('008', 3, 2, 0),
  ('009', 3, 2, 0), ('010', 3, 2, 0), ('011', 3, 3, 0), ('012', 3, 3, 0),
  
  -- Piętro 1
  ('101', 3, 1, 1), ('102', 3, 1, 1), ('103', 3, 1, 1), ('104', 3, 1, 1),
  ('105', 3, 1, 1), ('106', 3, 1, 1), ('107', 3, 2, 1), ('108', 3, 2, 1),
  ('109', 3, 2, 1), ('110', 3, 2, 1), ('111', 3, 3, 1), ('112', 3, 3, 1),
  
  -- Piętro 2
  ('201', 3, 1, 2), ('202', 3, 1, 2), ('203', 3, 1, 2), ('204', 3, 1, 2),
  ('205', 3, 1, 2), ('206', 3, 1, 2), ('207', 3, 2, 2), ('208', 3, 2, 2),
  ('209', 3, 2, 2), ('210', 3, 2, 2), ('211', 3, 3, 2), ('212', 3, 3, 2),
  
  -- Piętro 3
  ('301', 3, 1, 3), ('302', 3, 1, 3), ('303', 3, 1, 3), ('304', 3, 1, 3),
  ('305', 3, 1, 3), ('306', 3, 1, 3), ('307', 3, 2, 3), ('308', 3, 2, 3),
  ('309', 3, 2, 3), ('310', 3, 2, 3), ('311', 3, 3, 3), ('312', 3, 3, 3),
  
  -- Piętro 4
  ('401', 3, 1, 4), ('402', 3, 1, 4), ('403', 3, 1, 4), ('404', 3, 1, 4),
  ('405', 3, 1, 4), ('406', 3, 1, 4), ('407', 3, 2, 4), ('408', 3, 2, 4),
  ('409', 3, 2, 4), ('410', 3, 2, 4), ('411', 3, 3, 4), ('412', 3, 3, 4);

-- Akademik ID: 4, Adres: ul. Naukowa 15, Kraków

INSERT INTO "Room" ("Roomcode", "DormitoryID", "Type", "Floor")
VALUES
  -- Parter
  ('001', 4, 1, 0), ('002', 4, 1, 0), ('003', 4, 1, 0), ('004', 4, 1, 0),
  ('005', 4, 1, 0), ('006', 4, 1, 0), ('007', 4, 2, 0), ('008', 4, 2, 0),
  ('009', 4, 2, 0), ('010', 4, 2, 0), ('011', 4, 3, 0), ('012', 4, 3, 0),
  
  -- Piętro 1
  ('101', 4, 1, 1), ('102', 4, 1, 1), ('103', 4, 1, 1), ('104', 4, 1, 1),
  ('105', 4, 1, 1), ('106', 4, 1, 1), ('107', 4, 2, 1), ('108', 4, 2, 1),
  ('109', 4, 2, 1), ('110', 4, 2, 1), ('111', 4, 3, 1), ('112', 4, 3, 1),
  
  -- Piętro 2
  ('201', 4, 1, 2), ('202', 4, 1, 2), ('203', 4, 1, 2), ('204', 4, 1, 2),
  ('205', 4, 1, 2), ('206', 4, 1, 2), ('207', 4, 2, 2), ('208', 4, 2, 2),
  ('209', 4, 2, 2), ('210', 4, 2, 2), ('211', 4, 3, 2), ('212', 4, 3, 2),
  
  -- Piętro 3
  ('301', 4, 1, 3), ('302', 4, 1, 3), ('303', 4, 1, 3), ('304', 4, 1, 3),
  ('305', 4, 1, 3), ('306', 4, 1, 3), ('307', 4, 2, 3), ('308', 4, 2, 3),
  ('309', 4, 2, 3), ('310', 4, 2, 3), ('311', 4, 3, 3), ('312', 4, 3, 3),
  
  -- Piętro 4
  ('401', 4, 1, 4), ('402', 4, 1, 4), ('403', 4, 1, 4), ('404', 4, 1, 4),
  ('405', 4, 1, 4), ('406', 4, 1, 4), ('407', 4, 2, 4), ('408', 4, 2, 4),
  ('409', 4, 2, 4), ('410', 4, 2, 4), ('411', 4, 3, 4), ('412', 4, 3, 4),
  
  -- Piętro 5
  ('501', 4, 1, 5), ('502', 4, 1, 5), ('503', 4, 1, 5), ('504', 4, 1, 5),
  ('505', 4, 1, 5), ('506', 4, 1, 5), ('507', 4, 2, 5), ('508', 4, 2, 5),
  ('509', 4, 2, 5), ('510', 4, 2, 5), ('511', 4, 3, 5), ('512', 4, 3, 5),
  
  -- Piętro 6
  ('601', 4, 1, 6), ('602', 4, 1, 6), ('603', 4, 1, 6), ('604', 4, 1, 6),
  ('605', 4, 1, 6), ('606', 4, 1, 6), ('607', 4, 2, 6), ('608', 4, 2, 6),
  ('609', 4, 2, 6), ('610', 4, 2, 6), ('611', 4, 3, 6), ('612', 4, 3, 6),
  
  -- Piętro 7
  ('701', 4, 1, 7), ('702', 4, 1, 7), ('703', 4, 1, 7), ('704', 4, 1, 7),
  ('705', 4, 1, 7), ('706', 4, 1, 7), ('707', 4, 2, 7), ('708', 4, 2, 7),
  ('709', 4, 2, 7), ('710', 4, 2, 7), ('711', 4, 3, 7), ('712', 4, 3, 7);

-- Akademik ID: 5, Adres: ul. Wykładowa 20, Kraków

INSERT INTO "Room" ("Roomcode", "DormitoryID", "Type", "Floor")
VALUES
  -- Parter
  ('001', 5, 1, 0), ('002', 5, 1, 0), ('003', 5, 1, 0), ('004', 5, 1, 0),
  ('005', 5, 1, 0), ('006', 5, 1, 0), ('007', 5, 2, 0), ('008', 5, 2, 0),
  ('009', 5, 2, 0), ('010', 5, 2, 0), ('011', 5, 3, 0), ('012', 5, 3, 0),
  
  -- Piętro 1
  ('101', 5, 1, 1), ('102', 5, 1, 1), ('103', 5, 1, 1), ('104', 5, 1, 1),
  ('105', 5, 1, 1), ('106', 5, 1, 1), ('107', 5, 2, 1), ('108', 5, 2, 1),
  ('109', 5, 2, 1), ('110', 5, 2, 1), ('111', 5, 3, 1), ('112', 5, 3, 1),
  
  -- Piętro 2
  ('201', 5, 1, 2), ('202', 5, 1, 2), ('203', 5, 1, 2), ('204', 5, 1, 2),
  ('205', 5, 1, 2), ('206', 5, 1, 2), ('207', 5, 2, 2), ('208', 5, 2, 2),
  ('209', 5, 2, 2), ('210', 5, 2, 2), ('211', 5, 3, 2), ('212', 5, 3, 2),
  
  -- Piętro 3
  ('301', 5, 1, 3), ('302', 5, 1, 3), ('303', 5, 1, 3), ('304', 5, 1, 3),
  ('305', 5, 1, 3), ('306', 5, 1, 3), ('307', 5, 2, 3), ('308', 5, 2, 3),
  ('309', 5, 2, 3), ('310', 5, 2, 3), ('311', 5, 3, 3), ('312', 5, 3, 3),
  
  -- Piętro 4
  ('401', 5, 1, 4), ('402', 5, 1, 4), ('403', 5, 1, 4), ('404', 5, 1, 4),
  ('405', 5, 1, 4), ('406', 5, 1, 4), ('407', 5, 2, 4), ('408', 5, 2, 4),
  ('409', 5, 2, 4), ('410', 5, 2, 4), ('411', 5, 3, 4), ('412', 5, 3, 4),
  
  -- Piętro 5
  ('501', 5, 1, 5), ('502', 5, 1, 5), ('503', 5, 1, 5), ('504', 5, 1, 5),
  ('505', 5, 1, 5), ('506', 5, 1, 5), ('507', 5, 2, 5), ('508', 5, 2, 5),
  ('509', 5, 2, 5), ('510', 5, 2, 5), ('511', 5, 3, 5), ('512', 5, 3, 5),
  
  -- Piętro 6
  ('601', 5, 1, 6), ('602', 5, 1, 6), ('603', 5, 1, 6), ('604', 5, 1, 6),
  ('605', 5, 1, 6), ('606', 5, 1, 6), ('607', 5, 2, 6), ('608', 5, 2, 6),
  ('609', 5, 2, 6), ('610', 5, 2, 6), ('611', 5, 3, 6), ('612', 5, 3, 6),
  
  -- Piętro 7
  ('701', 5, 1, 7), ('702', 5, 1, 7), ('703', 5, 1, 7), ('704', 5, 1, 7),
  ('705', 5, 1, 7), ('706', 5, 1, 7), ('707', 5, 2, 7), ('708', 5, 2, 7),
  ('709', 5, 2, 7), ('710', 5, 2, 7), ('711', 5, 3, 7), ('712', 5, 3, 7);

-- Tworzenie użytkowników

-- Dodanie 25 użytkowników do tabeli User
INSERT INTO "User" ("Email", "Password", "IsAdmin") VALUES
('adam.kowalski@example.com', '$2y$10$8HJBzTelRHcRAkXvnl1O.OTCAKl/BoPJG0Xu/2fJjg4G24eLHOuBK', false),
('ewa.nowak@example.com', '$2y$10$5xpohs2X5AGjY2XUJxR8l.m9ORRYnj2YfiaRbbvVhfLZQ4a4hr04a', false),
('jan.majewski@example.com', '$2y$10$40Qx4XJ896HJvkpBjGiEFeF15UjxPJg3RWHEJAVVWgP2ABlsz9yJO', false),
('katarzyna.wisniewska@example.com', '$2y$10$uYU3vK6g6pMZP8GEEEHFAe3ILhqZ0Hf1D9oG.14q7ULWG1WSnHI3a', false),
('andrzej.kaczmarek@example.com', '$2y$10$Ohi62IeE.6uChnlwKupKVO9By3RBBGe5CliLEApXvlP8wXD7JS2hC', false),
('maria.krawczyk@example.com', '$2y$10$wij9ziazD4faO1pOUDCIAuU1R8dLgM45k7d341hgeWO8f3.a5S7EG', false),
('pawel.wozniak@example.com', '$2y$10$sV/.bEeI5VvHKRcZeSk3tulW5DfVtEhkYI5ABE5kDtFuB8M.//5n6', false),
('anna.lewandowska@example.com', '$2y$10$YCjh4B.2GH.xwO51FmP5Fug/M8psO7dzKBfI5Kf1vkhUWudfHUauS', false),
('tomasz.dabrowski@example.com', '$2y$10$eaWVdcnxPCLonTkO1tO8wuTtx0oMlJpcT/5PFfgaYWQvDRV/lefaG', false),
('malgorzata.szymanska@example.com', '$2y$10$aZc1uqjGYqE6hZCUSU0Xu.SkbXtWNI4q9w0N6IkKvJm0VlozZV1gC', false),
('krzysztof.jaworski@example.com', '$2y$10$P4.IQpdmGPF0oaUrruCVvOcKWWehCE7YjXcMBrHLlZNW.UAkc8crK', false),
('magdalena.wieczorek@example.com', '$2y$10$w.EGf35fYYjXFuKUOfUfHOFRuGt/NTkWP1Ek3PBri9sD1JZd9wbNi', false),
('rafal.jakubowski@example.com', '$2y$10$nbeL8spjXkUvFEgMPOCqTugRF7iAQV3yTylvLcyIwLTVltLzuLE3i', false),
('monika.zajac@example.com', '$2y$10$zzZ51aE2/FxQKq7u4xGOXefQ2UhHr3W01oTSY0S9eZ7dXv8zPob2C', false),
('grzegorz.krol@example.com', '$2y$10$8nwz0nGWraxGp5BBtrBy9uz845dLaMBBy0q0N.N0eZKHCWzgTCfm2', false),
('ewelina.piotrowska@example.com', '$2y$10$1hwm5DPH6HOB5iCrY.SrZuQIVnebYLifs6mYDrCXzWZiZ7q/ObZEi', false),
('jacek.nowakowski@example.com', '$2y$10$bVUFUXaEJC1QTPZSfIIFLeGB658JdDsVXS5orZd4C60t6GZcG9vva', false),
('natalia.mazur@example.com', '$2y$10$cQLM6fdWI7b3PlWoIALrgePZQFdRpgJngsNsGCovTAp2pNxotvXlO', false),
('patryk.kwiatkowski@example.com', '$2y$10$zVu.oAEfg.ipv6zI/Iqele.39fcAbFXacTWcsPsemUdMoxGgOlTFC', false),
('kamila.kubiak@example.com', '$2y$10$IBCXQJe9gHn9DjbMDJbl0u/PWQLjLvsShBWatWSNstl7S2obSzVxC', false)

INSERT INTO "UserData" ("UserID", "Name", "Surname", "Telephone", "StudentCardID") VALUES
(10, 'John', 'Doe', '+48 123 456 789', 'ABC123456'),
(11, 'Jane', 'Smith', '+48 987 654 321', 'DEF789012'),
(12, 'Michael', 'Johnson', '+48 555 123 789', 'GHI345678'),
(13, 'Emily', 'Brown', '+48 111 222 333', 'JKL901234'),
(14, 'Daniel', 'Wilson', '+48 999 888 777', 'MNO567890'),
(15, 'Olivia', 'Taylor', '+48 333 444 555', 'PQR123456'),
(16, 'Matthew', 'Anderson', '+48 666 777 888', 'STU789012'),
(17, 'Sophia', 'Thomas', '+48 111 222 333', 'VWX345678'),
(18, 'Aiden', 'Hill', '+48 444 555 666', 'YZA901234'),
(19, 'Grace', 'Baker', '+48 777 888 999', 'BCD567890'),
(20, 'Ethan', 'Miller', '+48 222 333 444', 'EFG123456'),
(21, 'Emma', 'Davis', '+48 555 666 777', 'HIJ789012'),
(22, 'Noah', 'Garcia', '+48 999 888 777', 'KLM345678'),
(23, 'Isabella', 'Martinez', '+48 333 444 555', 'NOP901234'),
(24, 'Liam', 'Lopez', '+48 666 777 888', 'QRS567890'),
(25, 'Mia', 'Harris', '+48 111 222 333', 'TUV123456'),
(26, 'Lucas', 'Clark', '+48 444 555 666', 'WXY789012'),
(27, 'Ava', 'Allen', '+48 777 888 999', 'ZAB345678'),
(28, 'Logan', 'Wright', '+48 222 333 444', 'CDE123456'),
(29, 'Ella', 'Adams', '+48 555 666 777', 'FGH789012');

INSERT INTO "Reservation" ("UserID", "RoomID")
SELECT generate_series(10, 29) AS "UserID", generate_series(4, 23) AS "RoomID";

-- Tworzenie funkcji
CREATE OR REPLACE FUNCTION set_reservation_time()
RETURNS TRIGGER AS $$
BEGIN
    NEW."Time" := NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Tworzenie wyzwalacza
CREATE TRIGGER set_reservation_time_trigger
BEFORE INSERT ON "Reservation"
FOR EACH ROW
EXECUTE FUNCTION set_reservation_time();

-- Tworzenie widoków

CREATE VIEW "UserDetails" AS
SELECT
    U."UserID",
    U."Email",
    D."Name",
    D."Surname",
    D."Telephone",
    D."StudentCardID"
FROM
    "User" U
JOIN
    "UserData" D ON U."UserID" = D."UserID";

CREATE VIEW "ReservationDetails" AS
SELECT
    R."ReservationID",
    U."UserID",
    U."Email",
    D."Name",
    D."Surname",
    D."Telephone",
    D."StudentCardID",
    RO."Roomcode",
    DOM."Address"
FROM
    "Reservation" R
JOIN
    "User" U ON R."UserID" = U."UserID"
JOIN
    "UserData" D ON R."UserID" = D."UserID"
JOIN
    "Room" RO ON R."RoomID" = RO."RoomID"
JOIN
    "Dormitory" DOM ON RO."DormitoryID" = DOM."DormitoryID";
