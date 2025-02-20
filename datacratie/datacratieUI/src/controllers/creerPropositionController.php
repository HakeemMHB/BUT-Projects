<?php
require_once('src/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_SESSION["user"])){
        if(isset($_GET["idGroupe"])) {
            $idGroupe = $_GET["idGroupe"];
            $idUtilisateur = $_SESSION['user']['idUtilisateur'];
            if(isset($_POST['titre-proposition'])) {
                try {
                    $titre = $_POST["titre-proposition"];
                    $desc = $_POST["desc-proposition"];
                    $etiquettes = json_decode($_POST["etiquettes"], true);

                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?userID=$idUtilisateur&groupeID=$idGroupe";
                    $response = file_get_contents($url);
                    $groupes = json_decode($response, true);
                    $idMembre = $groupes[0]["idMembre"];

                    $data = [
                        'nomProposition' => $titre,
                        'descriptionProposition' => $desc,
                        'idGroupe' => $idGroupe,
                        'idMembre' => $idMembre
                    ];
                    
                    $options = [
                        'http' => [
                            'method' => 'POST',
                            'header' => 'Content-type: application/json',
                            'content' => json_encode($data),
                        ],
                    ];
                    
                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/propositions.php";

                    $context = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);

                    if ($response === FALSE) {
                        header("Location: routeur.php?page=creerProposition&error=api1");
                        exit;
                    }

                    $responseData = json_decode($response, true);
                    $idProposition = $responseData['idProposition'];

                    if (!empty($etiquettes)) {
                        foreach ($etiquettes as $etiquette) {
                            $dataTheme = ['nom' => $etiquette, 'idProposition' => $idProposition];
                            $optionsTheme = [
                                'http' => [
                                    'method' => 'POST',
                                    'header' => 'Content-type: application/json',
                                    'content' => json_encode($dataTheme),
                                ],
                            ];
                            
                            $urlTheme = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/theme.php";
                            $contextTheme = stream_context_create($optionsTheme);
                            file_get_contents($urlTheme, false, $contextTheme);
                        }
                    }

                    $data = ['idProposition' => $idProposition];
                    
                    $options = [
                        'http' => [
                            'method' => 'POST',
                            'header' => 'Content-type: application/json',
                            'content' => json_encode($data),
                        ],
                    ];

                    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/vote.php";
                    $contextVote = stream_context_create($options);
                    file_get_contents($url, false, $contextVote);

                    header("Location: routeur.php?page=propositions&idGroupe=$idGroupe");
                    exit;
                } catch (Exception $e) {
                    header('Location: routeur.php?page=login&error=api');
                    exit;
                }
            }
            else{
                header("Location: routeur.php?page=propositions&idGroupe=$idGroupe");
            }
        }
        else{
            header("Location: routeur.php?page=groupes");
        }
    }
    else{
        header("Location: routeur.php?page=login");
    }
}
else{
    header('Location: routeur.php?page=groupes');
}
?>