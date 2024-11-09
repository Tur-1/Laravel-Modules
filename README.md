
# Laravel Modules Package

`tur1/laravel-modules` is a Laravel package which was created to manage your large Laravel app using modules.
This package provides a set of Artisan commands and tools to easily create modules, pages, and filters in your Laravel application.


Generate your first module using `php artisan module:create Admins`. The following structure will be generated.

```bash
Modules/
├── Admins/
    ├── Controllers/
    │   └── AdminController.php
    ├── Database/
    │   ├── factories/
    │   │   └── AdminFactory.php
    │   ├── migrations/
    │   │   └── 2024_09_16_xxxxxxx_admins_table.php
    │   └── seeders/
    │       └── AdminSeeder.php 
    ├── Events/
    │   ├── AdminCreatedEvent.php
    │   ├── AdminDeletedEvent.php
    │   └── AdminUpdatedEvent.php
    ├── Exceptions/
    │   └── AdminException.php
    ├── Filters/
    │   ├── GenderFilter.php
    │   └── StatusFilter.php
    ├── Middleware/
    │   └── AdminMiddleware.php
    ├── Models/
    │   └── Admin.php
    ├── Observers/
    │   └── AdminObserver.php
    ├── Policies/
    │   └── AdminPolicy.php 
    ├── Requests/
    │   ├── StoreAdminRequest.php
    │   └── UpdateAdminRequest.php
    ├── Resources/
    │   ├── AdminListResource.php
    │   └── AdminShowResource.php
    ├── Routes/
    │   └── AdminRoutes.php
    ├── Services/
    │   └── AdminService.php
    └── Traits/
        ├── AdminAttributesTrait.php
        ├── AdminRelationshipsTrait.php
        └── AdminScopesTrait.php
```
## Installation

To install the package, run:

```bash
composer require tur1/modules
```

## Artisan Commands

### Create a Module

To create a new module, use the following command:

```bash
php artisan module:create Users
```

This will generate a `Users` module in the `app/Modules` directory.

### Create a Page

To create a new page within a module, use:

```bash
php artisan page:create Dashboard
```

This will generate a `Dashboard` page 

### Create a Filter

To create a new filter within a module, use:

```bash
php artisan module:filter {name} --m={module-name}
```

Example:

```bash
php artisan module:filter StatusFilter --m=Users
```

This will create a `StatusFilter` class in the `app/Modules/Users/Filters` directory.

## Registering Filters in a Model

You can register filters for a model by defining a `filters()` method in your model. For example:

```php

class User extends Model
{
    /**
     * Register filters for the User model.
     *
     * @return array
     */
    public static function filters()
    {
        return [
             StatusFilter::class,
        ];
    }
}
```
## Applying Filters

To apply filters to a query, use the `withFilters()` method:

```php
User::withFilters()->get();
```

 
## Searchable Fields

Define a `$search` property in your model to enable search functionality. Use an array of field names, including related fields with dot notation (e.g., `roles.name`).

Example:

```php

class User extends Model
{

  protected $search = ['name', 'email', 'roles.name'];


   public function roles()
   {
        return $this->hasMany(Role::class);
   }

    /**
     * Register filters for the User model.
     *
     * @return array
     */
    public static function filters()
    {
        return [
             StatusFilter::class,
        ];
    }

}
```


