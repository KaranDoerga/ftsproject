# Festival Travel System (FTS)

Dit is een Laravel-applicatie voor het beheren en boeken van busreizen naar festivals.

## Installatie en Setup

Volg de onderstaande stappen om het project lokaal op te zetten.

### Vereisten
- PHP 8.x
- Composer
- Node.js & NPM
- Een lokale webserver-omgeving (met een MySQL database)

### Stappen
1.  **Clone de repository:**
    ```bash
    git clone https://github.com/KaranDoerga/ftsproject.git
    cd fts-project
    ```

2.  **Installeer PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Installeer JavaScript dependencies:**
    ```bash
    npm install
    ```

4.  **Maak het `.env` bestand aan:**
    Kopieer het `.env.example` bestand naar een nieuw bestand genaamd `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Genereer de applicatiesleutel:**
    ```bash
    php artisan key:generate
    ```

6.  **Database Configuratie:**
    - Maak een nieuwe, lege database aan in je database-omgeving (bijvoorbeeld via phpMyAdmin).
    - Open het `.env` bestand en pas de volgende regels aan met jouw databasegegevens:
      ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=ftsdb
      DB_USERNAME=root
      DB_PASSWORD=root
      ```

7.  **Database Opzetten en Vullen (Belangrijkste Stap):**
    Voer het volgende commando uit. Dit maakt alle tabellen aan en vult ze met de benodigde testdata (gebruikers, festivals, boekingen, etc.).
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Compileer de frontend assets:**
    ```bash
    npm run build
    ```

9.  **Start de development server:**
    ```bash
    php artisan serve
    ```

De applicatie is nu beschikbaar op `http://localhost:8000`.

### Inloggegevens
Je kunt inloggen met de volgende testaccounts die door de seeder zijn aangemaakt:
-   **Klant:** `test@example.com` (wachtwoord: `password`)
-   **Planner:** `planner@example.com` (wachtwoord: `password`)
-   **Admin:** `admin@example.com` (wachtwoord: `password`)
