<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user"])) {
        if (isset($_GET['idProp']) and isset($_GET['idGroupe'])) {
            $idProp = $_GET['idProp'];
            $idGroupe = $_GET['idGroupe'];

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/vote.php?idProp=$idProp";
            $response = file_get_contents($url);
            $vote = json_decode($response, true);
            $isLaunched = $vote[0]["estLancer"];
            $isFinished = $vote[0]["estTerminer"];
            $idUtilisateur = $_SESSION["user"]["idUtilisateur"];
            
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?userID=$idUtilisateur&groupeID=$idGroupe";
            $response = file_get_contents($url);
            $groupes = json_decode($response, true);
            $idMembre = $groupes[0]["idMembre"];

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/vote.php?idMembre=$idMembre&idProposition=$idProp";
            $response = file_get_contents($url);
            $vote = json_decode($response, true);
            if (!empty($vote[0]["idMembre"])) {
                $hasVoted = true;
            } else {
                $hasVoted = false;
            }
            
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/propositions.php?idGroupe=$idGroupe&idProp=$idProp";
            $response = file_get_contents($url);
            $propositions = json_decode($response, true);
            $idMembreCreateur = $propositions[0]["idMembre"];

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe&membreID=$idMembreCreateur";
            $response = file_get_contents($url);
            $membres = json_decode($response, true);
            $createur = $membres[0]["prenomUtilisateur"]." ".$membres[0]["nomUtilisateur"];

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
            $response = file_get_contents($url);
            $membres = json_decode($response, true);

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/theme.php?idProp=$idProp";
            $response = file_get_contents($url);
            $themes = json_decode($response, true);

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/scrutin.php?idProp=$idProp";
            $response = file_get_contents($url);
            $scrutins = json_decode($response, true);

            if ($propositions) {
                $nomProposition = $propositions[0]["nomProposition"];
                $descProposition = $propositions[0]["descriptionProposition"];

                $id = $_SESSION["user"]["idUtilisateur"];
                $countMembres = count($membres);
                $isMember = false;
                $isAdmin = false;
                $isOrganiteurVote = false;
                $isAssesseur = false;
                $isScrutateur = false;
                $j = 0;
                while ($j < $countMembres and !$isMember) {
                    if ($membres[$j]["idUtilisateur"] == $id) {
                        $isMember = true;
                        $idMembre = $membres[$j]["idMembre"];
                        if (($membres[$j]["nomRole"] == "admin" || $membres[$j]["nomRole"] == "moderateur")) {
                            $isAdmin = true;
                        }
                        else if($membres[$j]["nomRole"] == "organisateurDuVote"){
                            $isOrganiteurVote = true;
                        }
                        else if($membres[$j]["nomRole"] == "assesseur"){
                            $isAssesseur = true;
                        }
                        else if($membres[$j]["nomRole"] == "scrutateur"){
                            $isScrutateur = true;
                        }
                    }
                    $j++;
                }
                if ($isMember) {
                    echo "<header>";
                    echo "<h2 class=\"title\">$nomProposition</h2>";
                    echo "<div class=\"etiquette-box\">";
                    if (!empty($themes)) {
                        foreach ($themes as $theme) {
                            echo "<div class=\"etiquette\">{$theme['nomTheme']}</div>";
                        }
                    }
                    echo "</div>";
                    echo "</header>";
                    echo "<main>";
                    echo "<p>$descProposition</p>";
                    echo "<div class=\"main-bottom\">";
                    echo "<div>";
                    if(($isAdmin || $isOrganiteurVote) && !$isFinished ){
                        echo $isLaunched ? 
                        "<button class=\"arret\" onclick=\"window.location.href = 'routeur.php?page=voteController&idProp=$idProp&idGroupe=$idGroupe&fin=1';\">Arrêter le vote</button>" :
                        "<button onclick=\"window.location.href = 'routeur.php?page=lancerVoteEtape0&idProp=$idProp&idGroupe=$idGroupe';\">Lancer le vote</button>";
                    }
                    if($isAssesseur && !$isFinished && !$isLaunched){
                        echo "<button onclick=\"window.location.href = 'routeur.php?page=lancerVoteEtape0&idProp=$idProp&idGroupe=$idGroupe';\">Lancer le vote</button>";
                    }
                    if($isScrutateur && $isLaunched && !$isFinished){
                        echo "<button class=\"arret\" onclick=\"window.location.href = 'routeur.php?page=voteController&idProp=$idProp&idGroupe=$idGroupe&fin=1';\">Arrêter le vote</button>";
                    }
                    if($isFinished){
                        echo "<h2>Le vote est terminé</h2>";
                        echo "<button onclick=\"window.location.href = 'routeur.php?page=resultatVote&idProp=$idProp&idGroupe=$idGroupe';\">Voir les résultats</button>";
                    } else {
                        if (!empty($scrutins) && !$hasVoted) {
                        echo "<div class=\"scrutin-box\">";
                        foreach ($scrutins as $scrutin) {
                            echo "<button onclick=\"window.location.href = 'routeur.php?page=voteController&idProp=$idProp&idGroupe=$idGroupe&id={$scrutin['numScrutin']}'\" id=\"{$scrutin['numScrutin']}\">{$scrutin['nomScrutin']}</button>";
                        }
                        echo "</div>";
                    }
                    }
                    echo "</div>";
                    echo "<p>proposé par $createur</p>";
                    echo "</div>";
                    echo "</main>";

                } else {
                    header('Location: routeur.php?page=groupes');
                }
            }
            else{
                header("Location: routeur.php?page=propositions&idGroupe=$idGroupe");
            }

        } else {
            header('Location: routeur.php?page=groupes');
        }
    } else {
        header('Location: routeur.php?page=login');
    }
}
?>