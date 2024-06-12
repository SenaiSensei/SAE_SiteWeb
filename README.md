# SAÉ 2.01 - Développement d’une application

## Membres
- LABESTE Raphaël (_login_) : **labe0015**
- DURUSSEL Valentin (_login_) : **duru0013**

## Documentation
### Serveur Web local
Lancement du serveur local PHP :

- Ouvrir un terminal dans la **racine du projet** (ou en si déplaçant à l'aide de la commande `cd`)
- lancer la commande `composer start` (lance le `composer start:linux`) ou `composer start:windows` (pour lancer sur windows)

### Style de codage


- `php vendor/bin/php-cs-fixer fix --dry-run` : permet de vérifier si le code du fichier respecte la recommandation **PSR-12** sans modifier le fichier (`--dry-run` demande un exécution normale mais ne modifie pas les fichiers).
- `composer test:cs` : permet de vérifier si le code du fichier respecte la recommandation **PSR-12** sans modifier le fichier et en montrant les changements dans le fichier (`--diff` permet d'afficher les changements entre l'orginal est la ou la potentielle modification).
- `composer fix:cs` : modifie le fichier afin que le code du fichier respecte la recommandation **PSR-12** (`fix` demande une exécution normale).

## Projet
### Fonctionnalitées: 

- Il y a sur la page de TVShow un menu en haut de la page avec:
    * un bouton Accueil qui permet de retourner à l'accueil (la page de toutes les séries).
    * un bouton Création qui permet d'arrivé sur un formulaire pour créer une nuvelle série.

- Il y a sur la page de Season un menu en haut de la page avec:
    * un bouton Éditer qui permet d'éditer la série.
    * un bouton Supprimer qui permet de supprimer une série.

- Il y a un filtrage par genre en haut de la page série qui permet de filtrer la page série par genre dont on a récupérer dans la base de donnée

### Programmes:

- Dans notre projet nous avons:
  1. Les fichiers CSS avec:
      * `episode.css` -> qui envoie le code CSS au fichier episode.php pour permettre un structuration.
      * `index.css` -> qui envoie le code CSS au fichier index.php pour permettre un structuration.
      * `season.css` -> qui envoie le code CSS au fichier season.php pour permettre un structuration.
      * `style.css` -> qui envoie le code CSS par défaut au différentes pages web.

  2. Les fichiers Admin avec:
      * `tvshow-form.php` et `tvshow-save.php` -> qui permettent de faire un formulaire pour la création et l'édition des séries.
      * `tvshow-delete.php` -> qui permet de faire le formulaire pour la suppréssion des séries.
     
  3. Les fichiers des pages web avec:
      * `episode.php` -> qui fait la structuration HTML de la page episode.
      * `index.php` -> qui fait la structuration HTML de la page des séries.
      * `poster.php` -> qui gère les erreurs pour les posters.
      * `season.php` -> qui fait la structuration HTML de la page des saisons.
  
  4. Le fichier database avec:
      * La classe `MyPdo` -> qui fait un lien avec la base de donnée.
  
  5. Les fichiers Entity avec les classes:
      * `Episode.php` -> qui reprend la table épisode de la base de donnée.
      * `Genre.php` -> qui reprend la table genre de la base de donnée.
      * `Poster.php` -> qui reprend la table poster de la base de donnée.
      * `Season.php` -> qui reprend la table season de la base de donnée.
      * `TVShow.php` -> qui reprend la table tvshow de la base de donnée.
  
  6. Les fichiers Collections avc les classes:
      * `CollectionEpisode.php` -> qui fait une collection de tous les episodes.
      * `CollectionGenre.php` -> qui fait une collection de tous les genres.
      * `CollectionSeason.php` -> qui fait une collection de toutes les saisons.
      * `CollectionTVshow.php` -> qui fait une collection de toutes les séries.
  
  7. Les fichiers Exception avec les classes:
      * `EntityNotFoundException.php` -> qui revoie une erreur si l'entité n'est pas bonne.
      * `ParameterException.php` -> qui retourne une erreur si les paramètres (l'url) n'est pas bonne.
  
  8. Les classes de pages web:
      * `WebPage.php` -> qui permet de créer la page web.
      * `AppWebPage.php` -> qui herite de WebPage donc fait la même chose mais avec le code CSS par défaut.
  
  9. Le fichier `TVShowForm.php`:
      * Qui permet la mise en place du code HTML pour les formulaires.