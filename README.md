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
- `composer test:cs` : permet de vérifier si le code du fichier respecte la recommandeation **PSR-12** sans modifier le fichier et en montrant les changements dans le fichier (`--diff` permet d'afficher les changements entre l'orginal est la ou la potentielle modification).
- `composer fix:cs` : modifie le fichier afin que le code du fichier respecte la recommandeation **PSR-12** (`fix` demande une exécution normale).

## Projet