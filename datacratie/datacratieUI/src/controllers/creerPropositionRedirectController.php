<?php
if (isset($_SESSION["user"])) {
    if (!isset($_GET['idGroupe'])) {
        header('Location: routeur.php?page=groupes');
    } else {
        $idGroupe = $_GET['idGroupe'];
        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
        $response = file_get_contents($url);
        $membres = json_decode($response, true);

        $id = $_SESSION["user"]["idUtilisateur"];
        $countMembres = count($membres);
        $isMember = false;
        $j = 0;
        while ($j < $countMembres and !$isMember) {
            if ($membres[$j]["idUtilisateur"] == $id) {
                $isMember = true;
            }

            $j++;
        }
        if(!$isMember){
            header('Location: routeur.php?page=groupes');
        }

    }
} else {
    header('Location: routeur.php?page=login');
}
?>