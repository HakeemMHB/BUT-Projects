<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['idProp']) && !isset($_GET['idGroupe'])) {
            $stmt = $pdo->prepare("SELECT * FROM theme INNER JOIN caracterise ON theme.numTheme = caracterise.numTheme WHERE caracterise.idProposition = :idProp");
            $stmt->execute(['idProp' => $_GET['idProp']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else if (isset($_GET['idGroupe']) && !isset($_GET['idProp'])) {
            $stmt = $pdo->prepare("SELECT * FROM theme INNER JOIN compose ON theme.numTheme = compose.numTheme  WHERE compose.idGroupe = :idGroupe");
            $stmt->execute(['idGroupe' => $_GET['idGroupe']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'Erreur Paramètres']);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        
$data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['idProposition'])) {
            $stmt = $pdo->prepare("INSERT INTO theme (nomTheme) VALUES (:nom)");
            $stmt->execute(['nom' => $data['nom']]);
            $numTheme = $pdo->lastInsertId();

            $stmtCaracterise = $pdo->prepare("INSERT INTO caracterise (numTheme, idProposition) VALUES (:numTheme, :idProposition)");
            $stmtCaracterise->execute(['numTheme' => $numTheme, 'idProposition' => $data['idProposition']]);

            echo json_encode(['message' => 'Ajout etiquette proposition']);
        } else if (isset($data['idGroupe'])) {
            $stmt = $pdo->prepare("INSERT INTO theme (nomTheme) VALUES (:nom)");
            $stmt->execute(['nom' => $data['nom']]);
            $numTheme = $pdo->lastInsertId();

            $stmtCompose = $pdo->prepare("INSERT INTO compose (numTheme, idGroupe) VALUES (:numTheme, :idGroupe)");
            $stmtCompose->execute(['numTheme' => $numTheme, 'idGroupe' => $data['idGroupe']]);

            echo json_encode(['message' => 'Ajout etiquette groupe']);
        } else {
            echo json_encode(['message' => 'Erreur Paramètres']);
        }
        break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>