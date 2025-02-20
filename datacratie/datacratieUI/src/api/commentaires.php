<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['IdMembre'])) {
            $memberID = $_GET['IdMembre'];
            $stmt = $pdo->prepare("SELECT idCommentaire, contenuCommentaire, idMembre, idProposition, nomUtilisateur, prenomUtilisateur FROM commentaire NATURAL JOIN membre NATURAL JOIN utilisateur WHERE idMembre = :memberID");
            $stmt->execute(['memberID' => $memberID]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } elseif (isset($_GET['idProposition'])) {
            $IdProposition = $_GET['idProposition'];
            $stmt = $pdo->prepare("SELECT idCommentaire, contenuCommentaire, idProposition,idMembre, nomUtilisateur, prenomUtilisateur FROM commentaire NATURAL JOIN membre NATURAL JOIN utilisateur WHERE IdProposition = :IdProposition");
            $stmt->execute(['IdProposition' => $IdProposition]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            $stmt = $pdo->query("SELECT idCommentaire, contenuCommentaire, idMembre, dProposition, nomUtilisateur, prenomUtilisateur FROM commentaire NATURAL JOIN membre NATURAL JOIN utilisateur");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        $stmt2 = $pdo->prepare("INSERT INTO commentaire (contenuCommentaire, idMembre, idProposition) VALUES (:contenuCommentaire, :idMembre, :idProposition)");
        $stmt2->execute([
            'contenuCommentaire' => $data['contenuCommentaire'],
            'idMembre' => $data['idMembre'],
            'idProposition' => $data['idProposition'],
        ]);
        echo json_encode(['message' => 'Ajout du commentaire avec success']);
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
        $stmt1 = $pdo->prepare("DELETE FROM commentaire WHERE idCommentaire = :id");
        $stmt1->execute(['id' => $data['idCommentaire']]);
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>
