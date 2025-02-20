-- Table utilisateur
INSERT INTO utilisateur (nomUtilisateur, prenomUtilisateur, adressePostaleUtilisateur, adresseMailUtilisateur, passwordUser)
VALUES 
('Dupont', 'Pierre', '10 rue de la Paix, Paris', 'pierre.dupont@mail.com', 'password123'),
('Martin', 'Sophie', '22 avenue des Champs, Paris', 'sophie.martin@mail.com', 'password456'),
('Lemoine', 'Jacques', '45 boulevard Saint-Germain, Paris', 'jacques.lemoine@mail.com', 'password789'),
('Lemoine', 'Claire', '20 rue de la Liberte, Lyon', 'claire.lemoine@mail.com', 'password101'),
('Girard', 'Antoine', '78 rue de la Republique, Marseille', 'antoine.girard@mail.com', 'password112'),
('Bernard', 'Lucie', '10 rue des Acacias, Paris', 'lucie.bernard@mail.com', 'password131'),
('Hernandez', 'Carlos', '33 avenue des Ternes, Paris', 'carlos.hernandez@mail.com', 'password415'),
('Petit', 'Amelie', '12 place de lOpera, Paris', 'amelie.petit@mail.com', 'password161'),
('Roux', 'Eric', '25 rue de la Ville, Bordeaux', 'eric.roux@mail.com', 'password718'),
('Blanc', 'Nathalie', '44 rue du Faubourg Saint-Antoine, Paris', 'nathalie.blanc@mail.com', 'password920');

-- Table roles
INSERT INTO roles (nomRole)
VALUES 
('admin'),
('moderateur'),
('membre'),
('decideur'),
('assesseur'),
('scrutateur');

-- Table type_signalement
INSERT INTO type_signalement (nomTypeSignalement)
VALUES 
('Contenu offensant'),
('Spam'),
('Harclement'),
('Propos raciste'),
('Propos discriminant'),
('Propos violent'),
('Propos non pertinent'),
('Propos vulgaire'),
('Propos sectaire'),
('Propos haineux');

-- Table scrutin
INSERT INTO scrutin (nomScrutin)
VALUES 
('Scrutin majoritaire simple'),
('Scrutin majoritaire a deux tours'),
('Reponse Oui/Non');

-- Table groupe
INSERT INTO groupe (nomGroupe, descriptionGroupe, codeCouleur, pathImage)
VALUES 
('Citoyens Engages', 'un groupe test', '#FF0000', 'image.jpeg'),
('Ecologie Durable', 'un groupe test', '#FF0000', 'image.jpeg'),
('Innovation Sociale', 'un groupe test', '#FF0000', 'image.jpeg'),
('Solidarite Active', 'un groupe test', '#FF0000', 'image.jpeg'),
('Developpement Durable', 'un groupe test', '#FF0000', 'image.jpeg'),
('Education et Culture', 'un groupe test', '#FF0000', 'image.jpeg'),
('Justice Sociale', 'un groupe test', '#FF0000', 'image.jpeg'),
('Securite Publique', 'un groupe test', '#FF0000', 'image.jpeg'),
('Progres Technologique', 'un groupe test', '#FF0000', 'image.jpeg'),
('Reformes Sociales', 'un groupe test', '#FF0000', 'image.jpeg');

-- Table membre
INSERT INTO membre (idUtilisateur, idGroupe)
VALUES 
(1, 1), (1,2), (2, 1), (3, 2), (4, 2), (5, 3), (6, 3), (7, 4), (8, 4), (9, 5), (10, 5);

-- Table proposition
INSERT INTO proposition (nomProposition, descriptionProposition, idMembre, idGroupe)
VALUES 
('Education civique', 'Renforcer leducation civique dans les ecoles.', 1, 1),
('Transition energetique', 'Creer un fond pour les energies renouvelables.', 3, 2),
('Initiatives solidaires', 'Soutenir les projets de solidarite locale.', 5, 3),
('Revenu de base', 'Lancer un projet de revenu de base universel.', 7, 4),
('Infrastructures vertes', 'Augmenter les espaces verts urbains.', 9, 5),
('Accessibilite numerique', 'Ameliorer lacces a Internet pour tous.', 1, 6),
('Precarite energetique', 'Subventionner les renovations energetiques.', 2, 7),
('Marche local', 'Creer un marche public pour les producteurs locaux.', 4, 8),
('Droits des precaires', 'Ameliorer les conditions des travailleurs precaires.', 7, 9),
('Acces a la sante', 'Etendre la couverture sante dans les zones sensibles.', 9, 10);

-- Table commentaire
INSERT INTO commentaire (contenuCommentaire, idMembre, idProposition)
VALUES 
('Bien', 1, 1), 
('Interressant', 2, 2), 
('Daccord', 3, 3),
('Pas mal', 4, 4), 
('A discuter', 5, 5), 
('Excellente idee', 6, 6),
('A ameliorer', 7, 7), 
('Je soutiens', 8, 8), 
('Contre', 9, 9),
('Pas convaincu', 10, 10);

-- Table signalement
INSERT INTO signalement (motifSignalement, idProposition, idCommentaire, idMembre, numTypeSignalement)
VALUES 
('Contenu offensant', 1, 1, 2, 1), 
('Spam', 2, 2, 3, 2), 
('Harcelement', 3, 3, 4, 3), 
('Propos raciste', 4, 4, 5, 4),
('Propos discriminant', 5, 5, 6, 5), 
('Propos violent', 6, 6, 7, 6),
('Propos non pertinent', 7, 7, 8, 7), 
('Propos vulgaire', 8, 8, 9, 8),
('Propos sectaire', 9, 9, 10, 9),
('Propos haineux', 10, 10, 1, 10);

-- Table budget
INSERT INTO budget (budgetProposition) VALUES
(50000), (100000), (75000), (120000), (200000),
(80000), (90000), (150000), (60000), (110000);

-- Table theme
INSERT INTO theme (nomTheme, budgetThemeGlobal) VALUES
('Environnement', 500000), ('Sante', 300000), ('Education', 200000), ('Technologie', 1000000), ('Transport', 800000),
('Culture', 600000), ('Justice', 900000), ('Securite', 700000), ('Agriculture', 400000), ('Energie', 1200000);

-- Table caracterise
INSERT INTO caracterise (idProposition, numTheme) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
(6, 6), (7, 7), (8, 8), (9, 9), (10, 10);

-- Table a_pour_budget
INSERT INTO a_pour_budget (idProposition, idBudget) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
(6, 6), (7, 7), (8, 8), (9, 9), (10, 10);

-- Table a_pour_role
INSERT INTO a_pour_role (idMembre, idRole) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
(6, 1), (7, 2), (8, 3), (9, 4), (10, 5);

-- Table vote
INSERT INTO vote (choixVote, dureeVote, idMembre, numScrutin) VALUES
('Oui', 3600, 1, 3), ('Non', 7200, 2, 3), ('Oui', 1800, 3, 3), ('Non', 1500, 4, 3), ('Oui', 3000, 5, 3),
('Non', 4000, 6, 3), ('Oui', 2500, 7, 3), ('Non', 3500, 8, 3), ('Oui', 2200, 9, 3), ('Non', 2700, 10, 3);

INSERT INTO delibere (idProposition, idVote, nombreVotes) VALUES
(1, 1, 150), (2, 2, 200), (3, 3, 250), (4, 4, 4), (5, 5, 300),
(6, 6, 180), (7, 7, 220), (8, 8, 350), (9, 9, 270), (10, 10, 130);

INSERT INTO participe (idMembre, idVote) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
(6, 6), (7, 7), (8, 8), (9, 9), (10, 10);

INSERT INTO presente (idMembre, numScrutin) VALUES
(1, 1), (1, 2), (1, 3);

-- Table reaction
INSERT INTO reaction (emoticone) VALUES
('like'), ('dislike');

-- Table reagit
INSERT INTO reagit (idCommentaire, idReaction) VALUES
(1, 1), (2, 1), (3, 1), (4, 1), (5, 1),
(6, 2), (7, 2), (8, 2), (9, 2), (10, 1);

-- Table reagit_sur
INSERT INTO reagit_sur (idProposition, idReaction, nombreDeReaction) VALUES
(1, 1, 20), (2, 2, 30), (3, 1, 40), (4, 2, 10), (5, 1, 50),
(6, 2, 25), (7, 1, 35), (8, 2, 60), (9, 1, 28), (10, 1, 12);

-- Table invitation
INSERT INTO invitation (idGroupe, adresseMail, idRole)
VALUES 
(1, 'lucas@mail.com', 2),
(2, 'paul@mail.com', 3),
(3, 'agnes@mail.com', 4),
(4, 'marc@mail.com', 5),
(5, 'jean@mail.com', 1);

-- Table compose
INSERT INTO compose (idGroupe, numTheme) 
VALUES 
(1, 2),
(1, 3),
(2, 1),
(3, 4),
(3, 5);



-- Démo Décideur
INSERT INTO utilisateur(nomUtilisateur, prenomUtilisateur, adressePostaleUtilisateur, adresseMailUtilisateur, passwordUser) VALUES
('Ghannay', 'Sahar', '21 bis des Tuilipes', 'sahar.ghannay@mail.com', 'sahar123');

INSERT INTO groupe (nomGroupe, descriptionGroupe, codeCouleur, pathImage)
VALUES 
('Application JAVA', 'test', '#FF0000', 'image.jpeg');

INSERT INTO membre (idUtilisateur, idGroupe)
VALUES 
(11, 11);

INSERT INTO a_pour_role (idMembre, idRole) VALUES
(12, 4);

INSERT INTO proposition (nomProposition, descriptionProposition, idMembre, idGroupe)
VALUES 
('Faire aimer Java de tous !', 'Renforcer leducation civique dans les ecoles.', 12, 11),
('Apprendre JDBC', 'Creer un fond pour les energies renouvelables.', 12, 11),
('Accepter Hibernate', 'Soutenir les projets de solidarite locale.', 12, 11),
('Explorer SpringBoot 3', 'Lancer un projet de revenu de base universel.', 12, 11),
('Donner 20/20 a ce groupe !', 'Augmenter les espaces verts urbains.', 12, 11);

INSERT INTO theme (nomTheme, budgetThemeGlobal) VALUES
('Java', 10000);

INSERT INTO theme (nomTheme) VALUES
('JDBC'), ('Hibernate'), ('Spring'), ('JUnit');

INSERT INTO compose (idGroupe, numTheme) 
VALUES 
(11, 11),
(11, 12),
(11, 13),
(11, 14),
(11, 15);

INSERT INTO caracterise (idProposition, numTheme) VALUES
(11, 11), (12, 12), (13, 13), (14, 14), (15, 15);

INSERT INTO budget (budgetProposition) VALUES
(500);

INSERT INTO a_pour_budget (idProposition, idBudget) VALUES
(11, 11);



