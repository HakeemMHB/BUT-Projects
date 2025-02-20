<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user"])) {
        $id = $_SESSION["user"]["idUtilisateur"];
        try {
            $idGroupe = $_GET["idGroupe"];
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/propositions.php?idGroupe=$idGroupe";
            $response = file_get_contents($url);
            $propositions = json_decode($response, true);

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
            $response = file_get_contents($url);
            $membres = json_decode($response, true);

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/groupes.php?idGroupe=$idGroupe";
            $response = file_get_contents($url);
            $groupe = json_decode($response, true);

            $countMembres = count($membres);
            $isMember = false;
            $isModerateur = false;
            $isAdmin = false;
            $j = 0;
            while ($j < $countMembres and !$isMember) {
                if ($membres[$j]["idUtilisateur"] == $id) {
                    $isMember = true;
                    if ($membres[$j]["nomRole"] == "admin" ) {
                        $isAdmin = true;
                        
                    }
                    elseif($membres[$j]["nomRole"] == "moderateur"){
                        $isModerateur = true;
                    }
                }

                $j++;
            }
            if ($isMember) {
                $nomGroupe = $groupe[0]["nomGroupe"];
                echo "<header>";
                echo "<h2 class=\"title\">Propositions de <span style=\"color:#6d7da8;\">$nomGroupe</span></h2>";
                echo "<div class=\"header-btn\">";
                echo "<button onclick=\"window.location.href = 'routeur.php?page=creerProposition&idGroupe=$idGroupe';\">+</button>";
                
                if ($isAdmin || $isModerateur) {
                    echo "<button onclick=\"window.location.href = 'routeur.php?page=gerer-utilisateur-groupe&idGroupe=$idGroupe';\"><i class=\"fa-solid fa-user\"></i></button>";
                }
                if ($isAdmin) {
                    echo "<button class=\"buttonDeleteGroup\" onclick=\"window.location.href = 'routeur.php?page=supprimerGroupeController&idGroupe=$idGroupe';\"><i class=\"fa-solid fa-trash-can\"></i></button>";
                }
                echo "</div>";
                echo "</header>";
                if ($propositions) {
                    echo "<main>";

                    for ($i = 0; $i < count($propositions); $i++) {
                        $nomProposition = $propositions[$i]["nomProposition"];
                        $descProposition = $propositions[$i]["descriptionProposition"];
                        $idProposition = $propositions[$i]["idProposition"];
                        echo "<div class=\"card\">";
                        echo "<h1>$nomProposition</h1>";
                        echo "<p>$descProposition</p>";
                        echo "<div class=\"reaction\">";
                        echo "<a href=\"#\"><img src=\"./public/assets/like.svg\" width=\"50px\" /></a>";
                        echo "<a href=\"#\"><img src=\"./public/assets/dislike.svg\" width=\"50px\" /></a>";
                        echo "</div>";
                        echo "<img src=\"./public/assets/report.svg\" class=\"img-top-right\" width=\"50px\"/>";
                        echo "<button onclick=\"window.location.href = 'routeur.php?page=vote&idProp=$idProposition&idGroupe=$idGroupe'\" class=\"btn-proposition\">Voir</button>";
                        echo "</div>";
                    }
                    exit;
                } else {
                    echo "<main>";
                    echo "<p>Il n'y a pas encore de propositions pour ce groupe</p>";
                    echo "</main>";
                }
            } else {
                header('Location: routeur.php?page=groupes');
            }
        } catch (Exception $e) {
            header('Location: routeur.php?page=login&error=api');
            exit;
        }

    } else {
        header("Location: routeur.php?page=login");
    }
} else {
    header('Location: routeur.php?page=login');
    exit;
}
?>