# Lab-on-occas
Lab-on-occas est une réplique de DealLabs.

## Installation
Cloner le projet.
```bash
git clone https://gitlab.iut-clermont.uca.fr/php-symfony/promo-2021/dealabs/rolland-brandon.git
```

Installer les dépendances.
```bash
composer install
```
```bash
yarn install
```
```bash
yarn watch
```

Ajouter au fichier ```.env``` la ligne suivant, nécessaire pour la connexion à votre base de données :
```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
``` 

Mettre à jour votre base de données :
```bash
php bin/console doctrine:migrations:migrate
```

Ajouter des données dans la base de données :
```bash
php bin/console doctrine:fixtures:load
```
