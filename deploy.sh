# Copyright (c) 2023. | Cyndel Herolt | IUT de Troyes  - All Rights Reserved
# @author cyndelherolt
# @project UniFolio

#!/usr/bin/env bash

echo "Début mise à jour"
echo "Git Pull"
git pull origin main
echo "end git pull"

echo "Installation des dépendances"
composer install
echo "end installation des dépendances"

echo "Mise à jour de la base de données"
bin/console d:s:u -f
echo "end mise à jour de la base de données"

echo "Nettoyage cache"
bin/console cache:clear
echo "end Nettoyage cache"
echo "Fin mise à jour"