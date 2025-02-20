<?php require_once("src/controllers/invite-utilisateur-groupeController.php"); ?>
<h2 class="title">Inviter un membre</h2>
<main>

  <div class="champs">
    <div class="main-mid">
      <label id="labelEmail">Adresse e-mail de la personne à inviter</label>
      <input type="email" id="adresseMail" name="adresseMail" />
      <?php require_once("src/controllers/selectRoleForInvitation.php") ?>
    </div>
  </div>
  <button id="buttonInviter" style="margin-left: 25px">+ Inviter</button>


  <script>
    function buttonClick() {
      let textFieldEmail = document.getElementById("adresseMail").value;
      let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (regex.test(textFieldEmail)) {
        let selectRole = document.getElementById("selectRole").value;
        let nomGroupe = <?php echo json_encode($nomGroupe); ?>;
        let idGroupe = <?php echo json_encode($idGroupe); ?>;
        let mailToLink = 'mailto:' + encodeURIComponent(textFieldEmail) +
          '?Subject=' + encodeURIComponent('Invitation au groupe démocratique ' + nomGroupe) +
          '&body=' + encodeURIComponent('Bonjour, je vous invite à rejoindre le groupe ' + nomGroupe + ' sur Datacratie. Cliquez sur ce lien pour rejoindre mon groupe : ' +
            'https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/routeur.php?page=login&idRole=' + selectRole + '&idGroupe=' + idGroupe);

        window.location.href = mailToLink;

        window.location.href = "routeur.php?page=groupeInvitationController&idGroupe=" + idGroupe + "&nomGroupe=" + nomGroupe + "&email=" + encodeURIComponent(textFieldEmail) + "&idRole=" + selectRole;
      } else {
        console.log("Ce n'est pas un email");
        let testLabel = document.getElementById("labelEmail").textContent;
        if (!(testLabel.includes("- Erreur mail"))) {
          document.getElementById("labelEmail").textContent = document.getElementById("labelEmail").textContent + ` - Erreur mail`;
        }
      }
    }
    document.getElementById("buttonInviter").addEventListener("click", buttonClick);
  </script>

</main>


<!-- <div id="popup-etiquette" class="popup">
  <div class="popup-content">
    <h2>Ajouter une étiquette</h2>
    <input
      type="text"
      id="nouvelle-etiquette"
      placeholder="Entrez l'étiquette"
    />
    <button id="ajouter-etiquette-btn">Ajouter</button>
  </div>
</div> -->