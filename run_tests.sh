#!/bin/bash

# Exécute les tests PHPUnit
docker compose exec php bin/phpunit

# Exécute les tests PHPStan
docker compose exec php composer phpstan

# Exécute les tests PHPCS
docker compose exec php composer phpcs

# Affiche un message de succès si tous les tests passent
if [ $? -eq 0 ]; then
  echo "Tous les tests ont été exécutés avec succès."
else
  echo "Certains tests ont échoué."
  exit 1
fi