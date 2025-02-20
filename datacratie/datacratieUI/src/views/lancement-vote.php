<?php
  $idProp = $_GET["idProp"];
  $idGroupe = $_GET["idGroupe"];

  $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/propositions.php?idGroupe=$idGroupe&idProp=$idProp";
  $response = file_get_contents($url);
  $propositions = json_decode($response, true);
  $nomProposition = $propositions[0]["nomProposition"];
  $descProposition = $propositions[0]["descriptionProposition"];
  $idMembreCreateur = $propositions[0]["idMembre"];

  $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe&membreID=$idMembreCreateur";
  $response = file_get_contents($url);
  $membres = json_decode($response, true);
  $createur = $membres[0]["prenomUtilisateur"]." ".$membres[0]["nomUtilisateur"];
?>

<h2 class="title">Lancement du vote</h2>
<main>
    <?php
      $idProp = $_GET["idProp"];
      $idGroupe = $_GET["idGroupe"];
      echo "<form action=\"routeur.php?page=lancerVoteEtape1&idProp=$idProp&idGroupe=$idGroupe\" method=\"post\">";
    ?>
    <div class="champs">
    <div class="main-mid main-midV">
      <label for="desc-proposition">Type de vote</label>
      <select name="type" id="vote-select">
        <option value="">Selectionner un type de vote</option>
        <option value="booleen">Oui/Non</option>
        <option value="accord">Je suis d'accord/Je ne suis pas d'accord</option>
        <option value="personaliser">Personaliser</option>
      </select>
      <label for="nom-prop">Durée du vote</label>
      <input type="number" disabled id="nom-prop" name="duree-prop" />
      <label for="nom-prop">Vote Anonyme</label>
      <input type="checkbox" disabled id="duree-prop" name="duree-prop" />
    </div>
    <div class="main-right">
      <label for="nom-prop">Intitulé</label>
      <input type="text" readonly id="nom-prop" name="nom-prop" placeholder="<?php echo $nomProposition ?>"/>
      <label for="desc-prop">Description</label>
      <textarea id="desc-prop" readonly name="desc-prop"><?php echo $descProposition ?></textarea>
      <label for="nom-prop">Proposé par</label>
      <input type="text" readonly id="nom-prop" name="nom-prop" placeholder="<?php echo $createur ?>"/>
    </div>
    </div>
    <button type="submit" id="creer-proposition">Continuer</button>
  </form>
</main>