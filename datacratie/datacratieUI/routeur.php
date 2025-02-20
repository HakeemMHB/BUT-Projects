<?php
session_start();

$pages = [
    'accueil' => 'accueil.html',
    'groupes' => 'groupes.php',
    'creerGroupe' => 'creer-groupe.php',
    'propositions' => 'propositions.php',
    'vote' => 'vote.php',
    'login' => 'login.php',
    'loginController' => 'loginController.php',
    'register' => 'register.php',
    'registerController' => 'registerController.php',
    'gerer-utilisateur-groupe' => 'gerer-utilisateur-groupe.php',
    'userProfil' => 'userProfil.php',
    'creerProposition' => 'creer-proposition.php',
    'lancerVoteEtape0' => 'lancement-vote.php',
    'lancerVoteEtape1' => 'lancement-vote-nbscrutins.php',
    'lancerVoteEtape2' => 'lancement-vote-scrutins.php',
    'lancementVoteController' => 'lancementVoteScrutinsController.php',
    'voteController' => 'voteController.php',
    'creerGroupeController' =>'creerGroupeController.php',
    'creerPropositionController' =>'creerPropositionController.php',
    'invite-utilisateur-groupe' => 'invite-utilisateur-groupe.php',
    'supprimerMembreController' => 'supprimerMembreController.php',
    'modifierRolesGroupeController' => 'modifierRolesGroupeController.php',
    'deconnexion' => 'deconnexion.php',
    'suppressionUtilisateur' => 'suppressionUtilisateur.php',
    'ajouterCommentaireController' => 'ajouterCommentaireController.php',
    'groupeInvitationController' => 'groupeInvitationController.php',
    'supprimerGroupeController' => 'supprimerGroupeController.php',
    'resultatVote' => 'resultatVote.php',
];

function route($uri)
{
    global $pages;
    if (array_key_exists($uri, $pages)) {
        return $pages[$uri];
    } else {
        return '404';
    }
}

$page=route('accueil');

if (isset($_GET["page"])) {
    $page = route($_GET["page"]);
}

require("src/views/debut.php");
if ($page === '404') {
    require("src/views/404.html");
} else {
    if($page === 'loginController.php' || $page === 'supprimerGroupeController.php' || $page === 'groupeInvitationController.php' || $page === 'ajouterCommentaireController.php' || $page === 'deconnexion.php' || $page === 'suppressionUtilisateur.php' || $page === 'registerController.php' || $page === 'creerGroupeController.php' || $page === 'creerPropositionController.php' || $page === 'supprimerMembreController.php' || $page === 'modifierRolesGroupeController.php' || $page === 'lancementVoteScrutinsController.php' || $page === 'voteController.php') {
        require("src/controllers/$page");
    } else {
        require("src/views/$page");
    }
}
require("src/views/fin.php");
?>
