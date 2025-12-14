# Watson – UE 313 (Bibliothèques logicielles)

Ce projet correspond à l’application **Watson**, utilisée dans le cadre de l’UE **313 – Bibliothèques logicielles**  
(Licence Professionnelle – Université de Limoges).

L’objectif est de mettre en place un environnement **Dockerisé** permettant de travailler avec :
- PHP (Apache)
- MySQL
- Composer
- Architecture MVC
- Twig
- jQuery

---

## Technologies utilisées

- **PHP 8.1** (Apache)
- **MySQL 8**
- **Docker & Docker Compose**
- **Composer**
- **Silex / Symfony components**
- **Twig**
- **jQuery / Bootstrap**

---

## 📁 Structure du projet

.
├── app/                # Configuration et logique applicative
├── web/                # Point d’entrée public (index.php)
├── db/
│   └── db.sql          # Schéma et données MySQL
├── docker/
│   └── php/
│       └── Dockerfile  # Image PHP personnalisée
├── vendor/             # Dépendances Composer
├── docker-compose.yml
└── README.md

---

## ⚙️ Pré-requis

- Docker Desktop (Windows / macOS / Linux)
- Docker Compose
- Git

Vérification :
```bash
docker --version
docker compose version

Installation complète (from scratch)

git clone https://github.com/Nathan-Part/UEL313-Groupe7-S3.git

Configuration Docker
Le port 1234 est utilisé pour l’accès web.
Dans docker-compose.yml :
ports:
  - "1234:80"

Construire et démarrer les conteneurs
docker compose down -v
docker compose up -d --build

Installer les dépendances PHP (Composer)
docker exec -it watson_php bash -lc "cd /var/www/html && composer install"

Importer la base de données
docker exec -i watson_mysql mysql -u root -proot watson < db/db.sql

Vérifier la configuration de la base de données
Fichier : app/config/dev.php
'host'     => 'mysql',
'port'     => '3306',
'dbname'   => 'watson',
'user'     => 'watson',
'password' => 'watson'

Accéder à l’application:
http://localhost:1234