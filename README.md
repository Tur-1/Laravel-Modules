
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
    ├── Enums/
    │   ├── AdminGenderEnum.php
    │   └── AdminStatusEnum.php
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
    ├── Repositories/
    │   └── AdminRepository.php
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
composer require tur1/laravelmodules
```

## Artisan Commands

### Create a Module

To create a new module, use the following command:

```bash
php artisan module:create {name}
```

Example:

```bash
php artisan module:create Users
```

This will generate a `Users` module in the `app/Modules` directory.

### Create a Page

To create a new page within a module, use:

```bash
php artisan page:create {name}
```

Example:

```bash
php artisan page:create Dashboard
```

This will generate a `Dashboard` page in the specified module.

### Create a Filter

To create a new filter within a module, use:

```bash
php artisan filter:create {filter-name} --module={module-name}
```

Example:

```bash
php artisan filter:create Filter --module=Users
```

This will create a `Filter` class in the `app/Modules/Users/Filters` directory.

## Registering Filters in a Model

You can register filters for a model by defining a `filters()` method in your model. For example:

```php
public static function filters()
{
    return [
        Filter::class,
    ];
}
```

This allows you to apply filters on your model's query, making it easier to build dynamic filtering logic.

## Searchable Fields

To enable search functionality in your model, define a `$search` property. This property should be an array of field names that can be searched. You can also include related fields by specifying the relationship and field name in dot notation (e.g., `roles.name`).

Example:

```php
protected $search = ['name', 'email', 'roles.name'];
```


