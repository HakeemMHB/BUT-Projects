<?php
    $idProp = $_GET['idProp'];
    $idGroupe = $_GET['idGroupe'];

    $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/scrutin.php?idProp=$idProp";
    $response = file_get_contents($url);
    $scrutins = json_decode($response, true);
    echo "<div class='scrutin-box'>";
    foreach ($scrutins as $scrutin) {
        $nb = $scrutin['numScrutin'];
        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/vote.php?scrutin=$nb";
        $response = file_get_contents($url);
        $vote = json_decode($response, true);

        $votesScrutin = $vote[0]["nombreVotesScrutin"] ?? 0;
        echo "<div class='border'>";
        echo "<div class='scrutin'><h2>{$scrutin['nomScrutin']} - $votesScrutin</h2></div>";
        for($i = 0; $i < $votesScrutin; $i++) {
            echo "<div class='vote'></div>";
        }
        echo "</div>";
    }
    echo "</div>";
?>