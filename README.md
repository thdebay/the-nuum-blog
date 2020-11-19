# About
This is an educational project made for demonstration purposes.

## Installation

Git clone or download zip and extract it.

Create a .env file with at least the database settings ; for instance

`DATABASE_URL="mysql://user:password@127.0.0.1:3306/yourdatabasename?serverVersion=8.0"`

Install via composer ; please refer to the Symfony docs for additional information
```bash
composer install
```

Run the migrations:
`doctrine:migrations:migrate`

It is highly advised to seed the database with some data to get started:

(TODO)


You'll also need to install dependencies (Boostrap) and compile assets - this includes some static files:
```bash
 npm install && npm run build
```
