<?php
    $idProp = $_GET['idProp'];
    $idGroupe = $_GET['idGroupe'];
  if (isset($_POST['scrutins']) && is_array($_POST['scrutins'])) {
    $scrutins = $_POST['scrutins'];

    foreach ($scrutins as $scrutin) {
        $data = [
            "idProposition" => $idProp,
            "nom" => $scrutin
        ];

        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/scrutin.php";
        $options = [
            "http" => [
                "header"  => "Content-Type: application/json",
                "method"  => "POST",
                "content" => json_encode($data),
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            echo "Erreur lors de l'ajout du scrutin.";
        }
    }
  }
    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/vote.php";
    $data = 
    ["idProposition" => $idProp,
    'estLancer' => true
    ];

    $options = [
        "http" => [
            "header"  => "Content-Type: application/json",
            "method"  => "PUT",
            "content" => json_encode($data),
        ]
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    header("Location: routeur.php?page=vote&idProp=$idProp&idGroupe=$idGroupe");
    exit;
?>
