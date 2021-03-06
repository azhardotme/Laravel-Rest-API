## About Project

Laravel 8 Rest API with CRUD operation.

### Used Secure API JWT

### Install & Configure Passport

#### 1. Install Passport

-   composer require laravel/passport

#### If time out error comes then run the bellow command

-   COMPOSER_MEMORY_LIMIT=-1 composer require laravel/passport

#### 2. Migration

-   php artisan migrate

#### 3. Key Generate

-   php artisan passport:install

#### 4. User Model

-   use Laravel\Passport\HasApiTokens;
-   use HasApiTokens, HasFactory, Notifiable;

#### 5. Update App\Providers\AuthServiceProvider

-   use Laravel\Passport\Passport;

-   In boot function add
-   Passport::routes();

#### 6. Update config/auth.php

       'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],

#### 7. create route and function in controller

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
