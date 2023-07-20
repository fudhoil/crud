## Simple CRUD using Laravel

### How to run the code

download the code and run the following command:

```bash
$ composer install
```

copy the .env.example file and rename it to .env

```bash
$ cp .env.example .env
```

generate the key

```bash
$ php artisan key:generate
```

create the database and update the .env file with the database name, username and password

```bash
$ php artisan migrate
```

run the server

```bash
$ php artisan serve
```

open the browser and go to: http://localhost:8000/users


## What's next?
you can start by editing the following files:

```
app/
    Http/
        Controllers/
            UserController.php <-- this is where the logic is
    ...

app/
    Models/
        User.php <-- this is the model

resources/
    views/
        users/
            index.blade.php <-- this is the view
    ...

routes/
    web.php <-- this is the route
    ...

database/
    migrations/
        2014_10_12_000000_create_users_table.php <-- this is the migration
    ...

```

