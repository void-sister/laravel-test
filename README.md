# Laravel Dashboard Test App

This is a Laravel test application designed to manage domains and plans for authenticated users.

---

## 🔧 Features

- User authentication
- Domain submission with validation
- List of submitted domains
- Admin users can view all registered users
- Authenticated users can view and buy plans

---

## ⚙️ Prerequisites

Make sure you have these installed on your machine:

- [Docker](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/)

---

## 🚀 Getting Started

Follow these steps to run the app locally.

### 1. Clone the repository

```bash
git clone https://github.com/void-sister/laravel-test.git
cd laravel-test
```

### 2. Copy the environment file

```bash
cp .env.example .env
```

Edit the `.env` file to set your database and other configurations.

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_test
DB_USERNAME=laravel
DB_PASSWORD=root
DB_ROOT_PASSWORD=root
```

### 3. Build and run the Docker containers

```bash
docker compose up -d --build
```

### 4. Install Composer dependencies

```bash
docker compose exec app composer install
```

### 5. Generate application key

```bash
docker compose exec app php artisan key:generate
```

### 6. Run migrations

```bash
docker compose exec app php artisan migrate
```

### 7. Seed the database (optional)

```bash
docker compose exec app php artisan db:seed
```

### 8. Give permissions to storage and bootstrap/cache directories

```bash
sudo chmod -R 777 storage bootstrap/cache
```

### 9. Access the application
Open your web browser and go to:

````
http://localhost
````
You should see the login page.

### 9. Create an admin user
You can create an admin user by running the following command:

```bash
docker compose exec app php artisan make:admin admin@example.com secretpassword
```

Then you can log in with the email and password you provided.

### 10. Run tests (optional)
You can run the tests using the following command:

```bash
docker compose exec app php artisan test
```

### 11. Stop the application
To stop the application, run:

```bash
docker compose down
```

### 12. Note

Every user from the seeder has password
```bash
password
```
