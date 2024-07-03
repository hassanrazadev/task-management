# Task Management Laravel Application

This is a simple Laravel web application for managing tasks. The application allows you to create, edit, delete, and reorder tasks. Tasks are saved to a MySQL database and are associated with projects.

## Features

- Create tasks with a name and priority
- Edit tasks
- Delete tasks
- Reorder tasks with drag and drop functionality (priority updates automatically)
- Filter tasks by project

## Requirements

- PHP >= 8.0
- Composer
- MySQL
- Node.js and npm (for front-end dependencies and build tools)

## Installation

Unzip project and move to directory
```shell
cd task-management
```

### Install PHP dependencies
```shell
composer install
```

### Install Node.js dependencies
```shell
npm install
```

### Environment configuration
Copy the .env.example file to .env and update the necessary environment variables:

```shell
cp .env.example .env
```
### Generate application key
```shell
php artisan key:generate
```

### Database configuration
Update the .env file with your database credentials:
```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Run database migrations
```shell
php artisan migrate
```

### Seed the database (optional)
```shell
php artisan db:seed
```

### Build front-end assets
```shell
npm run dev
```

### Start the development server
```shell
php artisan serve
```
Visit http://127.0.0.1:8000 in your browser to access the application.
