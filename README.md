### Création du projet via Sail (environnement de développement Docker fourni par Laravel)
Doc : https://laravel.com/docs/11.x/sail

#### Penser à configurer un alias pour utiliser la commande `sail` :
Doc : https://laravel.com/docs/11.x/sail#configuring-a-shell-alias

Toutes les commandes utilisées pour le projet (composer, php, ...) doivent être préfixées par `sail`

Ex :
```shell
sail composer install

sail artisan make:model Post
ou
sail php artisan make:model Post
```

```shell
curl -s "https://laravel.build/example-app?with=mysql,redis,mailpit" | bash
```

`example-app` est le nom du projet

Ouvrir le projet et lancer Docker
```shell
cd example-app
./vendor/bin/sail up
```

#### MySql
Host: 127.0.0.1
User : sail
Password : password
Port : 3306
Database : laravel

#### Mailpit
URL : http://localhost:8025


Par la suite si besoin d'ajouter des services :
```shell
sail artisan sail:add
```


### Configuration de l'environnement de développement

#### PHPStorm
Plugin Laravel
(Plugin Laravel Idea (payant))

#### VSCode
@todo

#### Ajout d'un outil de debug, Laravel Telescope
Doc : https://laravel.com/docs/11.x/telescope

```shell
sail composer require laravel/telescope
sail artisan telescope:install
sail artisan migrate
```

#### (Optionnel) Outil de code quality, Larastan
Doc : https://github.com/larastan/larastan

```shell
sail composer require --dev "larastan/larastan:^2.0"
```

Pour le lancer :
```shell
sail bin phpstan
```

#### (Optionnel) PHP code style fixer, Laravel Pint
Doc : https://laravel.com/docs/11.x/pint

Déjà installé sur un nouveau projet Laravel

Pour le lancer :
```shell
sail bin pint
```
