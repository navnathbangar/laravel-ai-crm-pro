# AI CRM PRO

A modern AI-powered Customer Relationship Management (CRM) system built with Laravel 12. AI CRM PRO helps businesses manage customers, companies, products, leads, and tasks with Google Gemini AI integration for intelligent content generation.

---

## ✨ Features

### Dashboard
- Modern Dashboard
- Statistics Cards
- Quick Actions
- System Status

### Customer Module
- Customer CRUD
- Search & Pagination
- Soft Delete

### Company Module
- Company CRUD
- Logo Upload
- Search & Pagination
- Soft Delete

### Product Module
- Product CRUD
- SKU & Barcode
- Product Image
- Product Gallery (Multiple Images)
- Stock Management
- AI Product Description
- AI Meta Title
- AI Meta Description
- AI Meta Keywords
- AI Product Tags
- SEO Slug

### Lead Module
- Lead CRUD
- Lead Status
- Search & Pagination
- Soft Delete

### Task Module
- Task CRUD
- Status Management
- Search & Pagination
- Soft Delete

### AI Integration
- Google Gemini API
- AI Description Generator
- SEO Content Generator
- AI Tags Generator

---

## 🧪 Testing

This project includes automated testing for better reliability and code quality.

### Feature Tests
- Authentication Tests
- Customer Module Tests
- Company Module Tests
- Product Module Tests
- Lead Module Tests
- Task Module Tests

### Unit Tests
- Model Tests
- Service Tests
- Helper Tests
- AI Service Tests

Run all tests:

```bash
php artisan test
```

Run Feature Tests only:

```bash
php artisan test --testsuite=Feature
```

Run Unit Tests only:

```bash
php artisan test --testsuite=Unit
```

---

## 🚀 Installation

```bash
git clone https://github.com/navnathbangar/laravel-ai-crm-pro

cd ai-crm-pro

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan storage:link

npm run dev

php artisan serve
```

---

## 🛠 Technology Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Tailwind CSS
- JavaScript
- Vite
- Google Gemini API
- PHPUnit

---

## 📋 Current Modules

- ✅ Authentication
- ✅ Dashboard
- ✅ Customer
- ✅ Company
- ✅ Product
- ✅ Lead
- ✅ Task
- ✅ AI Integration
- ✅ Feature Tests
- ✅ Unit Tests

---

## 🚧 Roadmap

- Product Variants
- Orders
- Invoices
- Reports
- Roles & Permissions
- Notifications
- AI FAQ Generator
- AI Specification Generator
- Inventory Management

---

## 👨‍💻 Author

**Navnath Bangar**

Laravel | PHP | AI Integration Developer