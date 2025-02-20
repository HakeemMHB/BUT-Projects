<?php 
    if(isset($_GET["page"])){
        if($_GET["page"]!="login" and $_GET["page"]!="register" and $_GET["page"]!="vote" and $_GET["page"] != "creerGroupe" and $_GET["page"] != "creerProposition" and $_GET["page"] != "lancerVoteEtape0" and $_GET["page"] != "lancerVoteEtape1" and $_GET["page"] != "lancerVoteEtape2"){
            echo "<footer>Hakeem BHATOO - Lucas PIVET - Matthieu GAYMAY</footer>";
        }
    }
    else{
        echo "<footer>Hakeem BHATOO - Lucas PIVET - Matthieu GAYMAY</footer>";
    }
?>