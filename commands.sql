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
WHERE U.IsAdmin = false;