<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user"])) {
        if (isset($_GET["idGroupe"])) {
            $idGroupe = $_GET["idGroupe"];
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
            $response = file_get_contents($url);
            $membres = json_decode($response, true);

            $id = $_SESSION["user"]["idUtilisateur"];
            $countMembres = count($membres);
            $isAdmin = false;
            $j = 0;
            while ($j < $countMembres and !$isAdmin) {
                if ($membres[$j]["idUtilisateur"] == $id && $membres[$j]["nomRole"] == "admin") {
                    $isAdmin = true;
                }
                $j++;
            }
            if ($isAdmin) {
                $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/groupes.php";

                $groupeToDelete = ["idGroupe" => $idGroupe];
                $options = [
                    'http' => [
                        'method' => 'DELETE',
                        'header' => 'Content-Type: application/json',
                        'content' => json_encode($groupeToDelete),
                    ]

                ];
                $context = stream_context_create($options);

                $response = file_get_contents($url, false, $context);

                header("Location: routeur.php?page=groupes");
            } else {
                header("Location: routeur.php?page=groupes");
            }

        } else {
            header('Location: routeur.php?page=405');
        }
    } else {
        header('Location: routeur.php?page=login');
    }
} else {
    header('Location: routeur.php?page=groupes');
}
?>