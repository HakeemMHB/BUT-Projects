<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['adresseMail'])) {
            $adresseMail = $_GET['adresseMail'];
            $stmt = $pdo->prepare("SELECT * FROM invitation WHERE adresseMail = :adresseMail");
            $stmt->execute(['adresseMail' => $adresseMail]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            $stmt = $pdo->query("SELECT * FROM invitation");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        $stmt2 = $pdo->prepare("INSERT INTO invitation (idGroupe, adresseMail, idRole) VALUES (:idGroupe, :adresseMail, :idRole)");
        $stmt2->execute([
            'idGroupe' => $data['idGroupe'],
            'adresseMail' => $data['adresseMail'],
            'idRole' => $data['idRole'],
        ]);
        echo json_encode(['message' => 'Ajout de l\'invitation avec success']);
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
        $stmt1 = $pdo->prepare("DELETE FROM invitation WHERE adresseMail = :adresseMail");
        $stmt1->execute(['adresseMail' => $data['adresseMail']]);
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>
