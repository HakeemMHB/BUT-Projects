<?php if(isset($_GET["page"])) : ?>
    <?php if(($_GET["page"]=="creerGroupe") or ($_GET["page"]=="groupes") or ($_GET["page"]=="propositions") or ($_GET["page"]=="vote")or ($_GET["page"]=="gerer-utilisateur-groupe") or ($_GET["page"]=="userProfil") or ($_GET["page"]=="creerProposition") or ($_GET["page"]=="lancerVoteEtape0") or ($_GET["page"]=="lancerVoteEtape1") or ($_GET["page"]=="lancerVoteEtape2") or ($_GET["page"]=="invite-utilisateur-groupe") or ($_GET["page"]=="resultatVote")): ?>
            <nav>
                <div class="nav-top">
                    <div class="nav-logo">
                        <a href="./routeur.php?page=groupes">
                            <img src="./public/assets/logo-arrondi.png" alt="" />
                        </a>   
                        <h1>DataCratie</h1>
                    </div>
                    <div class="nav-pages">
                        <a href="./routeur.php?page=groupes">
                            <h2>Mes Groupes</h2>
                        </a>
                    </div>
                    <div class="nav-compte">
                    <a href="routeur.php?page=userProfil"><img src="./public/assets/compte.png"></img></a>
                    </div>
                </div>
            </nav>
    <?php elseif (($_GET["page"]=="login") or ($_GET["page"]=="register")) : ?>
        <nav>
            <div class="nav-top">
                <div class="nav-logo">
                    <a href="./routeur.php">
                        <img src="./public/assets/logo.png" alt="" />
                    </a>
                        <h1>DataCratie</h1>
                </div>
            </div>
        </nav>
    <?php else : ?>
        <nav>
                <div class="nav-top">
                    <div class="nav-logo">
                        <a href="./routeur.php?page=groupes">
                            <img src="./public/assets/logo-arrondi.png" alt="" />
                        </a>   
                        <h1>DataCratie</h1>
                    </div>
                    <div class="nav-pages">
                        <a href="./routeur.php?page=groupes">
                            <h2>Mes Groupes</h2>
                        </a>
                    </div>
                    <div class="nav-compte">
                    <a href="routeur.php?page=userProfil"><img src="./public/assets/compte.png"></img></a>
                    </div>
                </div>
            </nav>
    <?php endif ?>
<?php else : ?> 
    <nav>
        <div class="nav-top">
            <div class="nav-logo">
                <img src="./public/assets/logo.png" alt="" />
                <h1>DataCratie</h1>
            </div>
        </div>
    </nav>
<?php endif ?>

