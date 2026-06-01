# E-Commerce Web Platform

A full-stack e-commerce application built with Laravel, Vue.js, and Tailwind CSS. 

## Prerequisites
Before you begin, ensure you have the following installed on your machine:
* [PHP](https://www.php.net/) (v8.1 or higher)
* [Composer](https://getcomposer.org/)
* [Node.js & npm](https://nodejs.org/)
* A local database (MySQL, PostgreSQL, or SQLite)

## Installation & Setup

Follow these steps to get the project running on your local machine:

**1. Clone the repository**
\`\`\`bash
git clone https://github.com/Hying9503/ecommerceWeb.git
cd ecommerce-web
\`\`\`

**2. Install PHP dependencies**
\`\`\`bash
composer install
\`\`\`

**3. Install JavaScript dependencies**
\`\`\`bash
npm install
\`\`\`

**4. Set up the environment file**
Copy the example environment file and create your own:
\`\`\`bash
cp .env.example .env
\`\`\`
*Note: If you are using SQLite (as configured by default in newer Laravel versions), you can skip database configuration. Otherwise, open `.env` and update your `DB_` variables to match your local setup.*

**5. Generate the application key**
\`\`\`bash
php artisan key:generate
\`\`\`

**6. Run database migrations and seed the database**
This will set up all necessary tables and populate the store with initial products:
\`\`\`bash
php artisan migrate --seed
\`\`\`

**7. Compile frontend assets**
\`\`\`bash
npm run dev
\`\`\`

**8. Start the local development server**
Open a new terminal tab and run:
\`\`\`bash
php artisan serve
\`\`\`
You can now access the application at `http://localhost:8000`.