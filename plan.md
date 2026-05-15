# LaporIn — Project Implementation Plan

> **Generated from LaporIn_Documentation.md**
> Framework: Laravel 11 | PHP 8.2 | MySQL 8.0 | Tailwind CSS 3.x | Alpine.js 3.x
> Methodology: Waterfall SDLC (6 implementation phases + testing + finalize)

---

## Skills Used Throughout This Project

| Skill | Phase(s) | Purpose |
|-------|----------|---------|
| `laravel-expert` | All phases | Core Laravel conventions, thin controllers, FormRequests, Policies, Eloquent |
| `tailwind-design-system` | 2, 3, 6 | Responsive UI, status badges, layout components, design tokens |
| `php-pro` | All phases | PHP 8.2 strict typing, typed properties, match expressions |
| `database-design` | 1 | Migration schema, FK constraints, indexes, seeders |
| `api-design-principles` | 5 | REST endpoint design, JSON responses, pagination, rate limiting |
| `api-security-best-practices` | 4, 5, 7 | Sanctum auth, Gate/Policy, CSRF, input validation |
| `test-driven-development` | 7 | PHPUnit feature/unit tests, auth tests, negative authorization tests |
| `error-handling-patterns` | 4, 5, 6 | Custom error pages (403/404/500), API error standardization |
| `git-pushing` | All phases | Conventional commits and push after each phase completion |

---

## Git Commit Strategy

Minimum one commit per phase. Additional commits for significant sub-features or bug fixes.

| # | Phase | Commit Message |
|---|-------|----------------|
| 1 | Foundation | `feat: initialize Laravel 11 project with Breeze auth, Sanctum, migrations, models, and seeders` |
| 2 | User Features | `feat: implement user dashboard, complaint CRUD with image upload, and about page` |
| 3 | Admin Panel | `feat: implement admin panel with dashboard stats, complaint management, categories CRUD, and responses` |
| 4 | Auth & Gates | `feat: implement role middleware, gates, policies, and authorization enforcement` |
| 5 | REST API | `feat: implement REST API with Sanctum auth, all endpoints, rate limiting, and standardized responses` |
| 6 | UI Polish | `feat: polish UI with responsive Tailwind layouts, error pages, flash messages, and status badges` |
| 7 | Testing | `test: add PHPUnit feature tests for auth, complaints, categories, admin, and negative authorization` |
| 8 | Finalize | `chore: implement caching, storage:link, documentation final, and code cleanup` |

---

## Phase 0: Pre-Implementation Checklist

- [ ] PHP 8.2+ installed (`php -v`)
- [ ] Composer installed (`composer -V`)
- [ ] Node.js + npm installed (`node -v`, `npm -v`)
- [ ] MySQL 8.0+ running (via XAMPP / Laragon / Herd)
- [ ] Git remote configured: `origin` = `https://github.com/syawalqi/PWFtgasakir.git`
- [ ] `LaporIn_Documentation.md` reviewed and understood

---

## Phase 1: Foundation (Project Setup & Database)

### Step 1.1 — Create Laravel Project
```bash
composer create-project laravel/laravel:^11.0 laporin
```
Verify: `http://localhost:8000` shows Laravel welcome page.

### Step 1.2 — Configure Environment
- Copy `.env.example` -> `.env`
- Set `APP_NAME=LaporIn`, `APP_URL=http://localhost:8000`
- Configure MySQL: `DB_DATABASE=lapor_in`, `DB_USERNAME=root`, `DB_PASSWORD=`
- Run `php artisan key:generate`

### Step 1.3 — Install Frontend Dependencies
```bash
npm install
npm install -D tailwindcss@^3.4 postcss@^8.4 autoprefixer@^10.4 @tailwindcss/forms@^0.5 alpinejs@^3.13
npx tailwindcss init -p
```
- Configure `tailwind.config.js` content paths to all Blade files
- Configure `vite.config.js` for Laravel

### Step 1.4 — Install Laravel Breeze (Blade stack)
```bash
composer require laravel/breeze:^2.0 --dev
php artisan breeze:install blade
```
Scaffolds: auth controllers, login/register views, dashboard, auth routes, `@vite` directives.

### Step 1.5 — Install Sanctum
```bash
php artisan install:api
```
Publishes Sanctum config and migration.

### Step 1.6 — Database Schema (Migrations)

Create 4 migration files in this order:

**Migration 1: add_role_to_users_table**
- Column: `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user'

**Migration 2: create_complaint_categories_table**
- `id` (PK BIGINT UNSIGNED AUTO_INCREMENT)
- `name` VARCHAR(100) NOT NULL UNIQUE
- `created_at`, `updated_at` TIMESTAMP NULL

**Migration 3: create_complaints_table**
- `id` (PK BIGINT UNSIGNED AUTO_INCREMENT)
- `user_id` BIGINT UNSIGNED FK -> users(id) ON DELETE CASCADE
- `category_id` BIGINT UNSIGNED FK -> complaint_categories(id) ON DELETE RESTRICT
- `title` VARCHAR(255) NOT NULL
- `description` TEXT NOT NULL
- `status` ENUM('pending','diproses','selesai') DEFAULT 'pending'
- `image` VARCHAR(255) NULLABLE
- `created_at`, `updated_at` TIMESTAMP NULL
- INDEX on `status`

**Migration 4: create_responses_table**
- `id` (PK BIGINT UNSIGNED AUTO_INCREMENT)
- `complaint_id` BIGINT UNSIGNED FK -> complaints(id) ON DELETE CASCADE
- `user_id` BIGINT UNSIGNED FK -> users(id) ON DELETE CASCADE
- `message` TEXT NOT NULL
- `created_at`, `updated_at` TIMESTAMP NULL

Run: `php artisan migrate`

### Step 1.7 — Eloquent Models

| Model | File | Key Methods |
|-------|------|-------------|
| User | `app/Models/User.php` | `complaints()`, `responses()`, `isAdmin(): bool` |
| Complaint | `app/Models/Complaint.php` | `user()`, `category()`, `responses()`, `isPending(): bool`, `getStatusBadgeAttribute(): string` |
| ComplaintCategory | `app/Models/ComplaintCategory.php` | `complaints()` |
| Response | `app/Models/Response.php` | `complaint()`, `user()` |

All models: `$fillable` defined. User: `protected $casts = ['password' => 'hashed']`.

### Step 1.8 — Seeders

**CategorySeeder** — Inserts 5 defaults:
```
Infrastruktur, Kebersihan, Keamanan, Pelayanan, Lainnya
```

**AdminSeeder** — Creates admin account:
```
name: Super Admin, email: admin@lapor.in, password: admin123 (bcrypt), role: admin
```

**DatabaseSeeder** — Calls both seeders.

Run: `php artisan db:seed`

### Step 1.9 — Commit & Push

**Deliverables:** Working Laravel app with auth, database schema, seeded test data.

---

## Phase 2: Core User Features

### Step 2.1 — User Layout
**File:** `resources/views/layouts/app.blade.php`
- Top navbar: LaporIn brand, Dashboard, Aduan Saya, Tentang links, user dropdown (name + Logout)
- Mobile responsive hamburger menu (Alpine.js `x-data` toggle)
- Flash message area (success green / error red)
- `<main>` content slot `{{ $slot }}`
- Footer with copyright

### Step 2.2 — User Dashboard
**Controller:** `app/Http/Controllers/User/DashboardController.php`
- `index()` -> view with stats for logged-in user:
  - `total` = Complaint::where('user_id', auth()->id())->count()
  - `pending` = count where status = 'pending'
  - `diproses` = count where status = 'diproses'
  - `selesai` = count where status = 'selesai'

**View:** `resources/views/user/dashboard.blade.php`
- Greeting card: "Selamat datang, {name}!"
- 4 stat cards (grid 2x2 on mobile, 4-col on desktop)
- Large CTA button: "+ Buat Aduan Baru"

### Step 2.3 — User Complaint Controller
**File:** `app/Http/Controllers/User/ComplaintController.php`
- `index()` — Paginated list (10 per page), eager load `category`, order by `created_at DESC`, only user's own complaints
- `create()` — Return view with categories (dropdown)
- `store(StoreComplaintRequest)` — Create complaint + handle image upload. Image stored in `storage/app/public/complaints/` with unique name (time() + original extension)
- `show(Complaint)` — Show detail + responses. Authorize: must be owner OR admin
- `edit(Complaint)` — Show edit form. Authorize: must be owner AND status = 'pending'
- `update(UpdateComplaintRequest, Complaint)` — Update fields. If new image uploaded, delete old image, store new one
- `destroy(Complaint)` — Delete complaint + delete image file from storage. Authorize: must be owner AND status = 'pending'

### Step 2.4 — Form Request Validation
**File:** `app/Http/Requests/StoreComplaintRequest.php`
```php
public function rules(): array
{
    return [
        'title' => ['required', 'string', 'min:5', 'max:255'],
        'category_id' => ['required', 'exists:complaint_categories,id'],
        'description' => ['required', 'string', 'min:20'],
        'image' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png'],
    ];
}
```

**File:** `app/Http/Requests/UpdateComplaintRequest.php` — Same rules.

### Step 2.5 — User Views

```
resources/views/user/
  dashboard.blade.php         -- Stats cards + CTA
  complaints/
    index.blade.php           -- Card-based list, each card: title, category badge, status badge, date, action buttons
    create.blade.php          -- Form: title input, category select, description textarea, image upload with Alpine.js preview
    edit.blade.php            -- Same form pre-filled with old data
    show.blade.php            -- Detail card + status badge large + image display + response timeline (chat bubbles)
```

**Index view**: cards with `bg-white shadow rounded-lg p-6` per complaint
**Show view**: complaint info card + "Riwayat Tanggapan" section with each response in chat-bubble style
**Create/Edit view**: form with Tailwind form styles, Alpine.js image preview (`x-data`, `x-on:change`, `URL.createObjectURL`)

### Step 2.6 — User Routes
In `routes/web.php`:
```php
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [User\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('complaints', User\ComplaintController::class);
});
```

### Step 2.7 — Image Upload Handling
- Storage path: `storage/app/public/complaints/`
- Run `php artisan storage:link` once
- Filename: `time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension()`
- Display: `asset('storage/complaints/' . $complaint->image)`
- Delete old file on update: `Storage::disk('public')->delete($oldImage)`
- Delete file on complaint delete

### Step 2.8 — About Page
**Controller:** `app/Http/Controllers/PageController.php`
- `about()` -> return view('pages.about')

**View:** `resources/views/pages/about.blade.php`
- Static informational page about LaporIn
- Accessible at `/about` for both guest and authenticated users

### Step 2.9 — Commit & Push

**Deliverables:** User can register, login, create/view/edit/delete complaints with image upload, view about page.

---

## Phase 3: Admin Panel

### Step 3.1 — Admin Layout
**File:** `resources/views/layouts/admin.blade.php`
- Fixed left sidebar (hidden on mobile, toggle with Alpine.js hamburger):
  - Dashboard (icon: home)
  - Semua Aduan (icon: clipboard-list)
  - Kategori (icon: tag)
  - Tentang (icon: information-circle)
- Top header bar: admin name + Logout button
- Main content area `<main>` with `{{ $slot }}`
- Flash message area
- Breadcrumb slot

### Step 3.2 — Admin Dashboard
**Controller:** `app/Http/Controllers/Admin/DashboardController.php`
- `index()` -> view with:
  - `total` = Complaint::count()
  - `pending`, `diproses`, `selesai` counts
  - `recentComplaints` = Complaint::with('user', 'category')->latest()->take(5)->get()

**View:** `resources/views/admin/dashboard.blade.php`
- 4 stat cards (color-coded: blue, yellow, amber, green) with icon + count + label
- Table: 5 most recent complaints with columns: No, Pelapor, Judul, Kategori, Status badge, Tanggal

### Step 3.3 — Admin Complaint Controller
**File:** `app/Http/Controllers/Admin/ComplaintController.php`
- `index(Request $request)` — All complaints with filters:
  - Query params: `status`, `search`, `category_id`
  - Apply `when()` scopes for each filter
  - `status` filter: dropdown All | Pending | Diproses | Selesai
  - `search` filter: `WHERE title LIKE '%keyword%'`
  - Paginated (10 per page), eager load `user` and `category`
- `show(Complaint $complaint)` — Detail view with:
  - Complaint info card (title, pelapor, kategori, date, status, description, image)
  - Status update dropdown + button
  - Response timeline
  - Response form (textarea + submit)
- `updateStatus(Request $request, Complaint $complaint)` — Gate: `update-complaint-status`
  - Validate: `status` required, in:pending,diproses,selesai
  - Update complaint status
  - Flash success message

### Step 3.4 — Admin Category Controller
**File:** `app/Http/Controllers/Admin/CategoryController.php`
- `index()` — List categories with `withCount('complaints')`
- `create()` — Show form
- `store(StoreCategoryRequest)` — Create category
- `edit(ComplaintCategory)` — Show edit form
- `update(StoreCategoryRequest, ComplaintCategory)` — Update category
- `destroy(ComplaintCategory)` — Delete (FK RESTRICT will prevent delete if category has complaints)

### Step 3.5 — Admin Response Controller
**File:** `app/Http/Controllers/Admin/ResponseController.php`
- `store(Request $request, Complaint $complaint)` — Gate: `create-response`
  - Validate: `message` required, string, min:10
  - Create response with `complaint_id`, `user_id` (admin), `message`
  - Redirect back with success flash

### Step 3.6 — Form Requests
**File:** `app/Http/Requests/StoreCategoryRequest.php`
```php
public function rules(): array
{
    return [
        'name' => ['required', 'string', 'min:3', 'max:100', 'unique:complaint_categories,name'],
    ];
}
```
Ignore current ID on update: add `->ignore($this->category)` for update route.

**File:** `app/Http/Requests/StoreResponseRequest.php`
```php
public function rules(): array
{
    return [
        'message' => ['required', 'string', 'min:10'],
    ];
}
```

### Step 3.7 — Admin Views

```
resources/views/admin/
  dashboard.blade.php           -- 4 stat cards + recent 5 complaints table
  complaints/
    index.blade.php             -- Filter bar (status dropdown, search input, category select) + data table
    show.blade.php              -- Info card, status update form, response list, response form
  categories/
    index.blade.php             -- Table: No, Nama, Jumlah Aduan, Actions (Edit/Hapus) + "Tambah" button
    create.blade.php            -- Form: name input
    edit.blade.php              -- Form: name input pre-filled
```

### Step 3.8 — Admin Routes
In `routes/web.php`:
```php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('complaints', Admin\ComplaintController::class)->only(['index', 'show']);
    Route::patch('complaints/{complaint}/status', [Admin\ComplaintController::class, 'updateStatus'])->name('complaints.status');
    Route::resource('categories', Admin\CategoryController::class);
    Route::post('complaints/{complaint}/responses', [Admin\ResponseController::class, 'store'])->name('responses.store');
});
```

### Step 3.9 — Commit & Push

**Deliverables:** Admin can view dashboard stats, filter/search complaints, update status, respond to complaints, manage categories.

---

## Phase 4: Authorization (Gates, Policies, Middleware)

### Step 4.1 — Role Middleware
**File:** `app/Http/Middleware/RoleMiddleware.php`
```php
public function handle(Request $request, Closure $next, string $role): Response
{
    if (!$request->user() || $request->user()->role !== $role) {
        abort(403);
    }
    return $next($request);
}
```
Register in `bootstrap/app.php` as `role` middleware alias.

### Step 4.2 — Gate Definitions
**File:** `app/Providers/AuthServiceProvider.php` (or `AppServiceProvider` in Laravel 11)
```php
Gate::define('manage-categories', fn(User $user) => $user->role === 'admin');
Gate::define('update-complaint-status', fn(User $user) => $user->role === 'admin');
Gate::define('view-all-complaints', fn(User $user) => $user->role === 'admin');
Gate::define('create-response', fn(User $user) => $user->role === 'admin');
Gate::define('access-admin', fn(User $user) => $user->role === 'admin');
```

### Step 4.3 — ComplaintPolicy
**File:** `app/Policies/ComplaintPolicy.php`
```php
public function view(User $user, Complaint $complaint): bool
{
    return $user->id === $complaint->user_id || $user->role === 'admin';
}

public function update(User $user, Complaint $complaint): bool
{
    return $user->id === $complaint->user_id && $complaint->status === 'pending';
}

public function delete(User $user, Complaint $complaint): bool
{
    return $user->id === $complaint->user_id && $complaint->status === 'pending';
}
```

Register in `AuthServiceProvider`: `$this->registerPolicies()` if needed.

### Step 4.4 — Apply Authorization in Controllers
- User\ComplaintController: use `$this->authorize('view', $complaint)` etc.
- Admin controllers: use `Gate::allows()` or `$this->authorize()` in methods
- All routes behind `role:admin` or `role:user` middleware

### Step 4.5 — Post-Login Redirect
Modify `AuthenticatedSessionController` (or `app/Http/Controllers/Auth/AuthController.php`):
- After login, redirect admin to `/admin/dashboard`
- After login, redirect user to `/user/dashboard`

### Step 4.6 — Custom Error Pages
Create views:
```
resources/views/errors/
  403.blade.php     -- "Akses Ditolak" page
  404.blade.php     -- "Halaman Tidak Ditemukan" page
  500.blade.php     -- "Kesalahan Server" page
```
All extend app layout with consistent design.

### Step 4.7 — Commit & Push

**Deliverables:** Role-based access fully enforced, unauthorized access returns 403, policies prevent cross-user manipulation.

---

## Phase 5: REST API

### Step 5.1 — Sanctum Configuration
- Verify `config/sanctum.php` is published
- Ensure `HasApiTokens` trait is on User model
- API routes in `routes/api.php` use `throttle:60,1` middleware

### Step 5.2 — API Response Standardization
Create a helper or base controller pattern:
```php
// All API responses follow this format:
{
    "success": true|false,
    "message": "...",
    "data": { ... }
}
```

Use a trait or helper method in a base `ApiController`:
```php
protected function successResponse($data, string $message = 'Success', int $code = 200)
protected function errorResponse(string $message, int $code = 400, $errors = null)
```

### Step 5.3 — API Auth Controller
**File:** `app/Http/Controllers/Api/AuthController.php`
- `register(Request)` — Create user with role='user', return token + user data, code 201
- `login(Request)` — Validate credentials, return token + user, code 200
- `logout(Request)` — Delete current token, code 200
- `me(Request)` — Return authenticated user data, code 200

### Step 5.4 — API Complaint Controller
**File:** `app/Http/Controllers/Api/ComplaintController.php`
- `index()` — Paginated complaints for authenticated user
- `store(Request)` — Create complaint with optional image (multipart/form-data), code 201
- `show(Complaint)` — Detail complaint with category + responses_count
- `update(Request, Complaint)` — Update (policy: own + pending)
- `destroy(Complaint)` — Delete (policy: own + pending)
- `adminIndex(Request)` — Admin: all complaints with filters (status, search, category_id), paginated
- `updateStatus(Request, Complaint)` — Admin: update status only

### Step 5.5 — API Category Controller
**File:** `app/Http/Controllers/Api/CategoryController.php`
- `index()` — Public: list all categories (no auth required)
- `store(Request)` — Admin: create category
- `update(Request, ComplaintCategory)` — Admin: update category
- `destroy(ComplaintCategory)` — Admin: delete category

### Step 5.6 — API Response Controller
**File:** `app/Http/Controllers/Api/ResponseController.php`
- `index(Complaint)` — List responses for a complaint
- `store(Request, Complaint)` — Admin: create response

### Step 5.7 — API Routes
In `routes/api.php`:
```php
Route::middleware('throttle:60,1')->group(function () {
    // Public auth
    Route::post('/auth/register', [Api\AuthController::class, 'register']);
    Route::post('/auth/login', [Api\AuthController::class, 'login']);

    // Public read-only
    Route::get('/categories', [Api\CategoryController::class, 'index']);

    // Authenticated
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [Api\AuthController::class, 'logout']);
        Route::get('/auth/me', [Api\AuthController::class, 'me']);

        Route::apiResource('complaints', Api\ComplaintController::class);
        Route::get('/complaints/{complaint}/responses', [Api\ResponseController::class, 'index']);

        // Admin only
        Route::middleware('role:admin')->group(function () {
            Route::get('/admin/complaints', [Api\ComplaintController::class, 'adminIndex']);
            Route::patch('/admin/complaints/{complaint}/status', [Api\ComplaintController::class, 'updateStatus']);
            Route::post('/categories', [Api\CategoryController::class, 'store']);
            Route::put('/categories/{category}', [Api\CategoryController::class, 'update']);
            Route::delete('/categories/{category}', [Api\CategoryController::class, 'destroy']);
            Route::post('/complaints/{complaint}/responses', [Api\ResponseController::class, 'store']);
        });
    });
});
```

### Step 5.8 — API Testing with HTTP Client
After implementation, test each endpoint:
- 200 for successful GET
- 201 for successful POST
- 401 for unauthenticated access
- 403 for unauthorized role
- 422 for validation errors
- 429 for rate limit exceeded

### Step 5.9 — Commit & Push

**Deliverables:** Full REST API with Sanctum token auth, all endpoints functional, rate limiting active.

---

## Phase 6: UI Polish & Responsive Design

### Step 6.1 — Tailwind Configuration
Verify `tailwind.config.js`:
- Content paths include all `resources/views/**/*.blade.php`
- Extend with custom colors for status if needed
- `@tailwindcss/forms` plugin registered

### Step 6.2 — Responsive Layout Review
- User navbar: hamburger menu on mobile (`lg:hidden`, `x-data="{ open: false }"`)
- Admin sidebar: collapses on mobile, overlay on small screens
- All tables: `overflow-x-auto` wrapper for horizontal scroll on mobile
- Cards: 1-col mobile, 2-col tablet, 4-col desktop grid
- Forms: full-width on mobile, constrained width on desktop

### Step 6.3 — Status Badge Component
Create Blade component or inline pattern:
```
pending  -> bg-yellow-100 text-yellow-800 border border-yellow-200
diproses -> bg-blue-100 text-blue-800 border border-blue-200
selesai  -> bg-green-100 text-green-800 border border-green-200
```
Rounded-full, px-3 py-1, text-sm font-medium.

### Step 6.4 — Flash Messages
In layouts, check for:
- `session('success')` -> green alert with check icon
- `session('error')` -> red alert with x icon
Auto-dismiss with Alpine.js after 5 seconds.

### Step 6.5 — Breadcrumbs
Admin layout includes breadcrumb:
```
Home > Aduan > Detail Aduan
```
Use Tailwind text-sm breadcrumb styling with separators.

### Step 6.6 — Empty States
- "Belum ada aduan" with illustration icon on empty complaint list
- "Belum ada tanggapan" on empty response timeline
- "Tidak ada kategori" on empty category list

### Step 6.7 — Loading States
- Skeleton loading or spinner for page transitions
- Alpine.js `x-show` for dynamic content

### Step 6.8 — Alpine.js Interactions
- Mobile nav toggle: `x-data="{ open: false }"` + `x-on:click`
- Image preview on upload: `x-data` + `x-on:change` + `URL.createObjectURL`
- Status filter dropdown toggle
- Confirm delete modal/dialog: `x-data="{ show: false }"` + `x-on:click`

### Step 6.9 — Commit & Push

**Deliverables:** Fully responsive UI, polished visuals, consistent design system across all pages.

---

## Phase 7: Testing

### Step 7.1 — Test Environment Setup
- Configure `.env.testing` with separate test database
- Run migrations: `php artisan migrate --env=testing`
- Run seeders: `php artisan db:seed --env=testing`

### Step 7.2 — Unit Tests (Models)
**File:** `tests/Unit/UserTest.php`
- Test `isAdmin()` returns true/false correctly
- Test `complaints()` relationship
- Test password hashing

**File:** `tests/Unit/ComplaintTest.php`
- Test `isPending()` helper
- Test `getStatusBadgeAttribute()` returns correct CSS classes
- Test relationships

### Step 7.3 — Feature Test: Authentication
**File:** `tests/Feature/AuthTest.php`
- User can register with valid data -> 302 redirect
- User cannot register with duplicate email -> 422
- User can login with correct credentials -> redirect to /user/dashboard
- User cannot login with wrong password -> 422
- Admin can login -> redirect to /admin/dashboard
- Authenticated user can logout -> redirect to /

### Step 7.4 — Feature Test: User Complaints
**File:** `tests/Feature/ComplaintTest.php`
- Authenticated user can create complaint -> 302, complaint exists in DB
- User can view own complaints list -> 200
- User can view own complaint detail -> 200
- User can edit own pending complaint -> 200 (GET) + 302 (PUT)
- User can delete own pending complaint -> 302
- User CANNOT edit complaint with status 'diproses' -> 403
- User CANNOT delete complaint with status 'diproses' -> 403
- User CANNOT view other user's complaint detail -> 403
- User CANNOT edit other user's complaint -> 403
- Complaint creation fails with invalid data -> 422

### Step 7.5 — Feature Test: Admin Complaints
**File:** `tests/Feature/AdminTest.php`
- Admin can view all complaints list -> 200
- Admin can view any complaint detail -> 200
- Admin can update complaint status -> 302
- Admin can filter complaints by status -> 200
- Admin can search complaints by title -> 200
- Admin can create response on complaint -> 302

### Step 7.6 — Feature Test: Categories
**File:** `tests/Feature/CategoryTest.php`
- Admin can create category -> 302, category exists
- Admin can update category -> 302
- Admin cannot create duplicate category name -> 422
- User CANNOT access category management -> 403

### Step 7.7 — Negative Authorization Tests
**File:** `tests/Feature/AuthorizationTest.php`
- NEG-01: User accessing /admin/dashboard -> 403
- NEG-02: User accessing /admin/complaints -> 403
- NEG-03: User editing another user's complaint -> 403
- NEG-04: User deleting non-pending complaint -> 403
- NEG-05: User updating complaint status -> 403
- NEG-06: Guest accessing /user/dashboard -> redirect to /login
- NEG-07: API request with invalid token -> 401
- NEG-08: Admin accessing /user/complaints/create -> 403

### Step 7.8 — Run All Tests
```bash
php artisan test --env=testing
```
Target: all tests pass with green.

### Step 7.9 — Commit & Push

**Deliverables:** All tests passing, authorization enforced, edge cases covered.

---

## Phase 8: Finalization

### Step 8.1 — Cache Implementation
Per documentation section 7.6:
- Cache categories with `Cache::rememberForever('complaint_categories', ...)`
- Cache admin dashboard stats with `Cache::remember('admin_stats', 300, ...)`
- Invalidate cache in CategoryController (store/update/destroy): `Cache::forget('complaint_categories')`
- Invalidate cache in ComplaintController (updateStatus): `Cache::forget('admin_stats')`

### Step 8.2 — Storage Link
```bash
php artisan storage:link
```
Verify: `public/storage` symlink exists and points to `storage/app/public`.

### Step 8.3 — Final Environment Check
- Confirm `.env` values are correct
- Confirm migrations are up to date
- Confirm seeders ran successfully
- Test admin login: admin@lapor.in / admin123
- Test user registration and login flow

### Step 8.4 — Code Cleanup
- Remove unused imports
- Remove debug statements (dd, dump, var_dump)
- Remove commented-out code
- Consistent indentation (4 spaces)

### Step 8.5 — Build Frontend Assets
```bash
npm run build
```
This compiles and minifies Tailwind CSS and JS for production.

### Step 8.6 — Final Commit & Push

**Deliverables:** Production-ready application with caching, optimized assets, clean codebase.

---

## Directory Structure (Target)

```
laporin/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── AuthController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ComplaintController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   └── ResponseController.php
│   │   │   ├── User/
│   │   │   │   ├── DashboardController.php
│   │   │   │   └── ComplaintController.php
│   │   │   ├── PageController.php
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       ├── ComplaintController.php
│   │   │       ├── CategoryController.php
│   │   │       └── ResponseController.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/
│   │       ├── StoreComplaintRequest.php
│   │       ├── UpdateComplaintRequest.php
│   │       ├── StoreCategoryRequest.php
│   │       └── StoreResponseRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Complaint.php
│   │   ├── ComplaintCategory.php
│   │   └── Response.php
│   ├── Policies/
│   │   └── ComplaintPolicy.php
│   └── Providers/
│       └── AuthServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── xxxx_add_role_to_users_table.php
│   │   ├── xxxx_create_complaint_categories_table.php
│   │   ├── xxxx_create_complaints_table.php
│   │   └── xxxx_create_responses_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminSeeder.php
│       └── CategorySeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── admin.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── user/
│       │   ├── dashboard.blade.php
│       │   └── complaints/
│       │       ├── index.blade.php
│       │       ├── create.blade.php
│       │       ├── edit.blade.php
│       │       └── show.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── complaints/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   └── categories/
│       │       ├── index.blade.php
│       │       ├── create.blade.php
│       │       └── edit.blade.php
│       ├── pages/
│       │   └── about.blade.php
│       └── errors/
│           ├── 403.blade.php
│           ├── 404.blade.php
│           └── 500.blade.php
├── routes/
│   ├── web.php
│   └── api.php
└── tests/
    ├── Unit/
    │   ├── UserTest.php
    │   └── ComplaintTest.php
    └── Feature/
        ├── AuthTest.php
        ├── ComplaintTest.php
        ├── CategoryTest.php
        ├── AdminTest.php
        └── AuthorizationTest.php
```

---

## Summary: Execution Order

```
Phase 0  ──►  Pre-check (verify tools installed)
Phase 1  ──►  Foundation (Laravel + DB + Auth + Models + Seeders)  [COMMIT #1]
Phase 2  ──►  User Features (Dashboard + CRUD + Image + About)     [COMMIT #2]
Phase 3  ──►  Admin Panel (Dashboard + Complaints + Categories + Responses) [COMMIT #3]
Phase 4  ──►  Auth & Gates (Middleware + Policies + Error Pages)   [COMMIT #4]
Phase 5  ──►  REST API (Sanctum + All Endpoints + Rate Limiting)   [COMMIT #5]
Phase 6  ──►  UI Polish (Responsive + Badges + States + Alpine.js) [COMMIT #6]
Phase 7  ──►  Testing (Unit + Feature + Negative Authorization)    [COMMIT #7]
Phase 8  ──►  Finalize (Cache + Storage Link + Build + Cleanup)    [COMMIT #8]
```

**Total target commits: 8 minimum** (plus incremental commits for sub-features).

---

> **Plan version: 1.0.0 | Created from LaporIn_Documentation.md v1.0.0**
> This plan follows the Waterfall SDLC methodology defined in the project documentation.
