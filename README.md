# Shelters

[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F1fe51b34-7c12-4368-a253-88199be46e79%3Fdate%3D1%26label%3D1%26commit%3D1&style=flat-square)](https://forge.laravel.com/servers/777083/sites/2454953)

Projet simple de démonstration visant à introduire les premières notions à l'utilisation du framework Laravel.

## Création du projet via Laravel Sail

- Environnement de développement Docker fourni par Laravel
- Doc : https://laravel.com/docs/11.x/sail

```shell
curl -s "https://laravel.build/example-app?with=mysql,mailpit" | bash
```

`example-app` est le nom du projet

Ouvrir le projet et lancer Docker

```shell
cd example-app
./vendor/bin/sail up
```

Toutes les commandes utilisées pour le projet (composer, php, ...) doivent être préfixées par `sail`

**Penser à configurer un alias pour utiliser la commande `sail`**

- Doc : https://laravel.com/docs/11.x/sail#configuring-a-shell-alias

```shell
sail composer install

sail artisan make:model Post -a --api
ou
sail php artisan make:model Post -a --api
```

## Configuration

### MySql

- Host: 127.0.0.1
- User : sail
- Password : password
- Port : 3306
- Database : laravel

### Mailpit

- Url : http://localhost:8025

Par la suite si besoin d'ajouter des services :

```shell
sail artisan sail:add
```

## Environnement de développement

### PHPStorm

- Plugin Laravel
- (Plugin Laravel Idea (payant))

### VSCode

- [Laravel Blade Formatter](https://marketplace.visualstudio.com/items?itemName=shufo.vscode-blade-formatter)
- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)

### Outil de debug, Laravel Telescope

- Doc : https://laravel.com/docs/11.x/telescope
- Url : http://localhost

```shell
sail composer require laravel/telescope
sail artisan telescope:install
sail artisan migrate
```

### Lancer les tests

```shell
sail bin phpunit
ou
sail artisan test
```

### (Optionnel) Outil de code quality, Larastan

- Doc : https://github.com/larastan/larastan

```shell
sail composer require --dev "larastan/larastan:^2.0"
sail bin phpstan
```

### (Optionnel) PHP code style fixer, Laravel Pint

- Doc : https://laravel.com/docs/11.x/pint

Déjà installé sur un nouveau projet Laravel

```shell
sail bin pint
```

## Authorization via Laravel Passport

- Doc : https://laravel.com/docs/11.x/passport

Le plus simple pour commencer à l'utiliser via Postman est d'utiliser le Password Grant Tokens.

## Quelques packages populaires hors packages Laravel officiels

- [Laravel Media Library](https://spatie.be/docs/laravel-medialibrary/v11/introduction) - Gestion des fichiers et de leur association avec des models Eloquent
- [Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction) - Gestion des rôles et permissions utilisateurs
- [Laravel Excel](https://laravel-excel.com/) - Simplification des exports et imports (csv, xlsx, ...)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
