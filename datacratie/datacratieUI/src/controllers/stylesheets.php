<?php
	if(isset($_GET["page"])){
		if($_GET["page"]=="login" or $_GET["page"]=="register"){
			echo "<link rel=\"stylesheet\" href=\"src/css/auth.css\">";
			echo "<script src=\"https://cdn.tailwindcss.com\"></script>";
		}
		elseif($_GET["page"]=="creerGroupe"){
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/creer-groupe.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="groupes"){
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/groupes.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="propositions"){
			echo "<script src=\"https://kit.fontawesome.com/9297c9f24f.js\" crossorigin=\"anonymous\"></script>";
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/propositions.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="vote"){
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/vote.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="gerer-utilisateur-groupe"){
			echo "<script src=\"https://kit.fontawesome.com/9297c9f24f.js\" crossorigin=\"anonymous\"></script>";
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/gerer-utilisateur-groupe.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="userProfil"){
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/userProfil.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="creerProposition" || $_GET["page"]=="creerPropositionEtape1" || $_GET["page"]=="creerPropositionEtape2"){
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/creer-groupe.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/creer-proposition.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="invite-utilisateur-groupe"){
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/creer-groupe.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="lancerVoteEtape0" || $_GET["page"]=="lancerVoteEtape1" || $_GET["page"]=="lancerVoteEtape2"){
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/creer-groupe.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		elseif($_GET["page"]=="resultatVote"){
			echo "<script src=\"https://kit.fontawesome.com/9297c9f24f.js\" crossorigin=\"anonymous\"></script>";
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/resultatVote.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
		else{
			echo "<link rel=\"stylesheet\" href=\"src/css/nav.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
			echo "<link rel=\"stylesheet\" href=\"src/css/404.css\" />";
			echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
		}
	}
	else{
		echo "<link rel=\"stylesheet\" href=\"src/css/global.css\">";
		echo "<link rel=\"stylesheet\" href=\"src/css/accueil.css\" />";
		echo "<link rel=\"stylesheet\" href=\"src/css/footer.css\">";
	}	
?>