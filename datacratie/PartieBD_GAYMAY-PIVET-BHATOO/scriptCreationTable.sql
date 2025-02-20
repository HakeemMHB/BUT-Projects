CREATE OR REPLACE TABLE utilisateur (
    idUtilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nomUtilisateur VARCHAR(50),
    prenomUtilisateur VARCHAR(50),
    adressePostaleUtilisateur VARCHAR(300),
    adresseMailUtilisateur VARCHAR(200),
    passwordUser VARCHAR(50)
);

-- Table roles
CREATE OR REPLACE TABLE roles (
    idRole INT PRIMARY KEY AUTO_INCREMENT,
    nomRole VARCHAR(50)
);

-- Table type_signalement
CREATE OR REPLACE TABLE type_signalement (
    numTypeSignalement INT PRIMARY KEY AUTO_INCREMENT,
    nomTypeSignalement VARCHAR(50)
);

-- Table scrutin
CREATE OR REPLACE TABLE scrutin (
    numScrutin INT PRIMARY KEY AUTO_INCREMENT,
    nomScrutin VARCHAR(100)
);

-- Table groupe
CREATE OR REPLACE TABLE groupe (
    idGroupe INT PRIMARY KEY AUTO_INCREMENT,
    nomGroupe VARCHAR(50) NOT NULL,
    descriptionGroupe VARCHAR(300),
    codeCouleur VARCHAR(50),
    pathImage MEDIUMBLOB
);

-- Table membre
CREATE OR REPLACE TABLE membre (
    idMembre INT PRIMARY KEY AUTO_INCREMENT,
    idUtilisateur INT,
    idGroupe INT,
    FOREIGN KEY (idUtilisateur) REFERENCES utilisateur(idUtilisateur) ON DELETE CASCADE,
    FOREIGN KEY (idGroupe) REFERENCES groupe(idGroupe) ON DELETE CASCADE
);

-- Table proposition
CREATE OR REPLACE TABLE proposition (
    idProposition INT PRIMARY KEY AUTO_INCREMENT,
    nomProposition VARCHAR(50),
    descriptionProposition VARCHAR(300),
    idMembre INT,
    idGroupe INT,
    FOREIGN KEY (idMembre) REFERENCES membre(idMembre) ON DELETE CASCADE,
    FOREIGN KEY (idGroupe) REFERENCES groupe(idGroupe) ON DELETE CASCADE
);

-- Table commentaire
CREATE OR REPLACE TABLE commentaire (
    idCommentaire INT PRIMARY KEY AUTO_INCREMENT,
    contenuCommentaire VARCHAR(2000),
    idMembre INT,
    idProposition INT,
    FOREIGN KEY (idMembre) REFERENCES membre(idMembre) ON DELETE CASCADE,
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE
);

-- Table signalement
CREATE OR REPLACE TABLE signalement (
    numSignalement INT PRIMARY KEY AUTO_INCREMENT,
    motifSignalement VARCHAR(100),
    idProposition INT,
    idCommentaire INT,
    idMembre INT,
    numTypeSignalement INT,
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE,
    FOREIGN KEY (idCommentaire) REFERENCES commentaire(idCommentaire) ON DELETE CASCADE,
    FOREIGN KEY (idMembre) REFERENCES membre(idMembre) ON DELETE CASCADE,
    FOREIGN KEY (numTypeSignalement) REFERENCES type_signalement(numTypeSignalement) ON DELETE CASCADE
);

-- Table theme
CREATE OR REPLACE TABLE theme (
    numTheme INT PRIMARY KEY AUTO_INCREMENT,
    nomTheme VARCHAR(50),
    budgetThemeGlobal BIGINT
);

-- Table reaction
CREATE OR REPLACE TABLE reaction (
    idReaction INT PRIMARY KEY AUTO_INCREMENT,
    emoticone VARCHAR(50)
);

-- Table budget
CREATE OR REPLACE TABLE budget (
    idBudget INT PRIMARY KEY AUTO_INCREMENT,
    budgetProposition BIGINT
);

-- Table vote
CREATE OR REPLACE TABLE vote (
    idVote INT PRIMARY KEY AUTO_INCREMENT,
    choixVote VARCHAR(300),
    dureeVote BIGINT,
    idMembre INT,
    numScrutin INT,
    FOREIGN KEY (idMembre) REFERENCES membre(idMembre) ON DELETE CASCADE,
    FOREIGN KEY (numScrutin) REFERENCES scrutin(numScrutin) ON DELETE CASCADE
);

-- Table a_pour_role
CREATE OR REPLACE TABLE a_pour_role (
    idMembre INT,
    idRole INT,
    PRIMARY KEY (idMembre, idRole),
    FOREIGN KEY (idMembre) REFERENCES membre(idMembre) ON DELETE CASCADE,
    FOREIGN KEY (idRole) REFERENCES roles(idRole) ON DELETE CASCADE
);

-- Table caracterise
CREATE OR REPLACE TABLE caracterise (
    idProposition INT,
    numTheme INT,
    PRIMARY KEY (idProposition, numTheme),
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE,
    FOREIGN KEY (numTheme) REFERENCES theme(numTheme) ON DELETE CASCADE
);

-- Table reagit
CREATE OR REPLACE TABLE reagit (
    idCommentaire INT,
    idReaction INT,
    PRIMARY KEY (idCommentaire, idReaction),
    FOREIGN KEY (idCommentaire) REFERENCES commentaire(idCommentaire) ON DELETE CASCADE,
    FOREIGN KEY (idReaction) REFERENCES reaction(idReaction) ON DELETE CASCADE
);

-- Table reagit_sur
CREATE OR REPLACE TABLE reagit_sur (
    idProposition INT,
    idReaction INT,
    nombreDeReaction INT,
    PRIMARY KEY (idProposition, idReaction),
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE,
    FOREIGN KEY (idReaction) REFERENCES reaction(idReaction) ON DELETE CASCADE
);

-- Table a_pour_budget
CREATE OR REPLACE TABLE a_pour_budget (
    idProposition INT,
    idBudget INT,
    PRIMARY KEY (idProposition, idBudget),
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE,
    FOREIGN KEY (idBudget) REFERENCES budget(idBudget) ON DELETE CASCADE
);


-- Table delibere
CREATE OR REPLACE TABLE delibere (
    idProposition INT,
    idVote INT,
    nombreVotes BIGINT,
    PRIMARY KEY (idProposition, idVote),
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE,
    FOREIGN KEY (idVote) REFERENCES vote(idVote) ON DELETE CASCADE
);


-- Table participe
CREATE OR REPLACE TABLE participe (
    idMembre INT,
    idVote INT,
    PRIMARY KEY (idMembre, idVote),
    FOREIGN KEY (idMembre) REFERENCES membre(idMembre) ON DELETE CASCADE,
    FOREIGN KEY (idVote) REFERENCES vote(idVote) ON DELETE CASCADE
);

-- Table presente
CREATE OR REPLACE TABLE presente (
    idMembre INT,
    numScrutin INT,
    PRIMARY KEY (idMembre, numScrutin),
    FOREIGN KEY (idMembre) REFERENCES membre(idMembre) ON DELETE CASCADE,
    FOREIGN KEY (numScrutin) REFERENCES scrutin(numScrutin) ON DELETE CASCADE
);

-- Table invitation
CREATE OR REPLACE TABLE invitation (
    idInvitation INT PRIMARY KEY AUTO_INCREMENT,
    idGroupe INT,
    adresseMail VARCHAR(110),
    idRole INT,
    FOREIGN KEY (idGroupe) REFERENCES groupe(idGroupe) ON DELETE CASCADE,
    FOREIGN KEY (idRole) REFERENCES roles(idRole) ON DELETE CASCADE
);

-- Table compose
CREATE OR REPLACE TABLE compose (
    idGroupe INT,
    numTheme INT,
    PRIMARY KEY (idGroupe, numTheme),
    FOREIGN KEY (idGroupe) REFERENCES groupe(idGroupe) ON DELETE CASCADE,
    FOREIGN KEY (numTheme) REFERENCES theme(numTheme) ON DELETE CASCADE
);

-- Table definit
CREATE OR REPLACE TABLE definit (
    idProposition INT,
    numScrutin INT,
    PRIMARY KEY (idProposition, numScrutin),
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE,
    FOREIGN KEY (numScrutin) REFERENCES scrutin(numScrutin) ON DELETE CASCADE
);

-- Table etatVote
CREATE OR REPLACE TABLE etatVote (
    idProposition INT,
    estLancer BOOLEAN,
    estTerminer BOOLEAN,
    PRIMARY KEY (idProposition),
    FOREIGN KEY (idProposition) REFERENCES proposition(idProposition) ON DELETE CASCADE
); 