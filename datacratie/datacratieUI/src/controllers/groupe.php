<?php
require_once('src/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user"])) {
        $id = $_SESSION["user"]["idUtilisateur"];
        try {
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/groupes.php?userID=$id";
            $response = file_get_contents($url);
            $groupes = json_decode($response, true);
            

           


            if ($groupes) {

                for ($i = 0; $i < count($groupes); $i++) {
                    $idGroupe = $groupes[$i]["idGroupe"];

                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
                    $response = file_get_contents($url);
                    $membres = json_decode($response, true);

                    $countMembres = count($membres);
                    $isAdmin = false;
                    $j = 0;
                    while ($j < $countMembres and !$isAdmin) {
                        if ($membres[$j]["idUtilisateur"] == $id && $membres[$j]["nomRole"] == "admin" ) {
                            $isAdmin = true;
                        }
                        $j++;
                    }

                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/theme.php?idGroupe=$idGroupe";
                    $response = file_get_contents($url);
                    $themes = json_decode($response, true);

                    $imageGroupe = $groupes[$i]["pathImage"];
                    $nomGroupe = $groupes[$i]["nomGroupe"];
                    $colorGroupe = $groupes[$i]["codeCouleur"];
                    $descriptionGroupe = $groupes[$i]["descriptionGroupe"];
                    echo "<div class=\"card\" style=\"background-color: $colorGroupe\">";
                    echo "<div class=\"card-header\">";
                    if ($imageGroupe) {
                        echo '<img src="data:image/gif;base64,' . $imageGroupe . '" width="75px" class="groupImage" />';
                    }
                    echo "<div class=\"etiquette-box\">";
                    echo "<h2>$nomGroupe</h2>";
                    echo "<div class=\"etiquette-row\">";
                    if (!empty($themes)) {
                        foreach ($themes as $theme) {
                            echo "<div class=\"etiquette\">{$theme['nomTheme']}</div>";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    // echo "<div class=\"line\"></div>";
                    echo "<p>$descriptionGroupe</p>";
                    echo "<button onClick=\"window.location.href='routeur.php?page=propositions&idGroupe=$idGroupe';\" class=\"btn-proposition\">Voir les propositions</button>";
                    if ($isAdmin) {
                        echo "<div class=\"tooltip\">";
                        echo "<img src=\"./public/assets/crown.svg\" alt=\"\" class=\"img-top-right\" width=\"50\" /><span class=\"tooltiptext\">Vous êtes administrateur de ce groupe</span></div>";
                    }
                    echo "</div>";

                    
                }

            } else {
                echo "<p>Vous n'avez pas encore de groupe</p>";
            }
            exit;

        } catch (Exception $e) {
            header('Location: routeur.php?page=login&error=api');
            exit;
        }
    } else {
        header('Location: routeur.php?page=login');
        exit;
    }
} else {
    header('Location: routeur.php?page=login');
    exit;
}
?>