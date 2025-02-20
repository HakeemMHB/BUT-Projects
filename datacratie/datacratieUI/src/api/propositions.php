<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['idGroupe']) && !isset($_GET['idProp'])) {
            $idGroupe = $_GET['idGroupe'];
            $stmt = $pdo->prepare("SELECT * FROM proposition WHERE idGroupe = :idGroupe");
            $stmt->execute(['idGroupe' => $idGroupe]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else
            if (isset($_GET['idProp']) && isset($_GET['idGroupe'])) {
                $idProp = $_GET['idProp'];
                $idGroupe = $_GET['idGroupe'];
                $stmt = $pdo->prepare("SELECT * FROM proposition WHERE idProposition = :idProp AND idGroupe = :idGroupe");
                $stmt->execute(['idProp' => $idProp, 'idGroupe' => $idGroupe]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
            } else {
                $stmt = $pdo->query("SELECT * FROM proposition");
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
            }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO proposition (nomProposition, descriptionProposition, idMembre, idGroupe) VALUES (:titre, :desc, :idMembre, :idGroupe)");
        $stmt->execute([
            'titre' => $data['nomProposition'],
            'desc' => $data['descriptionProposition'],
            'idMembre' => $data['idMembre'],
            'idGroupe' => $data['idGroupe'],
        ]);
        echo json_encode(['message' => 'Ajout prop success', 'idProposition' => $pdo->lastInsertId()]);
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

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $data['idUtilisateur']]);
        echo json_encode(['message' => 'Supprimer utilisateur success']);
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;*/
}
?>