<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_SESSION["user"])){
        try {
            $idUser = $_SESSION["user"]["idUtilisateur"];
            $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/utilisateurs.php?idUtilisateur=$idUser";
            $response = file_get_contents($url);
            $user = json_decode($response, true);

            if($user){
                $email = $user["adresseMailUtilisateur"];
                $nom = $user["nomUtilisateur"];
                $prenom = $user["prenomUtilisateur"];
                $adressePostale = $user["adressePostaleUtilisateur"];


                echo "<header>";
                echo "<h2 class=\"title\">Votre profil</h2>";
                echo "<div id=\"userButtons\" class=\"header-btn\"> <button onclick= \"window.location.href='routeur.php?page=deconnexion'; \"> Se déconnecter </button>";
                echo "<button onclick= \"window.location.href='routeur.php?page=suppressionUtilisateur'; \"> Supprimer compte </button> </div>";
                echo "</header>";
                echo "<main>";
                echo "<p class=\"info\"> E-mail </p>";
                echo "<p class=\"userInfo\"> $email </p>";
                echo "<p class=\"info\"> Nom </p>";
                echo "<p class=\"userInfo\"> $nom </p>";
                echo "<p class=\"info\"> Prenom </p>";
                echo "<p class=\"userInfo\"> $prenom </p>";
                echo "<p class=\"info\"> Adresse Postale </p>";
                echo "<p class=\"userInfo\"> $adressePostale </p>";
                echo "</main>";
                

            }
        } catch (Exception $e) {

        }
    } else {
        header('Location: routeur.php?page=login');
    }
}