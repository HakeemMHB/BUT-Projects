<?php
  if (isset($_POST["type"]) && $_POST["type"] !== "personaliser") {
    $id = $_GET["idProp"];
    $idGroupe = $_GET["idGroupe"];
    $type = isset($_POST["type"]) ? $_POST["type"] : "";

    if ($type === "booleen") {
        $data["choix"] = ["Oui", "Non"];
    } else if ($type === "accord") {
        $data["choix"] = ["Je suis d'accord", "Je ne suis pas d'accord"];
    } else {
        header("Location: routeur.php?page=vote&idProp=$idProp&idGroupe=$idGroupe");
        exit;
      }

    $success = true;

    for ($i = 0; $i < count($data["choix"]); $i++) {
        $choix = $data["choix"][$i];

        $dataItem = [
            "idProposition" => $id,
            "nom" => $choix
        ];

        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/scrutin.php";
        $options = [
            "http" => [
                "header"  => "Content-Type: application/json",
                "method"  => "POST",
                "content" => json_encode($dataItem),
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            $success = false;
            echo "Erreur ajout scrutin";
            break;
        }
    }

    if ($success) {
        header("Location: routeur.php?page=lancementVoteController&idProp=$id&idGroupe=$idGroupe");
        exit;
    }
  }
?>
<h2 class="title">Lancement du vote</h2>
  <div class="progression-box">
    <div class="progressionA"></div>
    <div class="progressionB"></div>
  </div>
<main>
  <?php
  $id = $_GET["idProp"];
  $idGroupe = $_GET["idGroupe"];
  echo "<form action=\"routeur.php?page=lancerVoteEtape2&idProp=$id&idGroupe=$idGroupe\" method=\"post\">";
  ?>
  <div class="main-mid">
    <label for="titre-proposition">Combien de scrutins souhaitez-vous pour cette proposition ?</label>
    <input type="number" min="2" id="titre-proposition" name="nbScrutins"/>
  </div>
  <button type="submit" id="creer-proposition">Continuer</button>
  </form>
</main>
