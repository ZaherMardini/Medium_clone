# Medium_clone

## Description
A simple imitation of the blog site **Medium**, built with Laravel and Blade templates.  
This project demonstrates core backend development skills including authentication, CRUD operations, and user interactions.

## Tech Stack
- **Laravel** with Blade templates (server-rendered)
- **SQLite** database
- **Laravel Breeze** starter kit for authentication
- **Tailwind CSS v4** for styling
- **Alpine.js** with Axios for interactivity
- **Laravel Herd (Nginx)** to serve the backend
- **Vite** for frontend asset bundling

## Features
- User authentication (register/login via Breeze)
- CRUD operations on posts
- Like and comment functionality
- Follow other users to see their posts in your feed

## Installation

### Prerequisites
- PHP (>=8.2) with Composer
- Node.js (>=18) with npm
- SQLite
- [Laravel Herd](https://herd.laravel.com/) for serving the backend

### Setup Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/ZaherMardini/Medium_clone.git
   cd Medium_clone
   ```

2. Install PHP dependencies:
    ```bash
    composer install
    ```
3. Install javascript dependencies:
    ```bash
    npm install
    ```

4. Copy the environment file and generate app key:
   ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Run database migrations:
   ```bash
    php artisan migrate
   ```

6. Build and serve frontend assets:
    ```bash
    npm run dev
    ```
    
7. Serve the backend using Laravel Herd (it will automatically serve at http://localhost).