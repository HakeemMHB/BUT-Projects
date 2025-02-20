CREATE OR REPLACE TABLE action_log (
    idLog INT PRIMARY KEY AUTO_INCREMENT,
    idUtilisateur INT,
    nomTable VARCHAR(50),
    action VARCHAR(10),
    dateAction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idEnregistrement INT,
    details TEXT
);


DELIMITER $$

CREATE OR REPLACE TRIGGER log_insert_proposition
AFTER INSERT ON proposition
FOR EACH ROW
BEGIN
    INSERT INTO action_log (idUtilisateur, nomTable, action, idEnregistrement)
    VALUES (NEW.idMembre, 'proposition', 'INSERT', NEW.idProposition);
END$$

DELIMITER ;


DELIMITER $$

CREATE OR REPLACE TRIGGER log_update_proposition
AFTER UPDATE ON proposition
FOR EACH ROW
BEGIN
    INSERT INTO action_log (idUtilisateur, nomTable, action, idEnregistrement)
    VALUES (NEW.idMembre, 'proposition', 'UPDATE', NEW.idProposition);
END$$

DELIMITER ;


DELIMITER $$

CREATE OR REPLACE TRIGGER log_delete_proposition
AFTER DELETE ON proposition
FOR EACH ROW
BEGIN
    INSERT INTO action_log (idUtilisateur, nomTable, action, idEnregistrement)
    VALUES (OLD.idMembre, 'proposition', 'DELETE', OLD.idProposition);
END$$

DELIMITER ;



DELIMITER $$

CREATE OR REPLACE FUNCTION get_theme_id(p_idProposition INT) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE theme_id INT;

    SELECT numTheme INTO theme_id
    FROM caracterise
    WHERE idProposition = p_idProposition;

    RETURN theme_id;
END$$

DELIMITER ;



DELIMITER $$

CREATE OR REPLACE FUNCTION get_theme_budget(p_theme_id INT) RETURNS BIGINT
DETERMINISTIC
BEGIN
    DECLARE budget_global BIGINT;

    SELECT budgetThemeGlobal INTO budget_global
    FROM theme
    WHERE numTheme = p_theme_id;

    RETURN budget_global;
END$$

DELIMITER ;



DELIMITER $$

CREATE OR REPLACE FUNCTION get_somme_budget_proposition(p_theme_id INT) RETURNS BIGINT
DETERMINISTIC
BEGIN
    DECLARE budget_actuel BIGINT;

    SELECT COALESCE(SUM(budgetProposition), 0) INTO budget_actuel
    FROM budget b
    JOIN a_pour_budget apb ON b.idBudget = apb.idBudget
    JOIN caracterise c ON apb.idProposition = c.idProposition
    WHERE c.numTheme = p_theme_id;

    RETURN budget_actuel;
END$$

DELIMITER ;



DELIMITER $$

CREATE OR REPLACE TRIGGER check_budget_proposition
BEFORE INSERT ON a_pour_budget
FOR EACH ROW
BEGIN
    DECLARE theme_id INT;
    DECLARE budget_total BIGINT;
    DECLARE budget_actuel BIGINT;
    DECLARE budget_proposition BIGINT;

    SET theme_id = get_theme_id(NEW.idProposition);

    IF theme_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La proposition n\'est pas associée à un thème.';
    END IF;

    SET budget_total = get_theme_budget(theme_id);

    SET budget_actuel = get_somme_budget_proposition(theme_id);

    SELECT budgetProposition INTO budget_proposition
    FROM budget
    WHERE idBudget = NEW.idBudget;

    IF (budget_actuel + budget_proposition) > budget_total THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Le budget dépasse le budget global du thème.';
    END IF;
END$$

DELIMITER ;