<!-- let mailToLink = 'mailto:' + encodeURIComponent(textFieldEmail) + -->
<!-- '?Subject=' + encodeURIComponent('Invitation au groupe démocratique ' + nomGroupe) + -->
<!-- '&body=' + encodeURIComponent('Bonjour, je vous invite à rejoindre le groupe ' + nomGroupe + ' sur Datacratie. Cliquez -->
<!-- sur ce lien pour rejoindre mon groupe : https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/routeur.php');*/ -->

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION["user"])) {
        if (isset($_GET["idGroupe"]) and isset($_GET["nomGroupe"])) {
            $idGroupe = $_GET["idGroupe"];
            $nomGroupe = $_GET["nomGroupe"];
            if (isset($_GET["email"]) and isset($_GET["idRole"])) {
                $adresseMail = $_GET["email"];
                $idRole = $_GET["idRole"];

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

                if ($isMember) {
                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/invitations.php";

                    $createInvitation = [
                        'idGroupe' => $idGroupe,
                        'adresseMail' => $adresseMail,
                        'idRole' => $idRole,
                    ];

                    $options = [
                        'http' => [
                            'method' => 'POST',
                            'header' => 'Content-Type: application/json',
                            'content' => json_encode($createInvitation),
                        ]

                    ];
                    $context = stream_context_create($options);

                    $response = file_get_contents($url, false, $context);

                    header("Location: routeur.php?page=invite-utilisateur-groupe&idGroupe=$idGroupe");
                } else {
                    header("Location: routeur.php?page=groupes");
                }


            } else {
                header("Location: routeur.php?page=invite-utilisateur-groupe&idGroupe=$idGroupe");
            }
        } else {
            header("Location: routeur.php?page=groupes");
        }



    } else {
        header("Location: routeur.php?page=login");
    }
} else {
    header('Location: routeur.php?page=groupes');
}
?>