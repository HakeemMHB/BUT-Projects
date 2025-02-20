<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['idProp'])) {
            $stmt = $pdo->prepare("SELECT * FROM scrutin INNER JOIN definit ON scrutin.numScrutin = definit.numScrutin WHERE definit.idProposition = :idProp");
            $stmt->execute(['idProp' => $_GET['idProp']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
         } else {
            echo json_encode(['message' => 'Erreur Paramètres']);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (isset($data['idProposition'])) {
            $stmt = $pdo->prepare("INSERT INTO scrutin (nomScrutin) VALUES (:nom)");
            $stmt->execute(['nom' => $data['nom']]);
            $numScrutin = $pdo->lastInsertId();

            $stmtDefinit = $pdo->prepare("INSERT INTO definit (numScrutin, idProposition) VALUES (:numScrutin, :idProposition)");
            $stmtDefinit->execute(['numScrutin' => $numScrutin, 'idProposition' => $data['idProposition']]);

            echo json_encode(['message' => 'Ajout scrutin proposition']);
        } else {
            echo json_encode(['message' => 'Erreur Paramètres']);
        }
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>