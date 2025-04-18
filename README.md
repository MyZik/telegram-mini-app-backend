# Telegram Web App Symfony Backend

Dieses Projekt ist ein Backend für eine Telegram-Webanwendung, basierend auf Symfony 7.2.

## Architektur

Das Projekt folgt einer Onion-Architektur und dem CQRS-Pattern (Command Query Responsibility Segregation):

1. **Domain**: Enthält Doctrine-Entities und Repositories ohne Business-Logik
2. **Application**: Enthält die Business-Logik mit Commands, Queries, Handlern und Rules
3. **Presentation**: API-Schicht mit Controllern und Request-Validierung

## Technologien

- PHP 8.2+
- Symfony 7.2
- Doctrine ORM
- PostgreSQL
- Docker für die Entwicklungsumgebung

## Einrichtung

### Mit Docker

1. Repository klonen
2. Docker-Container starten:
   ```bash
   docker-compose up -d
   ```
3. In den PHP-Container wechseln:
   ```bash
   docker-compose exec php bash
   ```
4. Datenbank-Migrationen ausführen:
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

### Ohne Docker

1. Repository klonen
2. Abhängigkeiten installieren:
   ```bash
   composer install
   ```
3. `.env.local` anpassen (Datenbank-Verbindung)
4. Datenbank-Migrationen ausführen:
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
5. Symfony-Entwicklungsserver starten:
   ```bash
   symfony serve
   ```

## API-Endpunkte

### Kategorien

- `GET /api/categories` - Liste aller Kategorien
- `GET /api/categories/{id}` - Details einer Kategorie mit Items
- `POST /api/categories` - Neue Kategorie erstellen

### Items

- `GET /api/items/{id}` - Details eines Items
- `GET /api/items/category/{categoryId}` - Liste aller Items einer Kategorie
- `POST /api/items` - Neues Item erstellen
- `PATCH /api/items/{id}/availability` - Verfügbarkeit eines Items aktualisieren 