% [POLYTECH] Web Project - Project Designer
% 2017 - 2018
% Detcheberry Valentin - Vuillemin Anthony

# Project - designer

**Project-designer** est une webapp permettant la préconception d'une idée en se basant sur du *mindmapping*.

Il permet la modélisation d'idée autour de plusieurs axes, par exemple pour le jeu vidéo :

* Technique
* Gameplay
* Univers
* Graphisme

# Mécanique DB

Chaque *visiteur* peut **créer** un *schema*. Seul un *utilisateur* (connecté et inscrit dans la DB) peut **auvegarder** son *schema*. L'*utilisateur* peut **invité** d'autre *utilisateurs* sur son *schema*. Chaque *utilisateur* *associé* à un *schema* peut avoir plusieurs *rôles* :

* Lecture (obliger)
* Ecriture 
* Modération
* Administateur

Chaque *invité* à le rôle de lecture sur un *schema*. L'*administateur* et les *modérateurs* peuvent lui données différent les droit d'*écriture* et de *modération*. Ils peuvent également rétirer le rôle d'**écriture** et de  *lecture*.

L'*administrateur* est le créateur du shema. Il peut données sont rôle à un autre *utilisateur*. Il peut également rétirer le rôle de *modérateur*.

Tout les *utilisateur* d'un même *schema* peuvent **discuter** via une **messagerie instantané**.

Un *shema* contient des *textbox* contenant un texte et une couleur

Les *textbox* peuvent être **reliées** entre elles.

Les *schema* contienne également des *axes*. Prenant un nom. L'ordre des *axes* par *schema* est important !. Leur position est calculer en fonction du nombre d'axe (donc par le Js).

Le *schema* dispose également d'un nom.

On dispose de quelque *schema* de base tel celui sur les jeux vidéo présenté au début.

# Maquette

Le menu est commun à toutes les pages

## Menu

* Accueil
* Créer nouveau schema
* Workspace
* Gestion des données (seulement si utilisateur connecté)
* Connexion
    * Login
    * mdp
    * mdp oublié
    * Sign up

## Accueil

* Les nouveauté du site
* Créer un nouveaux schema

## Workspace

* List des schemas (menu déroulant (venant de la gauche))
    * Créer un nouveau schéma
        * Entrer un nom
        * Selection d'un schema de base ou partir sur un shema vide
* Toolbox
    * Ajouter un postit
    * Modification des axes (renomage / ajout / suppression) (resize auto de l'angle entre chaque axe 360/n)
    * Ajout d'une liaison
    * Supprimer élément

## Gestion données

* Changer email
* Changer mdp

# Technique de développement

On utilisera un base de données **postgresql**. Un serveur **PHP** comme *Apache*, ainsi que *js, html et css* coté front-end.

Le back-end sera développer avec le *design-pattern* **MVC** et celui des **DAO**

# Repartition des tâches

* Base de données
    * Conception (Diagramme)
    * Création et population (script)
* Front - end
    * Page d'accueil
    * Page de gestion des données utilisateurs
    * Page de workspace
    * Feuille de style CSS
* Back - end
    * Développement des Modèls (Beans)
    * Développement des DAOs
    * Validateur de données
        * adresse mail
        * string (echapement des characteres \`)
        * username
    * Connexion
        * Sign in
        * Sign up
        * Sign out
    * Schema
        * Créer nouveaux schema
        * Modifier schema
        * Supprimer schema
    * Messagerie instantané

# Workspace

## Post-it

Les post-it peuvent être sauvegarder sous la forme suivante :

*  Position : 
    * Une distance par rapport au centre du repère.
    * Un angle par rapport à la vertical.
* Data :
    * Une simple string
* Link :
    * La liste des post-it reliés