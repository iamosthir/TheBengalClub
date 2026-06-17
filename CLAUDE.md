# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

BengalClub is a Laravel 12 membership club management application with separate admin and member portals. The admin panel uses AdminLTE 3, while the frontend/member portal uses Vite with Tailwind CSS 4. The application uses MySQL as the primary database.

## Development Commands

### Initial Setup
```bash
composer setup
```
This runs the full setup: installs dependencies, copies `.env.example` to `.env`, generates app key, runs migrations, and builds frontend assets.

### Development Server
```bash
composer dev
```
Starts three concurrent processes:
- Laravel development server (`php artisan serve`)
- Queue worker (`php artisan queue:listen --tries=1`)
- Vite dev server with HMR (`npm run dev`)

### Testing
```bash
composer test                      # Run full test suite
php artisan test --filter=TestName # Run specific test
```

PHPUnit uses SQLite in-memory database (see [phpunit.xml](phpunit.xml)).

### Code Quality
```bash
./vendor/bin/pint                  # Fix code style issues
./vendor/bin/pint --test           # Check without fixing
```

### Database
```bash
php artisan migrate                # Run migrations
php artisan migrate:fresh --seed   # Reset and seed (AdminSeeder creates admin accounts)
```

### Building Assets
```bash
npm run build   # Production build
npm run dev     # Development with HMR
```

## Architecture

### Authentication (Two Guards)

Two separate auth guards — this is fundamental to the routing logic:
- `web` guard — frontend `User` model (members)
- `admin` guard — `Admin` model, used as `auth:admin` on all admin routes

All admin routes are under `/admin` prefix with `auth:admin` middleware. Member-authenticated routes are under `/member` prefix.

### Controllers Structure

Controllers are split into three namespaces:
- `App\Http\Controllers\Admin\` — all 17 admin CRUD controllers
- `App\Http\Controllers\Frontend\` — member auth, forgot password, dashboard, public profile
- `App\Http\Controllers\` — public-facing: `FrontEndController`, `ContactController`, `MembershipApplicationController`

### Key Business Flows

**Membership Application Flow:**
1. Public user submits application form with photo, NID, and reference info (`MembershipApplicationController`)
2. Admin reviews and approves/rejects via `Admin\MembershipApplicationController`
3. On approval: `User` and `UserProfile` records are created, installments generated automatically
4. Member receives welcome email; can log in to member portal

**Membership Installments:**
- Membership fees are split into installments (`MembershipInstallment` model)
- Each installment tracks amount, due date, status (pending/completed/overdue)
- `MembershipTransaction` records individual payments
- Admins mark installments complete via `Admin\MembershipInstallmentController`

**Invitation System:**
- Admins send invitations with a unique `invite_id`
- Invitations can specify membership category and a custom application fee (overrides global `application_fee` from `SiteSetting`)

**Admin Impersonation:**
- Admins can impersonate members (stored in session) via `POST /admin/registered-members/{id}/impersonate`
- Stop impersonating via `POST /member/stop-impersonating`

**Password Reset:**
- OTP-based (not Laravel's default token-based) — stored in `password_reset_otps` table
- Flow: send OTP → verify OTP → reset password

**Event Notifications:**
- When an event is created, `SendEventNotificationEmail` job is dispatched (queued) to email all members
- Queue must be running (`php artisan queue:listen`) for emails to send

**Inquiry Rate Limiting:**
- Contact form (`Inquiry` model): max 2 submissions per 24 hours with minimum 12-hour gap between them (IP-based, enforced in `canSendInquiry()`)

### Models — Important Patterns

- `SiteSetting` and `SeoSetting` are singletons — always `firstOrCreate(['id' => 1])`, ID always 1
- `ViewServiceProvider` shares both with all views automatically — access as `$siteSetting` and `$seoSetting` in any Blade template
- JSON columns: `Event::gallery_images`, `Facility::features`, `MembershipCategory::features`, `BoardDirector::social_links` — stored as JSON arrays
- `MembershipApplication` has scopes: `pending()`, `accepted()`, `rejected()`

### Key Packages

- `barryvdh/laravel-dompdf` — PDF generation for membership applications and certificates
- `simplesoftwareio/simple-qrcode` — QR code generation for member profiles (accessible at `/member/{userId}/qr-code`)

### Frontend vs Admin Assets

**Admin Panel** — no Vite, all pre-compiled:
- AdminLTE 3 CSS/JS from `public/dist/`
- Plugins (jQuery, Bootstrap 4, Summernote, SweetAlert2, etc.) from `public/plugins/`
- Dark mode toggle persisted via `localStorage`

**Member/Frontend Portal** — Vite compiled:
- Entry: `resources/css/app.css` + `resources/js/app.js`
- Tailwind CSS 4 via `@tailwindcss/vite` plugin
- Vite ignores `storage/framework/views/**`

### Database

- **Development:** MySQL, database named `bengalclub`
- **Testing:** SQLite in-memory (`:memory:`)
- Session, queue, and cache: all database-backed

### Seeders

- `DatabaseSeeder` — creates a test user (`test@example.com`)
- `AdminSeeder` — seeds admin accounts (run via `migrate:fresh --seed`)
