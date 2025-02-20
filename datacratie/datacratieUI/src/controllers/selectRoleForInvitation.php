<?php
$url = "https://projets.iut-orsay.fr/saes3-lpivet/datacratieUI/src/api/roles.php";
$response = $response = file_get_contents($url);
$roles = json_decode($response, true);

echo "<label>Sélectionner le rôle à attribuer à l'invité</label>";
echo "<select id=\"selectRole\" name=\"idRole\">";
for ($k = 1; $k < count($roles); $k++) {
    if ($k == 1) $k = 2;
    elseif ($k == 2) $k = 1;
    $nomRole = $roles[$k]["nomRole"];
    $idRole = $roles[$k]["idRole"];
    echo "<option value=$idRole> $nomRole </option>";
    if ($k == 1) $k = 2;
    elseif ($k == 2) $k = 1;
}
echo "</select>";
?>