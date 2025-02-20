<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $mdp = $_POST['mdp'];
    $confirmMdp = $_POST['confirmMdp'];

    if ($mdp !== $confirmMdp) {
        header("Location: routeur.php?page=register&error=password");
        exit;
    }

    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/utilisateurs.php?email=$email";
    $response = file_get_contents($url);
    $user = json_decode($response, true);

    if ($user && isset($user['adresseMailUtilisateur'])) {
        header("Location: routeur.php?page=register&error=email");
        exit;
    }
    
    
    //$mdp = password_hash($mdp, PASSWORD_DEFAULT);
    
    $apiUrl = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/utilisateurs.php";
    $data = [
        'nomUtilisateur' => $nom,
        'prenomUtilisateur' => $prenom,
        'adressePostaleUtilisateur' => $adresse,
        'adresseMailUtilisateur' => $email,
        'passwordUser' => $mdp,
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    if ($response === FALSE) {
        header("Location: routeur.php?page=register&error=api1");
        exit;
    }

    $responseData = json_decode($response, true);

    $response = file_get_contents($url);
    $user = json_decode($response, true);

    if (isset($responseData['message']) && $responseData['message'] == 'Ajout utilisateur success') {
        if(isset($_POST["idRole"]) and isset($_POST["idGroupe"])){
            if($_POST["idRole"] != -1 and $_POST["idGroupe"] != -1){
                $urlInvitation = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/invitations.php?adresseMail=".urlencode($email);
                $response = file_get_contents($urlInvitation);
                $invitations = json_decode($response, true);


                if($invitations){
                    $urlMembre = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php";
                    $id = $user["idUtilisateur"];
                    $idRole = $_POST["idRole"];
                    $idGroupe = $_POST["idGroupe"];
                    $trueInvitation = false;
                    for($i = 0; $i < count($invitations); $i++){
                        if($invitations[$i]["idRole"] == $idRole and $invitations[$i]["idGroupe"] == $idGroupe){
                            $trueInvitation = true;
                        }
                    }
                    if($trueInvitation) {
                        $joinGroupe = [
                            'idGroupe' => $idGroupe,
                            'idUtilisateur' => $id,
                            'idRole' => $idRole,
                        ];

                        $options = [
                            'http' => [
                                'method' => 'POST',
                                'header' => 'Content-Type: application/json',
                                'content' => json_encode($joinGroupe),
                            ]

                        ];

                        
                        $context = stream_context_create($options);

                        $response = file_get_contents($urlMembre, false, $context);

                        $urlAllInvitations = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/invitations.php";

                        $deleteInvitation = ["adresseMail" => $email];

                        $options = [
                            'http' => [
                                'method' => 'DELETE',
                                'header' => 'Content-Type: application/json',
                                'content' => json_encode($deleteInvitation),
                            ]

                        ];

                        $context = stream_context_create($options);

                        $response = file_get_contents($urlAllInvitations, false, $context);

                        $_SESSION['user'] = $user;
                        header("Location: routeur.php?page=groupes");
                        exit;
                    }
                }
            }
        }
        $_SESSION['user'] = $user;
        header('Location: routeur.php?page=groupes');
        exit;
    } else {
        header("Location: routeur.php?page=register&error=api2");
        exit;
    }

} else {
    header("Location: routeur.php?page=register");
    exit;
}
?>
