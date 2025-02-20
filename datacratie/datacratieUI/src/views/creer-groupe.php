<?php if(!isset($_SESSION["user"])) header('Location: routeur.php?page=login');?>
<h2 class="title">Création d'un groupe</h2>
<main>
  <form
    action="routeur.php?page=creerGroupeController"
    method="post"
    enctype="multipart/form-data"
  >
    <div class="champs">
      <div class="main-left">
        <input
          type="file"
          id="image-groupe"
          name="image-groupe"
          accept="image/*"
          hidden
        />
        <label for="image-groupe" class="add-image-groupe"
          >+ Ajouter une image</label
        >
        <input
          type="color"
          name="color-groupe"
          id="color-groupe"
          value="#974A4A"
        />
      </div>
      <div class="main-mid">
        <label for="nom-groupe">Nom du groupe</label>
        <input type="text" id="nom-groupe" name="nom-groupe" />
        <label for="desc-groupe">Description</label>
        <textarea id="desc-groupe" name="desc-groupe"></textarea>
      </div>
      <div class="main-right">
        <label for="etiquette-groupe">Etiquette</label>
        <div class="etiquette-groupe">
          <div class="etiquette-ajouter" id="ajouter-etiquette">ajouter +</div>
        </div>
          <input type="hidden" id="etiquettes" name="etiquettes" value=""/>
      </div>
    </div>
    <button type="submit" name="submit">+ Créer le groupe</button>
  </form>
</main>

<div id="popup-etiquette" class="popup">
  <div class="popup-content">
    <h2>Ajouter une étiquette</h2>
    <input
      type="text"
      id="nouvelle-etiquette"
      placeholder="Entrez l'étiquette"
    />
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