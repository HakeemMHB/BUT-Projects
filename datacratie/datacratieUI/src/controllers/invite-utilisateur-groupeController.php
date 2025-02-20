<?php
if (isset($_SESSION["user"])) {
  if (!isset($_GET['idGroupe'])) {
    header('Location: routeur.php?page=groupes');
  } else {

    

    $idGroupe = $_GET['idGroupe'];

    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
    $response = file_get_contents($url);
    $membres = json_decode($response, true);

    $id = $_SESSION["user"]["idUtilisateur"];
    $countMembres = count($membres);
    $isAdmin = false;
    $j = 0;
    while ($j < $countMembres and !$isAdmin) {
      if ($membres[$j]["idUtilisateur"] == $id && ($membres[$j]["nomRole"] == "admin" || $membres[$j]["nomRole"] == "moderateur")) {
        $isAdmin = true;
      }
      $j++;
    }
    if (!$isAdmin) {
      header('Location: routeur.php?page=groupes');
    }

    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/groupes.php?idGroupe=$idGroupe";
    $response = $response = file_get_contents($url);
    $groupe = json_decode($response, true);
    if ($groupe) {
      $nomGroupe = $groupe[0]["nomGroupe"];
    } else {
      header('Location: routeur.php?page=groupes');
    }
  }
} else {
  header('Location: routeur.php?page=login');
}
?>