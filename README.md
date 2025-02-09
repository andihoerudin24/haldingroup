# Simple E-Commerce Project

This project is a simple e-commerce system built with Laravel 11 and PHP 8.4 (latest version). It includes features such as product listing, cart management (with session-based storage), checkout, and order history.

---

## Requirements

- PHP 8.4 (or higher)
- Composer
- Laravel 11
- A database supported by Laravel (MySQL, PostgreSQL, etc.)

---

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/andihoerudin24/haldingroup
   cd your-repo
   ```

2. **Install dependencies via Composer:**

   ```bash
   composer install
   ```

3. **Copy the environment file:**

   A sample environment file (`.env.example`) is provided. Copy it to create your local `.env` file:

   ```bash
   cp .env.example .env
   ```

4. **Configure the `.env` file:**

   Open the `.env` file and set your database credentials and other environment variables as needed. For example:

   ```dotenv
   
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:1rAMtr0GURnlc33WHdIkvSXG/oUGVVONZQWLX5WPV4U=
    APP_DEBUG=true
    APP_TIMEZONE=UTC
    APP_URL=http://localhost

    APP_LOCALE=en
    APP_FALLBACK_LOCALE=en
    APP_FAKER_LOCALE=en_US

    APP_MAINTENANCE_DRIVER=file
    # APP_MAINTENANCE_STORE=database

    PHP_CLI_SERVER_WORKERS=4

    BCRYPT_ROUNDS=12

    LOG_CHANNEL=stack
    LOG_STACK=single
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=haldingroup
    DB_USERNAME=root
    DB_PASSWORD=

    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null

    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=database

    CACHE_STORE=database
    CACHE_PREFIX=

    MEMCACHED_HOST=127.0.0.1

    REDIS_CLIENT=phpredis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=log
    MAIL_SCHEME=null
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false

    VITE_APP_NAME="${APP_NAME}"

   ```

5. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

---

## Database Setup

1. **Run migrations:**

   The project uses migrations to set up the necessary tables for products, cart items, orders, and order items. To run migrations, execute:

   ```bash
   php artisan migrate
   ```

2. **Run seeders (optional):**

   If sample data for products is provided, run the seeder to populate the database:

   ```bash
   php artisan db:seed 
   ```

---

## Running the Application

Start the development server using Artisan:

```bash
php artisan serve
```

Now, open your browser and navigate to [http://localhost:8000](http://localhost:8000).

---

## Features

- **Product Listing & Detail:**
  - View a list of products.
  - See product details.

- **Cart Management:**
  - Add products to the cart (using session-based cart items).
  - Update quantity with plus and minus buttons.
  - Delete cart items.
  - View total items and subtotal.

- **Checkout Process:**
  - Convert cart items into an order.
  - Generate an order number and store order details.
  - Clear the cart upon successful checkout.


---

## Routes

Some key routes used in the application are:

- **Products:**
  - `GET /products` – List all products.
  - `GET /products/{id}` – View product detail.

- **Cart:**
  - `POST /cart/add/{product}` – Add a product to the cart.
  - `POST /cart/update/{cartItem}` – Update cart item quantity.
  - `DELETE /cart/{cartItem}` – Remove a cart item.
  - `GET /cart` – View the cart.

- **Checkout:**
  - `POST /checkout` – Process checkout.
  - `GET /checkout/success` – Checkout success page.

- **Orders:**
  - `GET /orders` – List orders.
  - `GET /orders/{order}` – Order details.

---

## Additional Information

- **Laravel Version:** 11  
- **PHP Version:** 8.4 (Latest)  
- **Environment:** Configure the `.env` file as per your local setup.

Feel free to modify and extend this project as per your requirements. Contributions and suggestions are welcome.

---

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

