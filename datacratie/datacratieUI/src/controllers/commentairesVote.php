<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $idProposition = $_GET["idProp"];
        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/commentaires.php?idProposition=$idProposition";
        $response = file_get_contents($url);
        $commentaires = json_decode($response, true);


        if ($commentaires) {

            for ($i = 0; $i < count($commentaires); $i++) {
                $contenuCommentaire = $commentaires[$i]["contenuCommentaire"];
                $nom = $commentaires[$i]["nomUtilisateur"];
                $prenom = $commentaires[$i]["prenomUtilisateur"];
                echo "<div class=\"ajouter-commentaire\">";
                echo "<div class=\"comment\">";
                echo "<div class=\"theComment\">";
                echo "<p><b>$prenom $nom</b></p>";
                echo "<p>$contenuCommentaire</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            exit;
        }
    } catch (Exception $e) {
        header('Location: routeur.php?page=login&error=api');
        exit;
    }
} else {
    header('Location: routeur.php?page=login');
    exit;
}
?>