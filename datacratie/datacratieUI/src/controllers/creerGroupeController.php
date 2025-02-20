<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST["nom-groupe"])){
        try {
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/groupes.php";
            $couleur = $_POST["color-groupe"];
            $nomGroupe = $_POST["nom-groupe"];
            $descGroupe = $_POST["desc-groupe"];
            $image_data = null;
            $etiquettes = json_decode($_POST["etiquettes"], true);

            if (isset($_FILES['image-groupe']) && $_FILES['image-groupe']['error'] == 0) {
                $image_tmp = $_FILES['image-groupe']['tmp_name'];
                $image_data = base64_encode(file_get_contents($image_tmp));
            }

            $data = [
                'nomGroupe' => $nomGroupe,
                'descriptionGroupe' => $descGroupe,
                'codeCouleur' => $couleur,
                'pathImage' => $image_data,
            ];
            
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/json',
                    'content' => json_encode($data),
                ],
            ];
            
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);

            if ($response === FALSE) {
                header("Location: routeur.php?page=creerGroupe&error=api1");
                exit;
            }

            $responseData = json_decode($response, true);
            $idGroupe = $responseData['idGroupe'];

            if (!empty($etiquettes)) {
                foreach ($etiquettes as $etiquette) {
                    $dataTheme = ['nom' => $etiquette, 'idGroupe' => $idGroupe];
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

            if (!isset($responseData['idGroupe'])) {
                header("Location: routeur.php?page=creerGroupe&error=api3");
                exit;
            }

            $idUtilisateur = $_SESSION["user"]["idUtilisateur"];
            $idRole = 1;

            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php";

            $data = [
                'idUtilisateur' => $idUtilisateur,
                'idGroupe' => $idGroupe,
                'idRole' => $idRole,
            ];

            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/json',
                    'content' => json_encode($data),
                ],
            ];

            $responseMembre = file_get_contents($url, false, stream_context_create($options));

            if ($responseMembre === FALSE) {
                header("Location: routeur.php?page=creerGroupe&error=api4");
                exit;
            }

            header('Location: routeur.php?page=groupes');
            exit;
        } catch (Exception $e) {
            header('Location: routeur.php?page=login&error=api');
            exit;
        }
    }
    else{
        header('Location: routeur.php?page=groupes');
    }
}
else{
    header('Location: routeur.php?page=groupes');
}
?>
