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
