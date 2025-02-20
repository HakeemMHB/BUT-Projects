<main>
  <div>
    <div id="authContent">
      <form action="routeur.php?page=loginController" method="post">
        <!-- <input type="hidden" name="page" value="loginController" /> -->
        <input type="hidden" name="idRole" value=<?php if(isset($_GET["idRole"])) echo $_GET["idRole"]; else echo -1; ?> />
        <input type="hidden" name="idGroupe" value=<?php if(isset($_GET["idGroupe"])) echo $_GET["idGroupe"]; else echo -1 ?> />
        <div class="grid grid-rows-5 m-16 gap-4">
          <div>
            <h1 class="text-3xl">Connexion à DataCratie</h1>
          </div>
          <div>
            <input
              type="text"
              id="email"
              class="p-2"
              name="email"
              placeholder="Adresse e-mail"
              required
            />
          </div>
          <div>
            <input
              type="password"
              id="mdp"
              class="p-2"
              name="mdp"
              placeholder="Mot de passe"
              required
            />
          </div>
          <div>
            <button class="p-2 button" type="submit">Connexion</button>
          </div>
          <div>
            <a class="text-[#123AA5]" href=<?php if(isset($_GET["idRole"]) and isset($_GET["idGroupe"])) echo "routeur.php?page=register&idRole=".$_GET["idRole"]."&idGroupe=".$_GET["idGroupe"]; else echo "routeur.php?page=register"; ?>
              >Cliquez ici s'il s'agit de votre première connexion</a
            >
            <?php 
              if(isset($_GET["error"])){
                echo "<section class=\"bg-red-500/50 border-4 border-red-500/75 rounded-md pl-1\"><p>Le mot de passe ou l'email n'est pas correct</p></section>";
              }
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
