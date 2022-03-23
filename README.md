# MV-Tracker
## Author
[Fielden Rono](https://github.com/Kip-Rono)

## Description
MV-Tracker is a project made using Laravel framework to explain working MVC with CRUD capabilities
for an online inventory and e-commerce platform.


## User Stories
What the user does...
* A user can view parts in inventory list
* A user can save parts into their inventory
* A user can pair a mechanic with the services offered
* A user can view a mechanic and the services offered

## Endpoints (APIs)
### #1. fetch_spare_parts
Fetches all spare parts with no user input requirement

### #2. save_new_spare_parts
Saves data entered from form input elements and inserts to database,
after checking if it already exits or passes validation

$request_input = ['name', 'price', 'make', 'model']

### #3. save_pair_mechanic_services
Saves data entered from form input elements and inserts to database,
after checking if it already exits or passes validation.
User selects mechanic and services from a pool of mechanics and services

$request_input = ['mechanic_id', 'name', 'email'' 'service[]']

### #4. fetch_mechanic_services
Fetches all services offered by a mechanic

## Installation / Setup instruction
One can follow the following steps to get the project .......
#### The application requires the following installations to operate
* composer
* mysql database

#### Cloning the repository:
```https://github.com/Kip-Rono/LARA-API```

### Navigate into the LARA-API folder and install requirements
```cd LARA-API composer install  ```

### Change .env and generate app key
```- php artisan key:generate ```

### Setup Database - if needed
Set up your database user, password, host by running migration files
```php artisan migrate```

### Seed Database
Get default, initial, dummy table values
```php artisan db:seed```

### Run the application
```php artisan serve ```

Open the application on your browser 127.0.0.1:8000.

## Technologies Used

* composer
* Laravel
* Bootstrap
* HTML / CSS

## Known Bugs
* There are no known bugs at the moment

## Contact Information

If you have any question or contributions, please email me at [fieldenkiptoo@gmail.com]

## License
* [[License: MIT]](LICENCE.md)
* Copyright (c) 2020 **Fielden Rono**
