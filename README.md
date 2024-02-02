# WR506 - Développpement back avancé

## Installation

### Clonage du projet

    git clone https://github.com/CyndelHerolt/moviesApp.git
    cd moviesApp
    composer install ou composer update

### Mise à jours des infos

    cp .env .env.local

Mettre à jour le fichier .env.local avec vos informations

### Créer la database et importer les données

    bin/console doctrine:database:create

    // version courte
    bin/console d:d:c

Mettre à jour la database
bin/console doctrine:schema:update --force

    // version courte
    bin/console d:s:u -f

### Lancer les fixtures

    bin/console doctrine:fixtures:load

    // version courte
    bin/console d:f:l

Créer des données de test

### Lancer le serveur

    symfony server:start

    // version courte
    symfony serve
