<?php 
  require_once("src/controllers/creerPropositionRedirectController.php");
?>
<h2 class="title">Création d'une proposition</h2>
<main>
<form action="routeur.php?page=creerPropositionController&idGroupe=<?php echo $_GET['idGroupe']; ?>" method="post">
  <div class="champs">
  <div class="main-mid">
    <label for="titre-proposition">Intitulé</label>
    <input type="text" id="titre-proposition" name="titre-proposition" required/>
    <label for="desc-proposition">Description</label>
    <textarea id="desc-groupe" name="desc-proposition" required></textarea>
  </div>
  <div class="main-right">
    <label for="etiquette-groupe">Etiquette</label>
    <div class="etiquette-groupe">
      <div class="etiquette-ajouter" id="ajouter-etiquette">ajouter +</div>
    </div>
    <input type="hidden" id="etiquettes" name="etiquettes" value=""/>
  </div>
  </div>
  <button type="submit" name="submit">+ Soumettre la proposition</button>
  </form>
</main>

<div id="popup-etiquette" class="popup">
  <div class="popup-content">
    <h2>Ajouter une étiquette</h2>
    <input type="text" id="nouvelle-etiquette" placeholder="Entrez l'étiquette" />
    <button id="ajouter-etiquette-btn">Ajouter</button>
  </div>
</div>

<script>
  let popup = document.getElementById("popup-etiquette");
  let btn = document.getElementById("ajouter-etiquette");
  let back = document.getElementById("popup-etiquette");
  let ajouter = document.getElementById("ajouter-etiquette-btn");
  let etiquetteInput = document.getElementById("etiquettes");
  let etiquette = [];
  let classesCouleurs = ["etiquette1", "etiquette2", "etiquette3", "etiquette4"];

  btn.onclick = function() {
    popup.style.display = "block";  
  }

  ajouter.onclick = function() {
    let etiquetteDiv = document.createElement("div");
    let couleurAleatoire = classesCouleurs[Math.floor(Math.random() * classesCouleurs.length)];
    etiquetteDiv.classList.add(couleurAleatoire);

    let newEtiquette = document.getElementById("nouvelle-etiquette").value;
    if(newEtiquette.trim() !== "") {
      etiquetteDiv.innerHTML = newEtiquette;
      document.querySelector(".etiquette-groupe").insertBefore(etiquetteDiv, btn);
      etiquette.push(newEtiquette);
      etiquetteInput.value = JSON.stringify(etiquette);
    }
    document.getElementById("nouvelle-etiquette").value = "";
    popup.style.display = "none";
  }

  back.onclick = function(event) {
    if (event.target === back) {
      popup.style.display = "none";
    }
  }
</script>