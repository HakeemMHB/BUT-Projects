# DataCratie

## Description

**DataCratie** est une plateforme open source visant à démocratiser la participation citoyenne grâce à un système de référendum d'initiative citoyenne. Elle permet de :
- Proposer, discuter et voter sur des idées ou propositions.
- Organiser des référendums anonymes et sécurisés.
- Fournir une interface adaptée à des échelles variées : d'une association locale à une commune entière.

Cette application est construite autour d'une architecture REST, offrant une séparation claire entre le backend et le frontend pour une meilleure extensibilité.

---

## Fonctionnalités principales

### Internaute
- Création, connexion et suppression de compte.
- Création de groupes pour organiser la démocratie participative.
- Invitation d'autres membres par email.
- Consultation des groupes et propositions associés.

### Administrateur
- Gestion des membres d'un groupe : ajout, suppression, promotion (modérateur, organisateur de vote, etc.).
- Déclenchement de votes formels avec différents modes de scrutin (Oui/Non, majorité simple, jugement majoritaire, etc.).
- Configuration des thèmes et apparence des groupes (couleurs, images).

### Membre
- Soumission et discussion de propositions avec des étiquettes et des commentaires.
- Signalement de contenu inapproprié (propositions ou commentaires).
- Participation aux votes et configuration des notifications (journalières ou hebdomadaires).

### Modérateur
- Modération des propositions et commentaires signalés.

### Décideur
- Évaluation budgétaire des propositions avec des contraintes prédéfinies (budget global, thématique).
- Assistance dans l'application des propositions selon les résultats des votes.

---

## Technologies utilisées

- **Backend** : Java avec Spring Boot (REST APIs).
- **Frontend** : Vue.js (application web).
- **Base de données** : PostgreSQL.
- **Sécurité** : Gestion des utilisateurs et des sessions avec Spring Security (authentification et autorisation).
- **Déploiement** : Docker et Kubernetes pour l'orchestration.

---

## Installation

### Prérequis
- **Java 17** ou supérieur.
- **Node.js** (version LTS recommandée).
- **PostgreSQL**.
- **Docker** (optionnel pour l'environnement de production).

### Étapes

1. Clonez le dépôt :
   ```bash
   git clone https://gitlab.com/HakeemMHB/datacratie.git
   cd datacratie
   ```

2. Configurez la base de données dans le fichier `application.properties` :
   ```properties
   spring.datasource.url=jdbc:postgresql://localhost:5432/datacratie
   spring.datasource.username=USERNAME
   spring.datasource.password=PASSWORD
   ```

3. Lancez l'application backend :
   ```bash
   ./mvnw spring-boot:run
   ```

4. Lancez l'application frontend :
   ```bash
   cd frontend
   npm install
   npm run serve
   ```

---

## Contribution

Nous accueillons toutes les contributions pour améliorer DataCratie. Voici comment vous pouvez contribuer :

1. Forkez le projet et clonez votre fork.
2. Créez une nouvelle branche pour vos modifications :
   ```bash
   git checkout -b feature/nom-de-votre-branche
   ```
3. Soumettez vos changements et ouvrez une merge request.

Merci de respecter les règles de contribution décrites dans `CONTRIBUTING.md`.

---

## Licence

Ce projet est sous licence [MIT](LICENSE), ce qui signifie que vous pouvez l'utiliser librement à des fins personnelles ou commerciales, sous réserve de respecter les termes de la licence.

---

## Auteurs

Ce projet est réalisé dans le cadre du BUT Informatique, 2ème année, à l'IUT d'Orsay.
- **Matthieu GAYMAY**
- **Lucas PIVET**
- **Hakeem BHATOO**


---

## Statut du projet

Le projet est en cours de développement (phase S3). Les fonctionnalités principales sont en train d'être implémentées. Des mises à jour régulières seront effectuées pour ajouter de nouvelles fonctionnalités et corriger les bugs.
