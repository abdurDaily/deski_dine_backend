# Cache Clear Instructions

## Problem Solved ✅

The issue was that the `home_branches` cache was missing the `slug` field. This has been fixed in:
- `app/Http/Controllers/Frontend/HomeController.php`

## Solution: Clear Cache

Run these commands in your terminal:

### Quick Clear (Recommended)
```bash
php artisan cache:clear
```

### Full Clear
```bash
php artisan cache:clear
php artisan route:cache
php artisan view:cache
php artisan config:cache
```

### Nuclear Option (clears everything)
```bash
php artisan optimize:clear
```

## What Was Fixed

Changed this line in `HomeController.php`:
```php
// Before (missing slug and delivery fields):
->select(['id', 'name', 'location', 'phone'])

// After (includes slug and all delivery fields):
->select(['id', 'name', 'location', 'phone', 'slug', 'foodpanda_url', 'pathao_url', 'foodi_url', 'foodpanda_logo', 'pathao_logo', 'foodi_logo'])
```

## Verify Fix

After clearing cache, test:
1. Go to home page `/`
2. Scroll to "Our Branches" section
3. Click on a branch - should navigate without error
4. Check `/branches` page
5. Click on branch card - should work

## If Still Getting Error

1. Make sure the migration was run:
   ```bash
   php artisan migrate --force
   ```

2. Check that branches table has slug column:
   ```bash
   php artisan tinker
   # Type: Schema::getColumnListing('branches')
   ```

3. Make sure at least one branch exists in database:
   ```bash
   php artisan tinker
   # Type: App\Models\Branch::count()
   ```

4. If branches exist but missing slug, regenerate:
   ```bash
   php artisan tinker
   # Type: 
   App\Models\Branch::all()->each(function($b) { 
       $b->update(['slug' => Illuminate\Support\Str::slug($b->name)]); 
   });
   ```

## Status
✅ Fix applied to code
✅ Documentation updated
✅ Ready for deployment

Just run `php artisan cache:clear` and refresh your browser!
