<?php
if (isset($_SESSION["user"])) {
    try {
        $idUser = $_SESSION["user"]["idUtilisateur"];
        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/utilisateurs.php";

        $userToDelete = ["idUtilisateur" => $idUser];
        $options = [
            'http' => [
                'method' => 'DELETE',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($userToDelete),
            ]

        ];
        $context = stream_context_create($options);

        $response = file_get_contents($url, false, $context);

        session_destroy();

        header('Location: routeur.php');



    } catch (Exception $e) {

    }
} else {
    header('Location: routeur.php?page=login');
}
?>