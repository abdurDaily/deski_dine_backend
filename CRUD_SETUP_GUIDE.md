# CRUD Implementation Guide: Frontend Content Management

## Overview
Four new CRUD sections have been fully implemented for managing frontend content:
1. **Signature Platters** - Dynamic platter management with images and features
2. **Facebook Reels / Videos** - Social media reels management  
3. **About Section** - Editable about page content and images
4. **Contact Section** - Location, hours, contact info, and social media links

---

## 1. DATABASE MIGRATIONS

### Created Migrations:
- `database/migrations/2026_06_05_200001_create_signature_platters_table.php`
- `database/migrations/2026_06_05_200002_create_facebook_reels_table.php`

### About & Contact:
Uses existing `settings` table with `setting_group` organization.

### To Run Migrations:
```bash
php artisan migrate
```

---

## 2. MODELS

### New Models Created:
- `app/Models/SignaturePlatter.php`
- `app/Models/FacebookReel.php`

### Setting Model (Existing):
- `app/Models/Setting.php` - Already exists and is used for About & Contact

---

## 3. CONTROLLERS

### Backend Controllers Created:

#### **SignaturePlatterController**
- Location: `app/Http/Controllers/Backend/SignaturePlatterController.php`
- Methods: `index()`, `store()`, `edit()`, `update()`, `destroy()`
- Features:
  - DataTables integration with AJAX
  - Multiple image formats: webp, png, jpg
  - JSON features array storage
  - Dynamic sort order

#### **FacebookReelController**
- Location: `app/Http/Controllers/Backend/FacebookReelController.php`
- Methods: `index()`, `store()`, `edit()`, `update()`, `destroy()`
- Features:
  - Facebook URL management
  - Thumbnail image uploads (portrait orientation recommended)
  - Sort order management

#### **AboutController**
- Location: `app/Http/Controllers/Backend/AboutController.php`
- Methods: `index()`, `store()`
- Features:
  - Settings-based content management
  - About image upload
  - Customizable features with icons

#### **ContactController**
- Location: `app/Http/Controllers/Backend/ContactController.php`
- Methods: `index()`, `store()`
- Features:
  - Google Maps embed support
  - Social media link management
  - Business hours and contact info

---

## 4. ROUTES

### Admin Routes Added to `routes/admin.php`:

```php
// Signature Platters
Route::prefix("signature-platters")->name("signature-platters.")->group(function () {
    Route::get("/index", [SignaturePlatterController::class, "index"])->name("index");
    Route::post("/store", [SignaturePlatterController::class, "store"])->name("store");
    Route::get("/{signaturePlatter}/edit", [SignaturePlatterController::class, "edit"])->name("edit");
    Route::post("/{signaturePlatter}/update", [SignaturePlatterController::class, "update"])->name("update");
    Route::delete("/{signaturePlatter}/delete", [SignaturePlatterController::class, "destroy"])->name("delete");
});

// Facebook Reels
Route::prefix("facebook-reels")->name("facebook-reels.")->group(function () {
    Route::get("/index", [FacebookReelController::class, "index"])->name("index");
    Route::post("/store", [FacebookReelController::class, "store"])->name("store");
    Route::get("/{facebookReel}/edit", [FacebookReelController::class, "edit"])->name("edit");
    Route::post("/{facebookReel}/update", [FacebookReelController::class, "update"])->name("update");
    Route::delete("/{facebookReel}/delete", [FacebookReelController::class, "destroy"])->name("delete");
});

// About Section
Route::prefix("about")->name("about.")->group(function () {
    Route::get("/index", [AboutController::class, "index"])->name("index");
    Route::post("/store", [AboutController::class, "store"])->name("store");
});

// Contact Section
Route::prefix("contact")->name("contact.")->group(function () {
    Route::get("/index", [ContactController::class, "index"])->name("index");
    Route::post("/store", [ContactController::class, "store"])->name("store");
});
```

### Route Names for Sidebar Navigation:
- `admin.signature-platters.index`
- `admin.facebook-reels.index`
- `admin.about.index`
- `admin.contact.index`

---

## 5. BACKEND VIEWS

### Admin CRUD Views Created:

#### Signature Platters Management
- **File**: `resources/views/backend/signature-platters/index.blade.php`
- **Features**:
  - Left column: Create/Edit form with features builder
  - Right column: DataTables with sorting and status
  - Dynamic feature rows (add/remove)
  - Image preview in edit modal

#### Facebook Reels Management
- **File**: `resources/views/backend/facebook-reels/index.blade.php`
- **Features**:
  - Left column: Create/Edit form
  - Right column: DataTables with thumbnail preview
  - Direct Facebook link preview
  - Sort order management

#### About Section Management
- **File**: `resources/views/backend/about/index.blade.php`
- **Features**:
  - Full form for all about fields
  - Icon class input for features
  - Experience badge settings
  - CTA button URL configuration
  - Current image preview

#### Contact Section Management
- **File**: `resources/views/backend/contact/index.blade.php`
- **Features**:
  - Business info form
  - Google Maps embed iframe URL input
  - Social media link management
  - Opening hours, phone, email, address

---

## 6. FRONTEND INTEGRATION

### Updated Files:

#### `app/Http/Controllers/Frontend/HomeController.php`
- Added imports for SignaturePlatter, FacebookReel, Setting models
- Data being passed to frontend view:
  - `$signaturePlatters` - sorted by sort_order
  - `$facebookReels` - sorted by sort_order
  - `$aboutSettings` - keyBy('key') for easy access
  - `$contactSettings` - keyBy('key') for easy access

#### `resources/views/index.blade.php`
- **Signature Platters Section**: 
  - Dynamic platter slider with image thumbnails
  - Feature list rendering from JSON
  - Placeholder when no platters available

- **Facebook Reels Section**:
  - Dynamic reel slider with thumbnails
  - Facebook URL links for each reel
  - "Follow on Facebook" button using contact settings

- **About Section**:
  - Dynamic title, kicker, lead, paragraph
  - Feature icons and text from settings
  - Experience badge with dynamic number/text
  - CTA button with configurable URL
  - Dynamic about image

- **Contact Section**:
  - Dynamic business name, address, hours
  - Google Maps embed with dynamic iframe
  - Social media links
  - Get Directions button

---

## 7. SIDEBAR NAVIGATION

### New Component Created:
**File**: `resources/views/components/frontend-content-nav.blade.php`

This component is automatically included in `resources/views/components/main-menu.blade.php` and displays a collapsible menu with:
- Signature Platters
- Facebook Reels  
- About Section
- Contact / Location

---

## 8. UPLOAD DIRECTORIES

The following directories have been created in `public/uploads/`:
- `public/uploads/platters/` - For signature platter images
- `public/uploads/reels/` - For Facebook reel thumbnails
- `public/uploads/about/` - For about section image

---

## 9. SETTINGS TABLE KEYS

### About Section Settings:
- `about_kicker` - Small header text
- `about_title` - Main section title
- `about_lead` - Bold intro paragraph
- `about_paragraph` - Main body paragraph
- `about_feature_1_icon` - Icon class for feature 1
- `about_feature_1_text` - Text for feature 1
- `about_feature_2_icon` - Icon class for feature 2
- `about_feature_2_text` - Text for feature 2
- `about_exp_number` - Experience badge number (e.g., "10+")
- `about_exp_text` - Experience badge text
- `about_cta_url` - Call-to-action button URL
- `about_image` - Image filename (stored in `uploads/about/`)

### Contact Section Settings:
- `contact_section_title` - "Visit Us" or custom
- `contact_section_subtitle` - Subtitle text
- `contact_restaurant_name` - Business name
- `contact_address` - Full address
- `contact_hours` - Opening hours
- `contact_phone` - Reservation phone
- `contact_email` - Email address
- `contact_map_embed` - Google Maps iframe src URL
- `contact_map_link` - Get Directions link
- `contact_facebook_url` - Facebook page URL
- `contact_instagram_url` - Instagram page URL

---

## 10. DATABASE SCHEMA

### Signature Platters Table:
```sql
CREATE TABLE signature_platters (
    id BIGINT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    features JSON,
    status BOOLEAN DEFAULT 1,
    sort_order INT DEFAULT 0,
    timestamps
);
```

### Facebook Reels Table:
```sql
CREATE TABLE facebook_reels (
    id BIGINT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    facebook_url VARCHAR(500) NOT NULL,
    thumbnail VARCHAR(255),
    status BOOLEAN DEFAULT 1,
    sort_order INT DEFAULT 0,
    timestamps
);
```

---

## 11. IMAGE FORMATS SUPPORTED

- **Signature Platters**: webp, png, jpg, jpeg (max 2MB)
- **Facebook Reels**: webp, png, jpg, jpeg (max 2MB)
- **About Image**: webp, png, jpg, jpeg (max 3MB)

All images are processed with Intervention Image library to preserve format.

---

## 12. QUICK START

### Step 1: Run Migrations
```bash
php artisan migrate
```

### Step 2: Access Admin Panels
After login, navigate to the new "Frontend Content" menu:

- **Signature Platters**: `/admin/signature-platters/index`
- **Facebook Reels**: `/admin/facebook-reels/index`
- **About**: `/admin/about/index`
- **Contact**: `/admin/contact/index`

### Step 3: Add Content
1. Go to each section
2. Fill in the form
3. Upload images (if applicable)
4. Save

### Step 4: Frontend Display
Content automatically appears on the homepage:
- Signature Platters section
- Facebook Reels section
- About section
- Contact/Location section

---

## 13. CACHING

The following data is cached for 5-30 minutes:
- About settings (5 minutes)
- Contact settings (5 minutes)
- Signature Platters (5 minutes)
- Facebook Reels (5 minutes)

To clear cache:
```bash
php artisan cache:clear
```

---

## 14. PERMISSIONS

To add role-based access control, add these permissions to your Spatie Permission system:

```php
// In your seeder or via admin panel
'signature-platters-manage' => 'Manage Signature Platters'
'facebook-reels-manage' => 'Manage Facebook Reels'
'about-manage' => 'Manage About Section'
'contact-manage' => 'Manage Contact Section'
```

Then protect routes in `routes/admin.php` with:
```php
->middleware('permission:signature-platters-manage')
```

---

## 15. TROUBLESHOOTING

### Images not uploading?
- Check directory permissions: `chmod 755 public/uploads/platters`
- Ensure `public_path()` is writable

### Settings not saving?
- Verify `settings` table exists: `php artisan migrate`
- Check Laravel logs: `storage/logs/`

### Slider not working on frontend?
- Ensure JavaScript libraries are loaded (Slick slider)
- Check browser console for JS errors

### Cache issues?
- Clear application cache: `php artisan cache:clear`
- Clear configuration: `php artisan config:clear`

---

## 16. FEATURES SUMMARY

✅ **Signature Platters**
- Create, Read, Update, Delete
- Multiple images formats
- Dynamic features array
- Sort order management
- Frontend slider with fallback

✅ **Facebook Reels**
- Create, Read, Update, Delete
- Thumbnail image management
- Facebook URL tracking
- Sort order management
- Frontend carousel

✅ **About Section**
- Dynamic text content
- Feature icons
- Image upload
- Experience badge
- CTA button configuration

✅ **Contact Section**
- Address and hours
- Google Maps embed
- Social media links
- Phone and email
- Directions link

---

## 17. NOTES FOR DEVELOPERS

### Model Relationships:
- No foreign key relationships (standalone tables)
- Settings use key-value pattern

### Image Handling:
- Images stored in `public/uploads/`
- Old images automatically deleted on update
- Placeholder shown if image missing

### AJAX Forms:
- All admin forms use AJAX with FormData
- DataTables for list views
- Modal for edit dialogs
- SweetAlert2 for confirmations

### Frontend Data Access:
```blade
<!-- In index.blade.php -->
@forelse($signaturePlatters as $platter)
    <div>{{ $platter->title }}</div>
@endforelse

@php
    $title = optional($aboutSettings->get('about_title'))->value ?? 'Default';
@endphp
```

---

**Implementation Date**: June 5, 2026  
**Status**: ✅ Complete
