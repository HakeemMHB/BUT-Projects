
<header>
  <h2 class="title">Vos groupes</h2>
  <button class="header-btn" onClick="window.location.href='routeur.php?page=creerGroupe';">+</button>
</header>
    <main>
      <!-- <pre><?php print_r($_SESSION); ?></pre> -->
      <?php
      //  echo "<h2>".$_SESSION["user"]["idUtilisateur"]."</h2>";
        require_once("src/controllers/groupe.php");
      ?>
    </main>
    