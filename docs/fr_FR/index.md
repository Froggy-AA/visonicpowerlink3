# Documentation du plugin powerlink v3

**Avant toute utilisation, il est nécessaire de lire la partie sécurité. L'auteur du plugin ne pourra pas être tenu responsable de problèmes liés à l'installation ou l'utilisation de celui-ci.**
**Il est conseillé de lire le reste de la documentation pour pouvoir faire le fonctionner**

## Fonctionnalités du plugin

Le plugin premet de : 
- Récupérer les infos sur l'alarme : état (armé, désarmé, partiel), la mémoire d'alarme, le niveau de la batterie, ...
- Armer et désamer l'alarme. Les boutons sont cachés par défaut pour éviter les clics malencontreux. il faut les rendre visibles manuellement.

## Principe, compatibilité et pré requis

### Pré requis

Il est nécessaire de posséder une alarme visonic avec un powerlink 3. A priori, il faut un firmware de l'alarme en version 19 minimum. 


### Principe

Le plugin utilise une API JSON RPC non documentée et exposée par le powerlink v3. Cette API est appelée toutes le minutes pour récupérer les informations (état, alarme, mémoire, ...). Cette même API est toujours utilisée pour commander l'alarme : armement, désarmement, ...
La récupération des informations sur la batterie est effectuée toutes les 15 min.
Il est conseillé d'avoir un jeedom avec une IP fixe. Dans le cas contraire, en cas de changement d'IP, le plugin ne sera fonctionnel qu'au prochain enregistrement de l'ip de l'appelant. 

### Compatibilité et tests

Le plugin a uniquement été testé sur un powermaster 30 avec le module powerlink v3. 
Le plugin a été testé sur :
 - Powermaster 30, v19 - Powerlink 3, v7.5 raw
 - Powermaster 33 EXP G2, v19  - Powerlink 3, v7.5 raw

Il n'a pas été testé avec un module powerlink 3.1

Merci de faire part de vos retours concernant la compatibilité.

## Sécurité

Voici la liste des problèmes de sécurité que j'ai identifié. Dans une très grande majorité, ils sont liés à l'API visonic et pas au plugin D'autres problèmes peuvent exister mais ne pas être listés ici.

### HTTP
L'API n'est exposée qu'en http. Il n'y a pas de port https exposé. De ce fait, toutes les informations transmises entre l'alarme et le client sont en clair sur le réseau et peuvent donc être interceptées et utilisées par toute personne ayant accès au réseau sur lequel le powerlink est connecté. Le code de l'alarme n'est donc pas transporté de manière sécurisée.

### Enregistrement du client
L'API enregistre le client à partir de son IP (et peut être de son adresse MAC). Il n'y a pas de jeton de sécurité d'échangé. De ce fait, une usurpation d'IP (et peut être d'adresse MAC) permettrait d'utiliser l'API et de récupérer les informations sans être préalablement enregistré. 

### Code utilisateur
Pour fonctionner l'alarme impose un appel pour l'enregistrement du client. Cet appel nécessite de transmettre le code utilisateur, c'est à dire permettant d'armer ou de désarmer l'alarme. Ce code est donc transporté en clair.
De plus, si une personne accède à la machine enregistrée, elle peut utiliser l'API sans avoir besoin du code utilisateur.

Il **semble** que la ressource d’enregistrement ne soit pas protégée contre une attaque en force brute consistant à tester un par un tous les codes possibles. 

Le code utilisateur est stocké sur jeedom. Une prise de contrôle de jeedom permet donc notamment de désactiver l'alarme, d'en connaitre son état, ... 

### Internet
Il est plus que conseillé de bloquer les accès entrant externes vers le port 8181 de l'alarme. Cela permet de minimiser les risques d'attaque provenant d'internet. 


## Installation
Le plugin ne nécessite pas de dépendance et n'embarque pas de démon.

### Paramètres
 - IP ou DNS de l'alarme : l'ip ou le non DNS permettant d'accéder à l'alarme. Si c'est un DNS, l'ip devrait pouvoir être dynamique et varier sans problème.
 - Code de l'alarme : un code utilisateur paramétré sur l'alarme. Des droits de ce code dépendra les actions que l'on peut réaliser. Par exemple, un utilisateur n'ayant pas le droit d'armer la partition 1 ne pourra pas le faire via le plugin. 
 - Port powerlink : le port http d'écoute du module powerlink. Par défaut, il s'agit du 8181 sur le powerlink v3. Sa valeur ne devrait jamais être changé. Le paramètre est présent au cas où d'autres version utilisent d'autres ports. 
 - IP Jeedom : L'IP de la machine hébergeant jeedom. ** Il faut obligatoirement mettre un IP ** , pas de DNS possible. Si jeedom est configuré sur un DHCP, un changement nécessitera un changement de la valeur de ce paramètre. Il est donc plus que conseillé de mettre jeedom sur un IP fixe ou d'attribuer un règle DCHP fixant cette IP.

## Limitations

### Nombre d'équipements
Il faut créer un seul équipement par alarme à monitorer, ce qui devrait être le cas de tout le monde. En créer plusieurs est inutile peut provoquer des conflits sur la gestion des réponses de l'API.

### Détection des alarmes
Le déclanchement d'une alarme en cas d'intrusion n'est pas détectable. Il faut donc attendre le passage du cron chaque minute pour le détecter.

### Timeout
Je ne sais pas si ce problème est spécifique à mon installation mais dans certains cas, l'api ne répond plus, notamment via un time out client ou par un retour en erreur de la ressource spécifiant un time out.
En l'état, il est possible de ne pas pouvoir récupérer d'information pendant plusieurs minutes.

### IP enregistrées
Une seule IP ne peut être enregistrée à un instant donné. On ne peut pas "dé-enregistrer" une ip, on peut juste en enregistrer une autre en remplacement. 
L'ip enregistrée a une durée de vie de quelques jours.

## Prix
La licence est définie dans les informations du plugin sur le store. Il est fourni gratuitement et les sources sont publiques.
** Si vous le trouvez utile, je vous propose de faire un don de quelques euros à une association caritative de votre choix. Cela ne changera pas le monde mais cela me fera plaisir et vous contribuerez à améliorer un petit notre petite planète et ses habitants  **

## Roadmap

Dans le désordre et selon ma disponibilité...

- Fonctionnement du plugin
	- Gestion de l'enrôlement technique du client d'appel à développer
	- Gestion des erreurs à améliorer et tester
	- Gestion des erreurs réseau (retry)
	- Gérer les paramètres curl en variables
	- Masquer certaines infos
	- Ajout de la date de récup des infos
	- Port : mettre une valeur par défaut dans l'écran de config
	- Port : mettre 8181 par défait, si vide ou incorrect
	- Gérer les id JSON RPC de manière unique
	- Récupérer automatiquement l'IP Jeedom ($_SERVER['SERVER_ADDR'];)
	- IHM pour le widget
	- Version mobile
	- Gestion de l'anglais, y compris la doc
	- Option pour autoriser l'sécurité pour éviter d'armer / désarmer par erreur
	- Gérer une version logique des indicateurs de l'alarme
	
- Infos / contrôle de l'alarme
	- Récupération d'images à la demande sur les caméras
	- Ajout des infos GPRS
	- Ajout des infos de température ?
	- Ajout du contrôle de la sirène (compliqué...)
	- Ajout de la possiblilité d'armement immédiat
	- Ajout du lancement des tests périodiques (si API fonctionnelle)
	- Historisation ($cmd->addHistoryValue($value, $date);)


## Bugs connus
Si vous détectez un problème non référencé, créez un ticket sur GIT
- La sauvegarde sur un objet non activé provoque une erreur
- Gestion des codes secret commençant par 0 : non testé, peut poser problème
- Erreurs réseau courantes. Ce point est lié à la gestion du réseau par l'alarme, je n'y peut rien à part implémenter un rejeu automatique
