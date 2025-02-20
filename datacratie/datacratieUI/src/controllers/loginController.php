<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['mdp'];

    try {
        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/utilisateurs.php?email=".urlencode($email);
        $response = file_get_contents($url);
        $user = json_decode($response, true);

        if ($user && isset($user['passwordUser']) && $user['passwordUser'] === $password) {
        //if ($user && isset($user['passwordUser']) && password_verify($user['passwordUser'] ,$password)) {
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
            header('Location: routeur.php?page=login&error=invalid');
            exit;
        }
    } catch (Exception $e) {
        header('Location: routeur.php?page=login&error=api');
        exit;
    }
} else {
    header('Location: routeur.php?page=login');
    exit;
}
?>
