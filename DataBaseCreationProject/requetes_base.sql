-- -----------------------------------------------------------------------------
--
--              SCRIPT INTERROGATION DES DONNEES
--
-- -----------------------------------------------------------------------------

/**
    REQUETE 1 : 
    Liste des employ�s par poste
**/
SELECT Poste_Employe, COUNT(*) AS Nombre FROM EMPLOYE GROUP BY Poste_Employe;


/**
    REQUETE 2 : 
    Liste des passagers avec leur date de naissance
**/
SELECT Nom_Passager, Prenom_Passager, Date_de_Naissance_Passager FROM PASSAGER;


/**
    REQUETE 3 : 
    Liste des r�servations pay�es
**/
SELECT * FROM RESERVATION WHERE Statut_de_Paiement = 'Pay�e';


/**
    REQUETE 4 : 
    Liste des voyages passagers avec les d�tails du passager
**/
SELECT V.*, P.* FROM VOYAGE_PASSAGER V JOIN PASSAGER P ON V.ID_Passager = P.ID_Passager;


/**
    REQUETE 5 : 
    Liste des itin�raires avec une dur�e de balade sup�rieure � 150 minutes
**/
SELECT * FROM ITINERAIRE WHERE Duree_Balade > 150;


/**
    REQUETE 6 : 
    Liste des r�servations effectu�es le 1er f�vrier 2023
**/
SELECT * FROM RESERVATION WHERE Date_Reservation = TO_DATE('01/02/2023', 'DD/MM/YYYY');



/**
    REQUETE 7 : 
    Liste des factures avec un mode de paiement en esp�ces
**/
SELECT * FROM FACTURE WHERE Mode_de_Paiement = 'Esp�ces';


/**
    REQUETE 8 : 
    Liste des passagers n�s apr�s 1990
**/
SELECT * FROM PASSAGER WHERE EXTRACT(YEAR FROM Date_de_Naissance_Passager) > 1990;


/**
    REQUETE 9 : 
    Liste des trajets avec les d�tails des bateaux
**/
SELECT T.*, B.* FROM PASSAGE_BATEAU P JOIN TRAJET T ON P.ID_Trajet = T.ID_Trajet JOIN BATEAU B ON P.ID_Bateau = B.ID_Bateau;



/**
    REQUETE 10 : 
    Nombre total de r�servations non pay�es
**/
SELECT COUNT(*) AS Nombre FROM RESERVATION WHERE Statut_de_Paiement = 'Non pay�e';


/**
    REQUETE 11 : 
    Liste des employ�s par ordre alphab�tique de leur nom
**/
SELECT * FROM EMPLOYE ORDER BY Nom_Employe;



/**
    REQUETE 12 : 
    Liste des r�servations avec un prix total sup�rieur � 200
**/
SELECT * FROM RESERVATION WHERE Prix_Total > 200;


/**
    REQUETE 13 : 
    Liste des bateaux avec une capacit� maximale sup�rieure � 160 personnes
**/
SELECT * FROM BATEAU WHERE Capacite_Max > 160;


/**
    REQUETE 14 : 
    Liste des voyages passagers effectu�s le 2 f�vrier 2023
**/
SELECT V.* FROM VOYAGE_PASSAGER V JOIN TRAJET T ON V.ID_Trajet = T.ID_Trajet WHERE T.Date_Trajet = TO_DATE('02/02/2023', 'DD/MM/YYYY');



/**
    REQUETE 15 : 
    Liste des passagers ayant une adresse dont le code postal est 68000
**/
SELECT * FROM PASSAGER WHERE Code_Postal_Passager = 68000;



/**
    REQUETE 16 : 
    Liste des passagers ayant effectu� un voyage le 1er f�vrier 2023
**/
SELECT P.* FROM PASSAGER P JOIN VOYAGE_PASSAGER V ON P.ID_Passager = V.ID_Passager JOIN TRAJET T ON V.ID_Trajet = T.ID_Trajet WHERE T.Date_Trajet = TO_DATE('01/02/2023', 'DD/MM/YYYY');



/**
    REQUETE 17 : 
    Liste des factures �mises apr�s le 3 f�vrier 2023
**/
SELECT * FROM FACTURE WHERE Date_Paiement > TO_DATE('03/02/2023', 'DD/MM/YYYY');



/**
    REQUETE 18 : 
    Nombre total de passagers ayant r�serv� une balade de plus de 2 heures
**/
SELECT COUNT(DISTINCT P.ID_Passager) AS Nombre_Passagers FROM PASSAGER P JOIN VOYAGE_PASSAGER V ON P.ID_Passager = V.ID_Passager JOIN TRAJET T ON V.ID_Trajet = T.ID_Trajet JOIN ITINERAIRE I ON T.ID_Trajet = I.ID_Itineraire WHERE I.Duree_Balade > 120;



/**
    REQUETE 19 : 
    Liste des bateaux avec leurs horaires associ�s
**/
SELECT B.*, H.* FROM BATEAU B JOIN HORAIRE_BATEAU HB ON B.ID_Bateau = HB.ID_Bateau JOIN HORAIRE H ON HB.ID_Horaire = H.ID_Horaire;



/**
    REQUETE 20 : 
    Liste des employ�s dont le poste est "Manager" ou "Assistant"
**/
SELECT * FROM EMPLOYE WHERE Poste_Employe IN ('Manager', 'Assistant');



/**
    REQUETE 21 : 
    Liste des r�servations effectu�es par le passager avec l'ID 3 
**/
SELECT * FROM RESERVATION WHERE ID_Reservation IN (SELECT ID_Trajet FROM VOYAGE_PASSAGER WHERE ID_Passager = 3);


/**
    REQUETE 22 : 
    Liste des itin�raires tri�s par dur�e de balade d�croissante
**/
SELECT * FROM ITINERAIRE ORDER BY Duree_Balade DESC;



/**
    REQUETE 23 : 
    Liste des passagers ayant r�serv� une balade entre le 1er et le 4 f�vrier 2023
**/
SELECT DISTINCT P.* FROM PASSAGER P JOIN VOYAGE_PASSAGER V ON P.ID_Passager = V.ID_Passager JOIN TRAJET T ON V.ID_Trajet = T.ID_Trajet WHERE T.Date_Trajet BETWEEN TO_DATE('01/02/2023', 'DD/MM/YYYY') AND TO_DATE('04/02/2023', 'DD/MM/YYYY');




/**
    REQUETE 24 : 
    Liste des r�servations pay�es avec un prix total sup�rieur � 100, tri�es par date de r�servation d�croissante
**/
SELECT * FROM RESERVATION WHERE Statut_de_Paiement = 'Pay�e' AND Prix_Total > 100 ORDER BY Date_Reservation DESC;



/**
    REQUETE 25 : 
    Liste des employ�s qui ne sont pas des managers 
**/
SELECT * FROM EMPLOYE WHERE Poste_Employe != 'Manager';



/**
    REQUETE 26 : 
    Liste des trajets avec les d�tails des passagers ayant r�serv�, tri�e par date de trajet croissante
**/
SELECT T.*, P.* FROM TRAJET T 
JOIN VOYAGE_PASSAGER V ON T.ID_Trajet = V.ID_Trajet 
JOIN PASSAGER P ON V.ID_Passager = P.ID_Passager 
ORDER BY T.Date_Trajet ASC;



/**
    REQUETE 27 : 
    Liste des factures �mises avec un mode de paiement diff�rent de "Carte de cr�dit" :
**/
SELECT * FROM FACTURE WHERE Mode_de_Paiement != 'Carte de cr�dit';



/**
    REQUETE 28 : 
    Liste des bateaux avec leur capacit� maximale tri�e par capacit� maximale d�croissante
**/
SELECT * FROM BATEAU ORDER BY Capacite_Max DESC;



/**
    REQUETE 29 : 
    Liste des horaires associ�s aux bateaux ayant une capacit� maximale sup�rieure � 150 personnes
**/
SELECT H.* FROM HORAIRE_BATEAU HB 
JOIN BATEAU B ON HB.ID_Bateau = B.ID_Bateau 
JOIN HORAIRE H ON HB.ID_Horaire = H.ID_Horaire 
WHERE B.Capacite_Max > 150;


/**
    REQUETE 30 : 
    Liste des passagers ayant r�serv� une balade avec un itin�raire d'une dur�e inf�rieure � 90 minutes
**/
SELECT DISTINCT P.* FROM PASSAGER P 
JOIN VOYAGE_PASSAGER V ON P.ID_Passager = V.ID_Passager 
JOIN TRAJET T ON V.ID_Trajet = T.ID_Trajet 
JOIN ITINERAIRE I ON T.ID_Trajet = I.ID_Itineraire 
WHERE I.Duree_Balade < 90;


