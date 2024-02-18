-- -----------------------------------------------------------------------------
--
--              SCRIPT INSERTION DES DONNEES
--
-- -----------------------------------------------------------------------------

-- Insertion de données dans la table EMPLOYE
INSERT INTO EMPLOYE VALUES (1, 'Dupont', 'Jean', 'Manager', '123 Rue de la République', '1234567890', 'jean.dupont@email.com');
INSERT INTO EMPLOYE VALUES (2, 'Martin', 'Sophie', 'Assistant', '456 Avenue des Fleurs', '9876543210', 'sophie.martin@email.com');
INSERT INTO EMPLOYE VALUES (3, 'Dubois', 'Pierre', 'Technicien', '789 Rue du Commerce', '4567890123', 'pierre.dubois@email.com');
INSERT INTO EMPLOYE VALUES (4, 'Lefevre', 'Marie', 'Secrétaire', '321 Boulevard Principal', '7890123456', 'marie.lefevre@email.com');
INSERT INTO EMPLOYE VALUES (5, 'Moreau', 'Luc', 'Ingénieur', '654 Avenue Centrale', '0123456789', 'luc.moreau@email.com');

-- Insertion de données dans la table HORAIRE
INSERT INTO HORAIRE VALUES (1, '08:00', '12:00', TO_DATE('01/01/2023', 'DD/MM/YYYY'), TO_DATE('02/01/2023', 'DD/MM/YYYY'), 'Lundi');
INSERT INTO HORAIRE VALUES (2, '13:00', '17:00', TO_DATE('03/01/2023', 'DD/MM/YYYY'), TO_DATE('04/01/2023', 'DD/MM/YYYY'), 'Mardi');
INSERT INTO HORAIRE VALUES (3, '09:30', '14:30', TO_DATE('05/01/2023', 'DD/MM/YYYY'), TO_DATE('06/01/2023', 'DD/MM/YYYY'), 'Mercredi');
INSERT INTO HORAIRE VALUES (4, '10:00', '15:00', TO_DATE('07/01/2023', 'DD/MM/YYYY'), TO_DATE('08/01/2023', 'DD/MM/YYYY'), 'Jeudi');
INSERT INTO HORAIRE VALUES (5, '11:30', '16:30', TO_DATE('09/01/2023', 'DD/MM/YYYY'), TO_DATE('10/01/2023', 'DD/MM/YYYY'), 'Vendredi');

-- Insertion de données dans la table ITINERAIRE
INSERT INTO ITINERAIRE VALUES (1, 'Parcours A', 120, 'Port A', 'Port B');
INSERT INTO ITINERAIRE VALUES (2, 'Parcours B', 90, 'Port C', 'Port D');
INSERT INTO ITINERAIRE VALUES (3, 'Parcours C', 150, 'Port E', 'Port F');
INSERT INTO ITINERAIRE VALUES (4, 'Parcours D', 180, 'Port G', 'Port H');
INSERT INTO ITINERAIRE VALUES (5, 'Parcours E', 60, 'Port I', 'Port J');

-- Insertion de données dans la table RESERVATION
INSERT INTO RESERVATION VALUES (1, TO_DATE('01/02/2023', 'DD/MM/YYYY'), 2, 150.00, 'Payée');
INSERT INTO RESERVATION VALUES (2, TO_DATE('02/02/2023', 'DD/MM/YYYY'), 3, 200.50, 'Non payée');
INSERT INTO RESERVATION VALUES (3, TO_DATE('03/02/2023', 'DD/MM/YYYY'), 1, 100.00, 'Payée');
INSERT INTO RESERVATION VALUES (4, TO_DATE('04/02/2023', 'DD/MM/YYYY'), 4, 250.75, 'Payée');
INSERT INTO RESERVATION VALUES (5, TO_DATE('05/02/2023', 'DD/MM/YYYY'), 2, 120.50, 'Non payée');

-- Insertion de données dans la table PASSAGER
INSERT INTO PASSAGER VALUES (1, 'Leclerc', 'Anne', TO_DATE('15/05/1990', 'DD/MM/YYYY'), '789 Rue de la Liberté', 75000, '9876543210', 'anne.leclerc@email.com');
INSERT INTO PASSAGER VALUES (2, 'Garcia', 'Carlos', TO_DATE('20/07/1985', 'DD/MM/YYYY'), '456 Avenue des Artistes', 69000, '6543210987', 'carlos.garcia@email.com');
INSERT INTO PASSAGER VALUES (3, 'Wang', 'Mei', TO_DATE('10/12/1992', 'DD/MM/YYYY'), '123 Rue de la Joie', 67000, '1234567890', 'mei.wang@email.com');
INSERT INTO PASSAGER VALUES (4, 'Johnson', 'John', TO_DATE('05/03/1980', 'DD/MM/YYYY'), '654 Avenue du Bonheur', 68000, '7890123456', 'john.johnson@email.com');
INSERT INTO PASSAGER VALUES (5, 'Dubois', 'Isabelle', TO_DATE('25/09/1988', 'DD/MM/YYYY'), '321 Boulevard de la Paix', 66000, '0123456789', 'isabelle.dubois@email.com');

-- Insertion de données dans la table TRAJET
INSERT INTO TRAJET VALUES (1, TO_DATE('01/02/2023', 'DD/MM/YYYY'));
INSERT INTO TRAJET VALUES (2, TO_DATE('02/02/2023', 'DD/MM/YYYY'));
INSERT INTO TRAJET VALUES (3, TO_DATE('03/02/2023', 'DD/MM/YYYY'));
INSERT INTO TRAJET VALUES (4, TO_DATE('04/02/2023', 'DD/MM/YYYY'));
INSERT INTO TRAJET VALUES (5, TO_DATE('05/02/2023', 'DD/MM/YYYY'));

-- Insertion de données dans la table VOYAGE_PASSAGER
INSERT INTO VOYAGE_PASSAGER VALUES (1, 1);
INSERT INTO VOYAGE_PASSAGER VALUES (2, 2);
INSERT INTO VOYAGE_PASSAGER VALUES (3, 3);
INSERT INTO VOYAGE_PASSAGER VALUES (4, 4);
INSERT INTO VOYAGE_PASSAGER VALUES (5, 5);

-- Insertion de données dans la table FACTURE
INSERT INTO FACTURE VALUES (1, TO_DATE('01/02/2023', 'DD/MM/YYYY'), 'Carte de crédit');
INSERT INTO FACTURE VALUES (2, TO_DATE('02/02/2023', 'DD/MM/YYYY'), 'Virement bancaire');
INSERT INTO FACTURE VALUES (3, TO_DATE('03/02/2023', 'DD/MM/YYYY'), 'PayPal');
INSERT INTO FACTURE VALUES (4, TO_DATE('04/02/2023', 'DD/MM/YYYY'), 'Espèces');
INSERT INTO FACTURE VALUES (5, TO_DATE('05/02/2023', 'DD/MM/YYYY'), 'Chèque');

-- Insertion de données dans la table FACTURE_PASSAGER
INSERT INTO FACTURE_PASSAGER VALUES (1, 1);
INSERT INTO FACTURE_PASSAGER VALUES (2, 2);
INSERT INTO FACTURE_PASSAGER VALUES (3, 3);
INSERT INTO FACTURE_PASSAGER VALUES (4, 4);
INSERT INTO FACTURE_PASSAGER VALUES (5, 5);

-- Insertion de données dans la table BATEAU
INSERT INTO BATEAU VALUES (1, 'Ocean Explorer', 200, 'Bateau de croisière de luxe');
INSERT INTO BATEAU VALUES (2, 'River Adventure', 150, 'Bateau fluvial avec vue panoramique');
INSERT INTO BATEAU VALUES (3, 'Island Hopper', 180, 'Bateau idéal pour explorer les îles');
INSERT INTO BATEAU VALUES (4, 'Sunset Serenity', 120, 'Bateau pour des croisières au coucher du soleil');
INSERT INTO BATEAU VALUES (5, 'Harbor Voyager', 160, 'Bateau moderne avec équipements haut de gamme');

-- Insertion de données dans la table HORAIRE_BATEAU
INSERT INTO HORAIRE_BATEAU VALUES (1, 1);
INSERT INTO HORAIRE_BATEAU VALUES (2, 2);
INSERT INTO HORAIRE_BATEAU VALUES (3, 3);
INSERT INTO HORAIRE_BATEAU VALUES (4, 4);
INSERT INTO HORAIRE_BATEAU VALUES (5, 5);

-- Insertion de données dans la table PASSAGE_BATEAU
INSERT INTO PASSAGE_BATEAU VALUES (1, 1);
INSERT INTO PASSAGE_BATEAU VALUES (2, 2);
INSERT INTO PASSAGE_BATEAU VALUES (3, 3);
INSERT INTO PASSAGE_BATEAU VALUES (4, 4);
INSERT INTO PASSAGE_BATEAU VALUES (5, 5);


