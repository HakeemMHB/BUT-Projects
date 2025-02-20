<?php
  if (!isset($_POST["nbScrutins"])) {
    $id = $_GET["idProp"];
    $idGroupe = $_GET["idGroupe"];
    header("Location: routeur.php?page=lancerVoteEtape0&idProp=$id&idGroupe=$idGroupe");
    exit();
  }
  $nbScrutins = $_POST["nbScrutins"];
?>

<h2 class="title">Lancement du vote</h2>
<div class="progression-box">
  <div class="progressionA"></div>
  <div class="progressionA"></div>
</div>
<main>
  <?php
    $id = $_GET["idProp"];
    $idGroupe = $_GET["idGroupe"];
    echo "<form action=\"routeur.php?page=lancementVoteController&idProp=$id&idGroupe=$idGroupe\" method=\"post\">";
  ?>
    <div class="main-mid">
    <?php for ($i = 1; $i <= $nbScrutins; $i++) :
      echo "<label for=\"scrutin-$i\">Nom du scrutin $i:</label>";
      echo "<input type=\"text\" id=\"scrutin-$i\" name=\"scrutins[]\" required>";
    endfor; ?>
    </div>
    <button type="submit">Lancer le vote</button>
  </form>
</main>
