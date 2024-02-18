-- -----------------------------------------------------------------------------
--
--              SCRIPT DE CREATION DES TABLES
--
-- -----------------------------------------------------------------------------


-- Création de la table EMPLOYE
CREATE TABLE EMPLOYE (
    ID_Employe INT PRIMARY KEY,
    Nom_Employe VARCHAR(255),
    Prenom_Employe VARCHAR(255),
    Poste_Employe VARCHAR(255),
    Adresse_Employe VARCHAR(255),
    Numero_de_Telephone_Employe VARCHAR(10) CHECK (REGEXP_LIKE(Numero_de_Telephone_Employe, '^\d{10}$')),
    Mail_Employe VARCHAR(255) CHECK (REGEXP_LIKE(Mail_Employe, '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,3}$'))
);

-- Création de la table HORAIRE
CREATE TABLE HORAIRE (
    ID_Horaire INT PRIMARY KEY,
    Heure_Depart VARCHAR2(5) CHECK (REGEXP_LIKE(Heure_Depart, '^\d{2}:\d{2}$')),
    Heure_Arrivee VARCHAR2(5) CHECK (REGEXP_LIKE(Heure_Arrivee, '^\d{2}:\d{2}$')),
    Date_Debut_Validite DATE,
    Date_Fin_Validite DATE,
    Jour_de_Semaine VARCHAR(20)
);

-- Création de la table ITINERAIRE
CREATE TABLE ITINERAIRE (
    ID_Itineraire INT PRIMARY KEY,
    Description_Itineraire VARCHAR(255),
    Duree_Balade INT,
    Lieu_Depart VARCHAR(255),
    Lieu_Arrivee VARCHAR(255)
);

-- Création de la table RESERVATION
CREATE TABLE RESERVATION (
    ID_Reservation INT PRIMARY KEY,
    Date_Reservation DATE,
    Nb_Voyageur INT,
    Prix_Total DECIMAL(10, 2) CHECK (Prix_Total >= 0),
    Statut_de_Paiement VARCHAR(20)
);

-- Création de la table PASSAGER
CREATE TABLE PASSAGER (
    ID_Passager INT PRIMARY KEY,
    Nom_Passager VARCHAR(255),
    Prenom_Passager VARCHAR(255),
    Date_de_Naissance_Passager DATE,
    Adresse_Passager VARCHAR(255),
    Code_Postal_Passager INT CHECK(Code_Postal_Passager >= 10000 AND Code_Postal_Passager <= 99999),
    Numero_de_Telephone_Passager VARCHAR(10) CHECK (REGEXP_LIKE(Numero_de_Telephone_Passager, '^\d{10}$')),
    Mail_Passager VARCHAR(255) CHECK (REGEXP_LIKE(Mail_Passager, '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,3}$'))
);


-- Création de la table VOYAGE_PASSAGER
CREATE TABLE TRAJET(
    ID_Trajet INT PRIMARY KEY,
    Date_Trajet Date
);

-- Création de la table VOYAGE_PASSAGER
CREATE TABLE VOYAGE_PASSAGER (
    ID_Trajet INT,
    ID_Passager INT,
    PRIMARY KEY (ID_Trajet, ID_Passager),
    FOREIGN KEY (ID_Trajet) REFERENCES TRAJET(ID_Trajet),
    FOREIGN KEY (ID_Passager) REFERENCES PASSAGER(ID_Passager)
);

-- Création de la table FACTURE
CREATE TABLE FACTURE (
    ID_Facture INT PRIMARY KEY,
    Date_Paiement DATE,
    Mode_de_Paiement VARCHAR(255)
);

-- Création de la table FACTURE_PASSAGER
CREATE TABLE FACTURE_PASSAGER (
    ID_Passager INT,
    ID_Facture INT,
    PRIMARY KEY (ID_Passager, ID_Facture),
    FOREIGN KEY (ID_Passager) REFERENCES PASSAGER(ID_Passager),
    FOREIGN KEY (ID_Facture) REFERENCES FACTURE(ID_Facture)
);

-- Création de la table BATEAU
CREATE TABLE BATEAU (
    ID_Bateau INT PRIMARY KEY,
    Nom_Bateau VARCHAR(255),
    Capacite_Max INT,
    Description_Bateau VARCHAR(255)
);

-- Création de la table HORAIRE_BATEAU
CREATE TABLE HORAIRE_BATEAU (
    ID_Bateau INT,
    ID_Horaire INT,
    PRIMARY KEY (ID_Bateau, ID_Horaire),
    FOREIGN KEY (ID_Bateau) REFERENCES BATEAU(ID_Bateau),
    FOREIGN KEY (ID_Horaire) REFERENCES HORAIRE(ID_Horaire)
);

-- Création de la table PASSAGE_BATEAU
CREATE TABLE PASSAGE_BATEAU (
    ID_Bateau INT,
    ID_Trajet INT,
    PRIMARY KEY (ID_Bateau, ID_Trajet),
    FOREIGN KEY (ID_Bateau) REFERENCES BATEAU(ID_Bateau),
    FOREIGN KEY (ID_Trajet) REFERENCES TRAJET(ID_Trajet)
);


