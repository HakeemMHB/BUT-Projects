<?php
require_once('src/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user"])) {
        if (isset($_GET["idGroupe"]) and isset($_GET["idMembre"]) and isset($_GET["idRole"])) {
            $idGroupe = $_GET["idGroupe"];
            $idMembre = $_GET["idMembre"];
            $idRole = $_GET["idRole"];
            $nomUserEdit = "";
            $prenomUserEdit = "";
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
            $response = file_get_contents($url);
            $membres = json_decode($response, true);

            $id = $_SESSION["user"]["idUtilisateur"];
            $countMembres = count($membres);
            $isAdmin = false;
            $isAdminTheMember = false;
            $membreExistInGroup = false;
            $j = 0;
            while ($j < $countMembres and (!$isAdmin or !$membreExistInGroup) and !$isAdminTheMember) {
                if ($membres[$j]["idUtilisateur"] == $id && ($membres[$j]["nomRole"] == "admin" || $membres[$j]["nomRole"] == "moderateur")) {
                    $isAdmin = true;
                    if($membres[$j]["idMembre"] == $idMembre){
                        $isAdminTheMember = true;
                    }
                }
                if ($membres[$j]["idMembre"] == $idMembre) {
                    $membreExistInGroup = true;
                    $nomUserEdit = $membres[$j]["nomUtilisateur"];
                    $prenomUserEdit = $membres[$j]["prenomUtilisateur"];
                }
                $j++;
            }
            if(!$isAdminTheMember){
                if ($isAdmin and $membreExistInGroup and $idRole<7 and $idRole>0) {
                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php";

                    $membersToUpdate = ["idMembre" => $idMembre, "idRole" => $idRole];
                    $options = [
                        'http' => [
                            'method' => 'PUT',
                            'header' => 'Content-Type: application/json',
                            'content' => json_encode($membersToUpdate),
                        ]

                    ];
                    $context = stream_context_create($options);

                    $response = file_get_contents($url, false, $context);

                    header("Location: routeur.php?page=gerer-utilisateur-groupe&idGroupe=$idGroupe&update=true&nomUtilisateur=$nomUserEdit&prenomUtilisateur=$prenomUserEdit");
                }
                else{
                    header('Location: routeur.php?page=404');
                }
            }
            else{
                header("Location: routeur.php?page=gerer-utilisateur-groupe&idGroupe=$idGroupe");
            }

        }
        else{
            header('Location: routeur.php?page=405');
        }
    }
    else{
        header('Location: routeur.php?page=login');
    }
} else {
    header('Location: routeur.php?page=groupes');
}
?>