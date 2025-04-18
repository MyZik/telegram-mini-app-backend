#!/bin/bash

# Migrations ausführen (optional)
php bin/console doctrine:migrations:migrate --no-interaction

# Cache leeren oder vorbereiten
php bin/console cache:clear

# Übergibt die Kontrolle an CMD aus Dockerfile
exec "$@"
