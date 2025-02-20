-- Vue liant Utilisateur, Membre et Groupe
CREATE OR REPLACE VIEW vue_utilisateurs_membres_groupes AS
SELECT 
    u.idUtilisateur,
    m.idMembre,
    g.idGroupe,
    u.nomUtilisateur,
    u.prenomUtilisateur
FROM 
    utilisateur u
JOIN 
    membre m ON u.idUtilisateur = m.idUtilisateur
JOIN 
    groupe g ON m.idGroupe = g.idGroupe;




-- Vue liant Utilisateur, Membre et Proposition
CREATE OR REPLACE VIEW vue_membre_utilisateur_proposition AS
SELECT 
    u.idUtilisateur,
    m.idMembre,
    p.idProposition,
    u.nomUtilisateur,
    u.prenomUtilisateur,
    p.nomProposition
FROM 
    utilisateur u
JOIN 
    membre m ON u.idUtilisateur = m.idUtilisateur
JOIN 
    proposition p ON m.idMembre = p.idMembre;



-- Vue recensant les rôles des membres d'un groupe
CREATE OR REPLACE VIEW vue_utilisateur_membre_groupe_role AS
SELECT 
    u.idUtilisateur,
    m.idMembre,
    g.idGroupe,
    apr.idRole,
    u.nomUtilisateur,
    u.prenomUtilisateur
FROM 
    utilisateur u
JOIN 
    membre m ON u.idUtilisateur = m.idUtilisateur
JOIN 
    groupe g ON m.idGroupe = g.idGroupe
JOIN 
    a_pour_role apr ON m.idMembre = apr.idMembre;




-- Vue regroupant les décideurs de chaque groupe
CREATE OR REPLACE VIEW vue_decideurs_groupes AS
SELECT 
    u.idUtilisateur,
    m.idMembre,
    g.idGroupe,
    u.nomUtilisateur,
    u.prenomUtilisateur,
    u.adresseMailUtilisateur,
    u.passwordUser,
    g.nomGroupe
FROM 
    utilisateur u
JOIN 
    membre m ON u.idUtilisateur = m.idUtilisateur
JOIN 
    groupe g ON m.idGroupe = g.idGroupe
JOIN 
    a_pour_role apr ON m.idMembre = apr.idMembre
JOIN 
    roles r ON apr.idRole = r.idRole
WHERE 
    r.idRole = 4;
