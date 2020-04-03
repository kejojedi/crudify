![Imgur](https://i.imgur.com/0LaKZQK.png)

# Crudify

Crudify is a Laravel 7 package which includes sensible CRUD app scaffolding and a generator to make your life easier. It automates initial CRUD app setup with the `crudify:install` command, and generates CRUD resource files for you with the `crudify:generate` command.

It is configured to work well with PHPStorm, Valet, and Laragon, among others. **This package requires Node.js to be installed in order to run `npm` commands.**

Useful links:

- Support: [GitHub Issues](https://github.com/kejojedi/crudify/issues)
- Contribute: [GitHub Pulls](https://github.com/kejojedi/crudify/pulls)
- Donate: [PayPal](https://www.paypal.com/paypalme2/kjjdion)

## Installation

Install Laravel:

    laravel new app
    
Configure `.env` file:

    APP_NAME=App
    APP_URL=http://app.test
    DB_DATABASE=app
    MAIL_USERNAME=mailtrap_username
    MAIL_PASSWORD=mailtrap_password
    MAIL_FROM_ADDRESS=info@app.test

Require Crudify:

    composer require kejojedi/crudify
    
Install Crudify:

    php artisan crudify:install

Visit your app URL and login using:

    Email: admin@example.com
    Password: password

The `AdminUserSeeder` call can be removed from your `DatabaseSeeder` any time.

## Generating CRUD

Run `crudify:generate` for a new model:

    php artisan crudify:generate Model
    
This will generate:

- Controller
- Model
- Factory
- Migration
- Seeder
- View files
- Navbar link
- Routes

Don't forget to migrate after updating the new migration file.

## Packages Used

Composer packages:

- [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
- [laravel/ui](https://github.com/laravel/ui)
- [yajra/laravel-datatables-html](https://github.com/yajra/laravel-datatables-html)
- [yajra/laravel-datatables-oracle](https://github.com/yajra/laravel-datatables)

NPM packages:

- [@fortawesome/fontawesome-free](https://www.npmjs.com/package/@fortawesome/fontawesome-free)
- [browser-sync](https://www.npmjs.com/package/browser-sync)
- [datatables.net-bs4](https://www.npmjs.com/package/datatables.net-bs4)
- [datatables.net-responsive-bs4](https://www.npmjs.com/package/datatables.net-responsive-bs4)
