<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_SESSION["user"]["idUtilisateur"];
    try {
        $idGroupe = $_GET["idGroupe"];

        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
        $response = file_get_contents($url);
        $membres = json_decode($response, true);

        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/roles.php";
        $response = $response = file_get_contents($url);
        $roles = json_decode($response, true);

        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/groupes.php?idGroupe=$idGroupe";
        $response = $response = file_get_contents($url);
        $groupe = json_decode($response, true);


        for ($k = 0; $k < count($roles); $k++) {

            $staticListRoles[] = $roles[$k]["nomRole"];
            $staticListIdRoles[] = $roles[$k]["idRole"];

        }

        $url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/membres.php?groupeID=$idGroupe";
        $response = file_get_contents($url);
        $membres = json_decode($response, true);

        $countMembres = count($membres);
        $isAdmin = false;
        $isModerateur = false;
        $j = 0;
        while ($j < $countMembres and (!$isModerateur || $isAdmin)) {
            if ($membres[$j]["idUtilisateur"] == $id) {
                if ($membres[$j]["nomRole"] == "admin") {
                    $isAdmin = true;

                } elseif ($membres[$j]["nomRole"] == "moderateur") {
                    $isModerateur = true;
                }
            }

            $j++;
        }


        if (($isAdmin || $isModerateur) && $membres && $roles && $groupe) {

            $nomGroupe = $groupe[0]["nomGroupe"];
            echo "<header><h2 class=\"title\"> Membres du groupe </h2>";
            if (isset($_GET["nomUtilisateur"]) and isset($_GET["prenomUtilisateur"])) {
                $nom = $_GET["nomUtilisateur"];
                $prenom = $_GET["prenomUtilisateur"];
                if (isset($_GET["update"])) {
                    echo "<h3 class=\"titleInfo\">$prenom $nom modifié...</h3>";
                }
                if (isset($_GET["delete"])) {
                    echo "<h3 class=\"titleInfo\">$prenom $nom supprimé...</h3>";
                }
            } else {
                if (isset($_GET["update"])) {
                    echo "<h3 class=\"titleInfo\">Utilisateur modifié...</h3>";
                }
                if (isset($_GET["delete"])) {
                    echo "<h3 class=\"titleInfo\">Utilisateur supprimé...</h3>";
                }
            }
            echo "<div>";

            echo "<button class=\"header-btn\" onclick= \"window.location.href='routeur.php?page=invite-utilisateur-groupe&idGroupe=$idGroupe'; \"><i class=\"fa-solid fa-user-plus\"></i></button>";
            echo "</div></header><main>";
            echo "<table id=\"tabMembres\"><thead><tr><th class=\"thBorder\">Prénom</th><th class=\"thBorder\">Nom</th><th class=\"thBorder\">E-mail</th><th class=\"thBorder\">Rôle</th><th class=\"thBorder\">Modifier membre</th><th>Supprimer membre</th></tr></thead>";

            for ($i = 0; $i < count($membres); $i++) {
                $idMembre = $membres[$i]["idMembre"];
                $nomMembre = $membres[$i]["nomUtilisateur"];
                $prenomMembre = $membres[$i]["prenomUtilisateur"];
                $mailMembre = $membres[$i]["adresseMailUtilisateur"];
                $roleMembre = $membres[$i]["nomRole"];
                $idRoleMembre = $membres[$i]["idRole"];

                $listRoles = [$roleMembre];
                $listIdRoles = [$idRoleMembre];



                for ($j = 0; $j < count($staticListRoles); $j++) {
                    if ($staticListRoles[$j] != $roleMembre) {
                        if ($isModerateur) {
                            if ($staticListIdRoles[$j] != 1) {
                                $listRoles[] = $staticListRoles[$j];
                                $listIdRoles[] = $staticListIdRoles[$j];
                            }
                        } else {
                            $listRoles[] = $staticListRoles[$j];
                            $listIdRoles[] = $staticListIdRoles[$j];
                        }
                    }
                }
                ;

                if ($i != count($membres) - 1) {
                    echo "<tr>";
                    echo "<td class=\"tdBorder\">$prenomMembre</td>";
                    echo "<td class=\"tdBorder\">$nomMembre</td>";
                    echo "<td class=\"tdBorder\">$mailMembre</td>";
                    if ($roleMembre == "admin") {
                        echo "<td class=\"tdBorder\">Administrateur</td>";
                        echo "<td class=\"tdBorder\"><button class=\"buttonAdmin\">Modifier</button></td>";
                        echo "<td class=\"tdBorderRight\"><button class=\"buttonAdmin\">Supprimer</button></td></tr>";
                    } else {
                        echo "<td class=\"tdBorder\"><select id=\"$idMembre\">";
                        for ($z = 0; $z < count($listIdRoles); $z++) {
                            echo "<option value=\"" . $listIdRoles[$z] . "\">" . $listRoles[$z] . "</option>";
                        }
                        echo "</select></td>";
                        echo "<td class=\"tdBorder\"><button value=$idMembre class=\"buttonModifier\">Modifier</button></td>";
                        echo "<td class=\"tdBorderRight\"><button onclick= \"window.location.href='routeur.php?page=supprimerMembreController&idGroupe=$idGroupe&idMembre=$idMembre'; \">Supprimer</button></td></tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td class=\"tdBorderBottom\">$prenomMembre</td>";
                    echo "<td class=\"tdBorderBottom\">$nomMembre</td>";
                    echo "<td class=\"tdBorderBottom\">$mailMembre</td>";
                    if ($roleMembre == "admin") {
                        echo "<td class=\"tdBorderBottom\">Administrateur</td>";
                        echo "<td class=\"tdBorderBottom\"><button class=\"buttonAdmin\">Modifier</button></td>";
                        echo "<td><button class=\"buttonAdmin\">Supprimer</button></td></tr>";
                    } else {
                        echo "<td class=\"tdBorderBottom\"><select id=\"$idMembre\">";
                        for ($z = 0; $z < count($listIdRoles); $z++) {
                            echo "<option value=\"" . $listIdRoles[$z] . "\">" . $listRoles[$z] . "</option>";
                        }
                        echo "</select></td>";
                        echo "<td class=\"tdBorderBottom\"><button value=$idMembre class=\"buttonModifier\">Modifier</button></td>";
                        echo "<td><button onclick= \"window.location.href='routeur.php?page=supprimerMembreController&idGroupe=$idGroupe&idMembre=$idMembre'; \">Supprimer</button></td></tr>";
                    }



                }

            }

            echo "</table>";
            echo "<script>";

            echo "function buttonClick(event) {";
            echo "let idMembre = event.target.value;";
            echo "let roleSelected = document.getElementById(\"\"+idMembre).value;";
            echo "window.location.href = 'routeur.php?page=modifierRolesGroupeController&idGroupe=$idGroupe&idMembre=' + idMembre + '&idRole=' + roleSelected";
            echo "}";

            echo "let allButtonsModifier = document.querySelectorAll(\".buttonModifier\");";
            echo "for (let i = 0; i < allButtonsModifier.length; i++) {";
            echo "allButtonsModifier[i].addEventListener(\"click\", function (event) {";
            echo "buttonClick(event);";
            echo "});";
            echo "}";

            echo "</script>";



            exit;

        } else {
            header('Location: routeur.php?page=groupes');
        }
    } catch (Exception $e) {
        header('Location: routeur.php?page=login&error=api');
        exit;
    }
} else {
    header('Location: routeur.php?page=login');
    exit;
}
?>