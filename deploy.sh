# Copyright (c) 2023. | Cyndel Herolt | IUT de Troyes  - All Rights Reserved
# @author cyndelherolt
# @project UniFolio

#!/usr/bin/env bash

echo "Début mise à jour"
echo "Git Pull"
sudo git pull origin main
echo "end git pull"

echo "Installation des dépendances"
composer install
echo "end installation des dépendances"

echo "generation des assets"
npm run dev
echo "fin génératation des assets"

echo "Nettoyage cache"
bin/console cache:clear
echo "end Nettoyage cache"
echo "Fin mise à jour"