![Imgur](https://i.imgur.com/0LaKZQK.png)

# Crudify

Crudify is a Laravel 7 package which includes sensible CRUD app scaffolding and a generator to make your life easier. It automates initial CRUD app setup with the `crudify:install` command, and generates CRUD resource files for you with the `crudify:generate` command. It also includes form components to make creating forms a breeze.

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

**Tip: use the `--force` in order to replace existing generated files e.g. `php artisan crudify:generate Model --force`**

## Form Components

Crudify offers simple form components to make building forms fast & easy. See below for minimal and complete examples of each component.

Input:

    <x-crudify-input name="name" :value="old('name')" />
    <x-crudify-input name="year" type="number" :label="__('Year')" id="car_year" :value="old('year', $car->year)" />

Textarea:

    <x-crudify-textarea name="description" :value="old('description')" />
    <x-crudify-textarea name="description" rows="5" :label="__('Car Description')" id="car_description" :value="old('description', $car->description)" />
    
Select:

    <x-crudify-select name="fuel_type" :options="['Gas', 'Diesel', 'Electric']" :value="old('fuel_type')" />
    <x-crudify-select name="fuel_type" :options="['Gas', 'Diesel', 'Electric']" :empty="false" :label="__('Car Fuel Type')" id="car_fuel_type" :value="old('fuel_type', $car->fuel_type)" />

**Note: if the options are an associative array, the keys are used as the labels and the values as the values. For sequential arrays, the values are used for both the labels and values.**

File:

    <x-crudify-file name="image" />
    <x-crudify-file name="other_images" :label="__('Other Car Images')" :file-label="__('Choose Images')" id="other_car_images" :multiple="true" />

Checkbox:

    <x-crudify-checkbox name="insured" :value="old('insured')" />
    <x-crudify-checkbox name="insured" :label="__('Insured')" :checkbox-label="__('This car is insured')" id="car_insured" :value="old('insured', $car->insured)" />

**Note: checkbox attributes should have `boolean` migration columns.**

Checkboxes:

    <x-crudify-checkboxes name="features" :options="['Bluetooth', 'Navigation', 'Speakers']" :value="old('features')" />
    <x-crudify-checkboxes name="features" :options="['Bluetooth', 'Navigation', 'Speakers']" :label="__('Car Features')" id="car_features" :value="old('features', $car->features)" />

**Note: checkboxes attributes should be cast to `array` with `text` migration columns.**

Radios:

    <x-crudify-radios name="color" :options="['Red' => '#ff0000', 'Green' => '#00ff00', 'Blue' => '#0000ff']" :value="old('color')" />
    <x-crudify-radios name="color" :options="['Red' => '#ff0000', 'Green' => '#00ff00', 'Blue' => '#0000ff']" :label="__('Car Color')" id="car_color" :value="old('color', $car->color)" />
    
Complete form example:

    <form method="post" action="{{ route('cars.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <ul class="list-group list-group-flush">
                <x-crudify-input name="name" :value="old('name')" />
                <x-crudify-input name="year" type="number" :value="old('year')" />
                <x-crudify-file name="image" />
                <x-crudify-select name="fuel_type" :options="['Gas', 'Diesel', 'Electric']" :value="old('fuel_type')" />
                <x-crudify-radios name="color" :options="['Red' => '#ff0000', 'Green' => '#00ff00', 'Blue' => '#0000ff']" :value="old('color')" />
                <x-crudify-textarea name="description" :value="old('description')" />
                <x-crudify-checkbox name="insured" :value="old('insured')" />
                <x-crudify-checkboxes name="features" :options="['Bluetooth', 'Navigation', 'Speakers']" :value="old('features')" />
            </ul>

            <div class="card-footer text-md-right border-top-0">
                <button type="submit" name="submit" value="reload" class="btn btn-primary">{{ __('Create & Add Another') }}</button>
                <button type="submit" name="submit" value="redirect" class="btn btn-primary">{{ __('Create') }}</button>
            </div>
        </div>
    </form>

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
