# E-commerce Platform

<img width="851" height="315" alt="Bold Modern Business Marketing facebook Cover " src="https://github.com/user-attachments/assets/a649f6e9-666a-4c9c-a91d-e5cecfad98d7" />

A professional, full-featured e-commerce solution built with **Laravel 13**, **Blade**, **Vanilla CSS**, and **Alpine.js**. This platform provides a seamless shopping experience for customers and a robust management system for administrators and employees.

<img width="6004" height="1965" alt="snapmock-mockup (1)" src="https://github.com/user-attachments/assets/1f0e5e0b-d112-47be-a6a2-8162bb8472e5" />

## 🖼️ Screenshots

<details>
<summary>Click to expand screenshots</summary>

### Homepage
<img width="2932" height="1816" alt="snapmock-03" src="https://github.com/user-attachments/assets/829efb07-6707-42f5-a33e-e963a7ae0b17" />


### Product Catalog
<img width="2932" height="1816" alt="snapmock-02" src="https://github.com/user-attachments/assets/5f50eec5-4ec3-4205-8611-25b0dfa5e836" />


### Product Detail
<img width="2932" height="1816" alt="snapmock-04" src="https://github.com/user-attachments/assets/64fa611a-e9f8-4641-abdb-06994b26cf35" />


### Cart
<img width="2932" height="1816" alt="snapmock-05" src="https://github.com/user-attachments/assets/efa14e15-1370-4e96-8e13-64e8ba7fb5b6" />


### Checkout
<img width="2932" height="1816" alt="snapmock-mockup" src="https://github.com/user-attachments/assets/601b5ac7-31b3-40f9-85fc-be6c82c17118" />


### Customer Dashboard
<img width="2932" height="1816" alt="snapmock-06" src="https://github.com/user-attachments/assets/8039ce6e-3d71-4a20-9ed1-864546aba1fa" />


### Admin Panel
<img width="2932" height="1816" alt="snapmock-01" src="https://github.com/user-attachments/assets/1bed1afa-e0c4-4eac-90d0-26fe697770b1" />



</details>


## 🚀 Features

### 🛍️ Shopping Experience
- **Catalog & Discovery**: Browse products with advanced filtering by category, origin, and material. High-quality product images and detailed descriptions.
- **Smart Cart**: Real-time cart updates, quantity management, and automatic subtotal calculation. Works for both guests and logged-in users.
- **Secure Checkout**: Streamlined checkout process with address management and mock payment methods (Cash on Delivery, Credit Card, PayPal).
- **User Dashboard**: Customers can track orders, manage wishlists, update addresses, and edit profile settings.

### 🔐 Multi-Role Access Control
- **Admin (`admin`)**: Full control over the platform. Manages users, settings, product approvals, categories, and business logic.
- **Employee (`employee`)**: Manages products (creates/edits/deletes – all require admin approval), views orders and updates their status. Has limited administrative access.
- **Customer (`customer`)**: Standard shopping, ordering, and account management.

### 🛠️ Administrative & Management Power
- **Product Approval Workflow**: Employees submit product creations, updates, or deletions. Admins review and approve/reject these changes in a dedicated approval queue with side‑by‑side diff comparison.
- **Order Management**: Real‑time status updates (pending → processing → shipped → delivered). Both employees and admins can manage orders.
- **Analytics Dashboard**: Admin‑only dashboard with key metrics: total orders, pending/processing orders, active products, and total users.

## 🧱 Architecture & Tech Stack

- **Backend Framework**: [Laravel 13](https://laravel.com) – robust routing, Eloquent ORM, Blade templating, Breeze authentication.
- **Frontend Styling**: Custom CSS with design tokens (CSS custom properties) for a consistent editorial look.
- **Frontend Interactivity**: [Alpine.js](https://alpinejs.dev) & vanilla JavaScript for dynamic UI components.
- **Icons**: [Iconoir](https://iconoir.com) – open‑source icon library.
- **Asset Bundling**: [Vite](https://vitejs.dev) for fast asset compilation.
- **Database**: MySQL (production) / SQLite (testing). Eloquent ORM handles all database interactions.

## 📋 Prerequisites

- **PHP 8.3+**
- **Composer**
- **Node.js & npm**
- **Git**

## ⚙️ Installation & Setup (Manual)

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd E-commerce
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Set up environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** in `.env` (default is MySQL). Then run migrations and seed:
   ```bash
   php artisan migrate --seed
   ```

5. **Install frontend dependencies and build assets**:
   ```bash
   npm install
   npm run build
   ```

6. **Start the development server**:
   ```bash
   php artisan serve
   ```
   The app will be available at `http://localhost:8000`.

## 🐳 Docker Setup

For a containerized environment, the project includes a `docker-compose.yml`. This automatically sets up PHP 8.4, MySQL 8.4, and Node.js for Vite.

1. **Start the containers**:
   ```bash
   docker-compose up -d
   ```

2. **Access the application**:
   - App: `http://localhost:8000`
   - Vite dev server (for hot reload): `http://localhost:5173`

3. **Stop containers**:
   ```bash
   docker-compose down
   ```

The `app` service runs `composer install`, generates the app key, links storage, and seeds the database automatically on startup.

## 🚀 Render Deployment

This project is deployed on Render as a single Docker web service. That one service runs both the Laravel backend and the Blade frontend.

1. Create a Render Web Service and choose `Docker` as the runtime.
2. Point Render to [render.yaml](render.yaml) or the repo root with [Dockerfile](Dockerfile).
3. Set `DB_URL` in the Render dashboard to your Neon PostgreSQL connection string.
4. Deploy the service and let Render build the Docker image.
5. Visit the app URL and confirm `https://your-service.onrender.com/health` returns `{"status":"ok"}`.

## 🔐 Default Test Credentials

After seeding, use these accounts to test the roles and approval workflow:

| Role | Email | Password | Access Level |
| :--- | :--- | :--- | :--- |
| **Admin** | `abdu@gmail.com` | `abderrahmane` | Full access, approves/rejects changes. |
| **Employee** | `employee@gmail.com` | `employeeadmin` | Manages products (pending approval), views orders. |
| **Customer** | _(generated by seeder)_ | `password` | Shopping and profile management. |

## 🖥️ Development

For efficient development, start both the Laravel server and Vite dev server concurrently:
```bash
composer run dev
```
This runs `php artisan serve` and `npm run dev` together.


## 📁 Key Directory Structure

- `app/Http/Controllers/Admin/` – Admin panel controllers (Dashboard, Products, Orders, Approval, Categories, Users, Settings).
- `app/Http/Controllers/Shop/` – Public‑facing store controllers (Catalog, Cart, Checkout).
- `app/Models/` – Eloquent models (User, Product, Order, Cart, Wishlist, etc.).
- `resources/views/` – Blade templates (`admin/`, `shop/`, `profile/`, `layouts/`).
- `database/seeders/` – Seeders for demo data, products (with real images), categories, and users.

## 🧪 Testing

Run the automated PHPUnit test suite:
```bash
composer run test
```

## 📄 License

This project is open‑sourced software licensed under the [MIT license](LICENSE).
