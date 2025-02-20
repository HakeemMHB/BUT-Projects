<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['email'])) {
            $email = $_GET['email'];
            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE adresseMailUtilisateur = :email");
            $stmt->execute(['email' => $email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } 
        else if (isset($_GET['idUtilisateur'])) {
            $idUtilisateur = $_GET['idUtilisateur'];
            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :idUtilisateur");
            $stmt->execute(['idUtilisateur' => $idUtilisateur]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        else {
            $stmt = $pdo->query("SELECT * FROM utilisateur");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO utilisateur (nomUtilisateur, prenomUtilisateur, adressePostaleUtilisateur, adresseMailUtilisateur, passwordUser) VALUES (:nom, :prenom, :adresse, :email, :password)");
        $stmt->execute([
            'nom' => $data['nomUtilisateur'],
            'prenom' => $data['prenomUtilisateur'],
            'adresse' => $data['adressePostaleUtilisateur'],
            'email' => $data['adresseMailUtilisateur'],
            'password' => $data['passwordUser']
        ]);
        echo json_encode(['message' => 'Ajout utilisateur success']);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE utilisateur SET adresseMailUtilisateur = :email, passwordUser = :password WHERE idUtilisateur = :id");
        $stmt->execute([
            'id' => $data['idUtilisateur'],
            'email' => $data['adresseMailUtilisateur'],
            'password' => $data['passwordUser']
        ]);
        echo json_encode(['message' => 'MAJ utilisateur success']);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE idUtilisateur = :id");
        $stmt->execute(['id' => $data['idUtilisateur']]);
        echo json_encode(['message' => 'Supprimer utilisateur success']);
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>
