<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['memberID']) && !isset($_GET['groupeID'])) {
            $memberID = $_GET['memberID'];
            $stmt = $pdo->prepare("SELECT idMembre, idUtilisateur, nomUtilisateur, prenomUtilisateur, adresseMailUtilisateur, idGroupe, idRole, nomRole FROM membre NATURAL JOIN a_pour_role NATURAL JOIN roles NATURAL JOIN utilisateur WHERE idMembre = :memberID");
            $stmt->execute(['memberID' => $memberID]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } elseif (isset($_GET['userID']) && isset($_GET['groupeID'])) {
            $userID = $_GET['userID'];
            $groupeID = $_GET['groupeID'];
            $stmt = $pdo->prepare("SELECT * FROM membre WHERE idUtilisateur = :userID AND idGroupe = :groupeID");
            $stmt->execute(['userID' => $userID, 'groupeID' => $groupeID]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } elseif (isset($_GET['groupeID']) && !isset($_GET['membreID'])) {
            $groupeID = $_GET['groupeID'];
            $stmt = $pdo->prepare("SELECT idMembre, idUtilisateur, nomUtilisateur, prenomUtilisateur, adresseMailUtilisateur, idGroupe, idRole, nomRole FROM membre NATURAL JOIN a_pour_role NATURAL JOIN roles NATURAL JOIN utilisateur WHERE idGroupe = :groupeID");
            $stmt->execute(['groupeID' => $groupeID]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } elseif (isset($_GET['groupeID']) && isset($_GET['membreID'])) {
            $groupeID = $_GET['groupeID'];
            $membreID = $_GET['membreID'];
            $stmt = $pdo->prepare("SELECT idMembre, utilisateur.idUtilisateur, nomUtilisateur, prenomUtilisateur, adresseMailUtilisateur, idGroupe FROM membre INNER JOIN utilisateur ON utilisateur.idUtilisateur = membre.idUtilisateur WHERE idGroupe = :groupeID AND idMembre = :membreID;");
            $stmt->execute(['groupeID' => $groupeID, 'membreID' => $membreID]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            $stmt = $pdo->query("SELECT idMembre, idUtilisateur, nomUtilisateur, prenomUtilisateur, adresseMailUtilisateur, idGroupe, idRole, nomRole FROM membre NATURAL JOIN a_pour_role NATURAL JOIN roles NATURAL JOIN utilisateur");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        break;

        case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        
       $stmt = $pdo->prepare("INSERT INTO membre (idUtilisateur, idGroupe) VALUES (:idUser, :idGrp)");
            $stmt->execute([
                'idUser' => $data['idUtilisateur'],
                'idGrp' => $data['idGroupe'],
            ]);

        $idMembre = $pdo->lastInsertId();

        $stmt2 = $pdo->prepare("INSERT INTO a_pour_role (idMembre, idRole) VALUES (:memberID, :roleID)");
            $stmt2->execute([
                'memberID' => $idMembre,
                'roleID' => $data['idRole'],
        ]);

        echo json_encode([
            'message' => 'Ajout du groupe avec success',
            'idMembre' => $idMembre,
        ]);
        break;
    
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE a_pour_role SET idRole = :role WHERE idMembre = :id");
        $stmt->execute([
            'id' => $data['idMembre'],
            'role' => $data['idRole'],
        ]);
        echo json_encode(['message' => 'MAJ utilisateur success']);
        break;
    
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt1 = $pdo->prepare("DELETE FROM a_pour_role WHERE idMembre = :id");
        $stmt1->execute(['id' => $data['idMembre']]);

        $stmt2 = $pdo->prepare("DELETE FROM membre WHERE idMembre = :id");
        $stmt2->execute(['id' => $data['idMembre']]);
        echo json_encode(['message' => 'Supprimer groupe avec success']);
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>
