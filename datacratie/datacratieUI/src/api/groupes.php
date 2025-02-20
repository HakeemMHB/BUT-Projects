<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['userID'])) {
            $userID = $_GET['userID'];
            $stmt = $pdo->prepare("SELECT groupe.idGroupe, nomGroupe, descriptionGroupe, codeCouleur, pathImage FROM groupe INNER JOIN membre ON groupe.idGroupe=membre.idGroupe WHERE idUtilisateur = :userID");
            $stmt->execute(['userID' => $userID]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }  elseif (isset($_GET['idGroupe'])) {
            $idGroupe = $_GET['idGroupe'];
            $stmt = $pdo->prepare("SELECT DISTINCT groupe.idGroupe, nomGroupe, descriptionGroupe, codeCouleur, pathImage FROM groupe INNER JOIN membre ON groupe.idGroupe=membre.idGroupe WHERE groupe.idGroupe = :idGroupe");
            $stmt->execute(['idGroupe' => $idGroupe]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } 
        else {
            $stmt = $pdo->query("SELECT * FROM groupe");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO groupe (nomGroupe, descriptionGroupe, codeCouleur, pathImage) VALUES (:nom, :descri , :couleur, :theImage)");
        $stmt->execute([
            'nom' => $data['nomGroupe'],
            'descri' => $data['descriptionGroupe'],
            'couleur' => $data['codeCouleur'],
            'theImage' => $data['pathImage'],
        ]);

        $idGroupe = $pdo->lastInsertId();
        
        echo json_encode([
            'message' => 'Ajout du groupe avec success',
            'idGroupe' => $idGroupe,
        ]);
        break;
    
    /*case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE utilisateur SET adresseMailUtilisateur = :email, passwordUser = :password WHERE idUtilisateur = :id");
        $stmt->execute([
            'id' => $data['idUtilisateur'],
            'email' => $data['adresseMailUtilisateur'],
            'password' => $data['passwordUser']
        ]);
        echo json_encode(['message' => 'MAJ utilisateur success']);
        break;
    */
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("DELETE FROM groupe WHERE idGroupe = :id");
        $stmt->execute(['id' => $data['idGroupe']]);
        echo json_encode(['message' => 'Supprimer groupe avec success']);
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>
