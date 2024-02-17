Ce document fournit des instructions détaillées pour l'installation et la configuration en local du projet ECF, une application web dynamique. Il guide également sur la manière de créer un compte administrateur pour accéder au back-office de l'application.

Prérequis
Pour installer et exécuter l'application en local, vous aurez besoin de :

WAMP (Windows) ou XAMPP (Windows/Linux/Mac) : Ces logiciels fournissent un environnement complet avec PHP, MySQL et Apache, facilitant le déploiement d'applications PHP locales.
MySQL Workbench ou phpMyAdmin : Pour la gestion de la base de données MySQL.
Navigateur Web : Pour accéder à l'application via localhost.
Installation
Installation de WAMP/XAMPP :

Téléchargez et installez WAMP (si vous êtes sur Windows) ou XAMPP (disponible pour Windows, Linux, et Mac) à partir de leurs sites web officiels.
Lancez le logiciel et assurez-vous que les services Apache et MySQL sont démarrés.
Téléchargement et Configuration du Projet :

Téléchargez le fichier ZIP du projet (ecf.zip) et extrayez-le dans le dossier www (pour WAMP) ou htdocs (pour XAMPP) de votre installation WAMP/XAMPP.
Renommez le dossier extrait (si nécessaire) pour simplifier l'accès via le navigateur, par exemple ecf.
Configuration de la Base de Données
Création de la Base de Données :

Lancez phpMyAdmin (ou MySQL Workbench) via le tableau de bord WAMP/XAMPP.
Créez une nouvelle base de données nommée garage_v_parrot.
Importation des Structures et Données :

Dans phpMyAdmin, sélectionnez la base de données garage_v_parrot.
Utilisez l'option d'importation pour charger et exécuter les fichiers .sql fournis avec le projet (par exemple, garage_v_parrot_commentaires.sql, garage_v_parrot_users.sql, etc.), qui contiennent les structures des tables et leurs données initiales.
Lancement de l'Application
Avec WAMP/XAMPP en cours d'exécution et les services appropriés activés, ouvrez votre navigateur et accédez à http://localhost/ecf/public/index.php pour démarrer l'application.
Connexion vers l'interface admin de garage_v_parrot.

login : email.admin@gmail.com
mdp : M00nlight24@

(employée:
email.employee@gmail.com
mdp : M00nlight24@
)
