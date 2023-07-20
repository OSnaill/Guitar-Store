# Guitar Store

Bienvenue sur le repo de mon projet personnel: Guitar Store

### Présentation

Bienvenue sur mon premier projet VueJS/Symfony avec API Rest,
ce site web a représenté une vrai source d'apprentissage.

## Technos

### Back end :
-   Symfony
-   Php
-   API Rest

### Front end :
-   HTML
-   CSS
-   TailwindCSS
-   VueJS

##   Installation:

### Nécessitées :
- APACHE
- Node 16^
- php 8.2^

Dossier /back

`
composer install
`

Créer un fichier .env.local à la racine du dossier /back

```
DATABASE_URL="mysql://user:mdp@127.0.0.1:3306/guitar_store?serverVersion=10.11.2-MariaDB&charset=utf8mb4"

###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=
CORS_ALLOW_ORIGIN=*
###< lexik/jwt-authentication-bundle ###
```

Générer la clé jwt:
`
php bin/console lexik:jwt:generate-keypair
`

Créer votre base de données:

`
php bin/console d:d:c
`

Faites les migrations de votre bdd:

`
php bin/console do:mi:mi
`

Dans le fichier /back/src/DataFixtures/UserFixtures -> remplacez le setEmai() et setPassword() par vos identifiants voulu
Lancer la commande pour enregister l'utilisateur administrateur:
`
php bin/console do:fi:lo
`


Lancer le back:
`
php -S 0.0.0.0:8000 -tpublic
`

Dossier /front

Installer les dépendances
`
npm install
`

lancez vue js :
`
npm run dev
`
