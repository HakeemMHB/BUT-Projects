<?php
    $idProp = $_GET['idProp'];
    $idGroupe = $_GET['idGroupe'];
    if(isset($_GET['fin'])){
        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/vote.php?idProp=$idProp";
        $response = file_get_contents($url);
        $vote = json_decode($response, true);
        $isLaunched = $vote[0]["estLancer"];

        if($isLaunched){
            $data = json_encode([
                'idProposition' => $idProp,
                'estTerminer' => true
            ]);

            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json",
                    'method'  => 'PUT',
                    'content' => $data,
                ],
            ];

            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            header("Location: routeur.php?page=vote&idProp=$idProp&idGroupe=$idGroupe");
        } else {
            echo "<h2>Une erreur s'est produite</h2>";
        }
    }
    $idUtilisateur = $_SESSION['user']['idUtilisateur'];

    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?userID=$idUtilisateur&groupeID=$idGroupe";
    $response = file_get_contents($url);
    $groupes = json_decode($response, true);
    $idMembre = $groupes[0]["idMembre"];

    $data = [
        'idMembre' => $idMembre,
        'numScrutin' => $_GET['id'],
    ];
    
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

    header("Location: routeur.php?page=vote&idProp=$idProp&idGroupe=$idGroupe");
?>