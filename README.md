# Task Management App

It is a simple task management app written in Laravel

## Setup

Clone this app repository

```bash
git clone https://github.com/MWaqar948/Task-Management-App.git
```
Install composer dependencies

```bash
composer install
```
Setup environment file

Create .env file from .env.example
```bash
cp .env.example .env
```
Setup Database Connection in .env file
```php
DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=todo-db
DB_USERNAME=root
DB_PASSWORD=
```
Generate key in terminal
```
php artisan key:generate
```

Run migrations
```bash
php artisan migrate
```

Install npm dependencies

```bash
npm install
```

## Run
Start up the laravel server in a terminal
```bash
php artisan serve
```
Start node server in another terminal
```bash
npm run dev
```
Open this URL in browser
```php
http://localhost:8000
```
## Testing
Run test command in terminal to run unit tests
```bash
php artisan test
```
