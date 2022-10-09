
## Requirements

- Composer
- Laravel Framework 8.0+
- Laravel Mix
- Node.js & NPM


## Run Locally

Clone the project

```bash
  git clone https://gitlab.com/godonoagavictor/gara.git gara
```

Go to the project directory

```bash
  cd gara
```

Install

```bash
  composer install
  cp .env.example .env
```
Setup your database credentials and app name, url, etc.

```bash
  php artisan key:generate
  php artisan migrate
  php artisan dusk:install
  php artisan storage:link
  php artisan db:seed
```

Take a look in your seeders log for admin login/password.
You can now access admin interface via /admin route and start build something amazing.

## Deployment

To deploy this project run

```bash
  php vendor/bin/envoy run deploy
```

## Running Tests

To run tests, run the following command

```bash
  php artisan test
```

To run browser tests

```bash
  php artisan dusk
```

To run failed browser tests

```bash
  php artisan dusk:fails
```

## Used Packages

 - [coderello/laravel-nova-lang](https://github.com/coderello/laravel-nova-lang "Language files for Laravel Nova translated into 40+ languages.")
 - [crayon/nova-language-management](https://novapackages.com/packages/crayon/nova-language-management "A tool for Laravel Nova to implement dynamic languages. The whole idea of this package is to rewrite the configuration files of several localization packages based on your inputs.")
 - [optimistdigital/nova-translatable](https://github.com/optimistdigital/nova-translatable "This Laravel Nova allows you to make any input field spatie/laravel-translatable compatible and localisable.")
 - [spatie/laravel-translatable](https://github.com/spatie/laravel-translatable "This package contains a trait to make Eloquent models translatable")
 - [silvanite/novatoolpermissions](https://github.com/Silvanite/novatoolpermissions "Roles and Permission based Access Control")
 - [spatie/nova-backup-tool](https://github.com/spatie/nova-backup-tool "Backup tool")
 - [optimistdigital/nova-settings](https://github.com/optimistdigital/nova-settings "Allows you to create custom settings in code (using Nova's native fields) and creates a UI for the users where the settings can be edited.")
 - [optimistdigital/nova-menu-builder](https://github.com/optimistdigital/nova-menu-builder "Allows you to create and manage menus and menu items.")


You can find more packages at [https://novapackages.com](https://novapackages.com)
