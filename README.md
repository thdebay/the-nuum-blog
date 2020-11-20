# About
This is an educational project made for demonstration purposes.

![ScreenShot](https://user-images.githubusercontent.com/1422621/99723298-47ad0a00-2ab2-11eb-935e-08d1b620e287.png)

## Installation

Git clone or download zip and extract it.

Create a .env file with at least the database settings ; for instance

`DATABASE_URL="mysql://user:password@127.0.0.1:3306/yourdatabasename?serverVersion=8.0"`

Install via composer ; please refer to the Symfony docs for additional information
```bash
composer install
```

Run the migrations:
`php bin/console doctrine:migrations:migrate`

Seed the database with some data to get started:

`php bin/console doctrine:fixtures:load`


You'll also need to install dependencies (Boostrap) and compile assets - this includes some static files:
```bash
 npm install && npm run build
```
