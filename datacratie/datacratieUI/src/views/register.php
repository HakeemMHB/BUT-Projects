<main>
  <div id="authContent">
    <form action="routeur.php?page=registerController" method="POST">
      <input type="hidden" name="idRole" value=<?php if(isset($_GET["idRole"])) echo $_GET["idRole"]; else echo -1; ?> />
      <input type="hidden" name="idGroupe" value=<?php if(isset($_GET["idGroupe"])) echo $_GET["idGroupe"]; else echo -1 ?> />
      <div class="grid grid-rows-9 m-16 gap-1">
        <div>
          <h1 class="text-3xl">Création de votre compte DataCratie</h1>
        </div>
        <div>
          <label for="nom">Nom</label>
          <input
            type="text"
            id="nom"
            class="p-2"
            name="nom"
            placeholder="Nom"
            required
          />
        </div>
        <div>
          <label for="prenom">Prénom</label>
          <input
            type="text"
            id="prenom"
            class="p-2"
            name="prenom"
            placeholder="Prénom"
            required
          />
        </div>
        <div>
          <label for="email">Adresse e-mail</label>
          <input
            type="email"
            id="email"
            class="p-2"
            name="email"
            placeholder="Adresse e-mail"
            required
          />
        </div>
        <div>
          <label for="adresse">Adresse Postale</label>
          <input
            type="text"
            id="adresse"
            class="p-2"
            name="adresse"
            placeholder="Adresse Postale"
            required
          />
        </div>
        <div>
          <label for="mdp">Mot de passe</label>
          <input
            type="password"
            id="mdp"
            class="p-2"
            name="mdp"
            placeholder="******"
            required
          />
        </div>
        <div>
          <label for="confirmMdp">Saisissez le mot de passe à nouveau</label>
          <input
            type="password"
            id="confirmMdp"
            class="p-2"
            name="confirmMdp"
            placeholder="******"
            required
          />
        </div>
        <div>
          <button class="p-2 mt-4 button" type="submit">
            Créer votre compte
          </button>
        </div>
        <div>
          <a class="text-[#123AA5]" href=<?php if(isset($_GET["idRole"]) and isset($_GET["idGroupe"])) echo "routeur.php?page=login&idRole=".$_GET["idRole"]."&idGroupe=".$_GET["idGroupe"]; else echo "routeur.php?page=login"; ?>
            >Cliquez ici si vous avez déjà un compte</a
          >
          <?php 
              if(isset($_GET["error"])){
                if($_GET["error"] == "email"){
                  echo "<section class=\"bg-red-500/50 border-4 border-red-500/75 rounded-md pl-1\"><p>Un compte existe déjà avec cette e-mail</p></section>";
                }
                elseif($_GET["error"] == "password"){
                  echo "<section class=\"bg-red-500/50 border-4 border-red-500/75 rounded-md pl-1\"><p>Vous n'avez pas saisi deux fois le même mot de passe</p></section>";
                }
              }
            ?>
        </div>
      </div>
    </form>
  </div>
</main>
