<?php
require_once '../config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['idProp']) && !isset($_GET['idMembre'])) {
            $stmt = $pdo->prepare("SELECT * FROM etatVote WHERE etatVote.idProposition = :idProp");
            $stmt->execute(['idProp' => $_GET['idProp']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else if (isset($_GET['idProposition']) && isset($_GET['idMembre'])) {
            $stmt = $pdo->prepare("
                SELECT vote.idMembre, definit.idProposition
                FROM vote
                INNER JOIN definit ON vote.numScrutin = definit.numScrutin
                WHERE definit.idProposition = :idProposition
                AND vote.idMembre = :idMembre;");
            $stmt->execute(['idProposition' => $_GET['idProposition'], 'idMembre' => $_GET['idMembre']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
         } else if (isset($_GET['idProposition'])) {
            $stmt = $pdo->prepare("
                SELECT vote.numScrutin, COUNT(vote.idMembre) AS nombreVotes
                FROM vote
                INNER JOIN definit ON vote.numScrutin = definit.numScrutin
                WHERE definit.idProposition = :idProposition
                GROUP BY vote.numScrutin;
            ");
            $stmt->execute(['idProposition' => $_GET['idProposition']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else if (isset($_GET['scrutin'])) {
            $stmt = $pdo->prepare("
                SELECT count(vote.numScrutin) AS nombreVotesScrutin
                FROM vote
                WHERE vote.numScrutin = :scrutin
                GROUP BY vote.numScrutin;
            ");
            $stmt->execute(['scrutin' => $_GET['scrutin']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        
        }
         else {
            echo json_encode(['message' => 'Erreur Paramètres']);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (isset($data['idProposition'])) {
            $stmt = $pdo->prepare("INSERT INTO etatVote (idProposition, estLancer, estTerminer) VALUES (:idProposition, false, false)");
            $stmt->execute(['idProposition' => $data['idProposition']]);
            echo json_encode(['message' => 'Ajout etat du vote initial']);
        } else if (isset($data['idMembre'])){
            $stmt = $pdo->prepare("INSERT INTO vote (idMembre, numScrutin) VALUES (:idMembre, :numScrutin)");
            $stmt->execute(['idMembre' => $data['idMembre'], 'numScrutin' => $data['numScrutin']]);
            echo json_encode(['message' => 'Ajout vote']);
        } else {
            echo json_encode(['message' => 'Erreur Paramètres']);
        }
        break;

    case 'PUT':
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['idProposition'])) {
        if (isset($data['estLancer'])) {
            $stmt = $pdo->prepare("UPDATE etatVote SET estLancer = :estLancer WHERE idProposition = :idProposition");
            $stmt->execute([
                'idProposition' => $data['idProposition'],
                'estLancer' => $data['estLancer']
            ]);
            echo json_encode(['message' => 'MAJ estLancer success']);
        } elseif (isset($data['estTerminer'])) {
            $stmt = $pdo->prepare("UPDATE etatVote SET estTerminer = :estTerminer WHERE idProposition = :idProposition");
            $stmt->execute([
                'idProposition' => $data['idProposition'],
                'estTerminer' => $data['estTerminer']
            ]);
            echo json_encode(['message' => 'MAJ estTerminer success']);
        }
    } else {
        echo json_encode(['message' => 'Erreur Paramètre']);
    }
    break;

    default:
        echo json_encode(['message' => 'Erreur Méthode']);
        break;
}
?>