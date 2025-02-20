<?php
require_once("src/controllers/vote.php");
?>
<div class="commentaire">
  <div class="create-comment">
    <textarea id="add-comment" placeholder="Ajouter un commentaire"></textarea>
    <button id="buttonAddComment" class="btn-comment">Envoyer</button>
  </div>
  
  <script>
    function buttonClick() {
      let contentCommentaire = document.getElementById("add-comment").value;
      let idProp = <?php echo json_encode($_GET["idProp"]); ?>;
      let idGroupe = <?php echo json_encode($_GET["idGroupe"]); ?>;
      window.location.href = "routeur.php?page=ajouterCommentaireController&idProp=" + idProp + "&idGroupe=" + idGroupe + "&contentCommentaire=" + contentCommentaire;
    }
    document.getElementById("buttonAddComment").addEventListener("click", function (event) { buttonClick(event); });

  </script>
  <?php require_once("src/controllers/commentairesVote.php"); ?>
</div>