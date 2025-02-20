<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user"])) {
        if (isset($_GET["idProp"]) and isset($_GET["contentCommentaire"]) and isset($_GET["idGroupe"])) {
            

            $id = $_SESSION['user']['idUtilisateur'];

            try {
                $idGroupe = $_GET["idGroupe"];
                $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
                $response = file_get_contents($url);
                $membres = json_decode($response, true);
    
                $countMembres = count($membres);
                $isMember = false;
                $j = 0;
                while ($j < $countMembres and !$isMember) {
                    if ($membres[$j]["idUtilisateur"] == $id) {
                        $isMember = true;
                        $idMembre = $membres[$j]["idMembre"];
                    }
    
                    $j++;
                }

                if ($isMember) {
                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/commentaires.php";
                    $idProp = $_GET["idProp"];
                    
                    $contenuCommentaire = $_GET["contentCommentaire"];
                    $addComment = ["contenuCommentaire" => $contenuCommentaire, "idProposition" => $idProp, "idMembre" => $idMembre];
                    $options = [
                        'http' => [
                            'method' => 'POST',
                            'header' => 'Content-Type: application/json',
                            'content' => json_encode($addComment),
                        ]

                    ];
                    $context = stream_context_create($options);

                    $response = file_get_contents($url, false, $context);

                    header("Location: routeur.php?page=vote&idProp=$idProp&idGroupe=$idGroupe");
                }
                else {
                    header("Location: routeur.php?page=groupes");
                }

            } catch (Exception $e) {
                header('Location: routeur.php?page=login&error=api');
                exit;
            }
        } else {
            header("Location: routeur.php?page=propositions&idGroupe=$idGroupe");
        }
    } else {
        header("Location: routeur.php?page=groupes");
    }
} else {
    header("Location: routeur.php?page=login");
}


?>