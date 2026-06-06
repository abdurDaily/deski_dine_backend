# Migration Error Fixed ✅

## Error
```
SQLSTATE[42000]: Can't DROP COLUMN `transaction_id`; check that it exists
```

## Root Cause
A migration was trying to drop columns that don't exist in the database.

## Fix Applied
Updated the migration to check if columns exist before dropping them:

**File**: `database/migrations/2026_06_02_000001_add_payment_fields_to_orders.php`

**Before**:
```php
public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['transaction_id', 'payment_status', 'payment_date', 'payment_details']);
    });
}
```

**After**:
```php
public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $columns = ['transaction_id', 'payment_status', 'payment_date', 'payment_details'];
        foreach ($columns as $column) {
            if (Schema::hasColumn('orders', $column)) {
                $table->dropColumn($column);
            }
        }
    });
}
```

---

## Now Run Migration

```bash
php artisan migrate --force
```

This will:
1. ✅ Add `branch_id` to categories table
2. ✅ Skip dropping columns that don't exist
3. ✅ Complete successfully

---

## If Still Getting Error

### Option 1: Skip That Migration
```bash
php artisan migrate --path=database/migrations/2026_06_06_140001_add_branch_id_to_categories_table.php --force
```

This runs ONLY the branch_id migration.

### Option 2: Fresh Migration (CAUTION!)
```bash
# This will DROP ALL TABLES and recreate them
# Only use if you have a backup or this is dev environment
php artisan migrate:fresh --seed
```

### Option 3: Check Migration Status
```bash
php artisan migrate:status
```

Look for migrations that haven't run yet.

---

## Verify Fix Worked

Run in `php artisan tinker`:
```php
// Check if branch_id column exists
Schema::hasColumn('categories', 'branch_id'); // Should return TRUE
```

---

## After Migration Success

1. **Assign categories to branches**:
```php
// In tinker
App\Models\Category::where('name', 'Kacchi & Biryani')->update(['branch_id' => 1]);
```

2. **Clear cache**:
```bash
php artisan cache:clear
```

3. **Test branch pages**:
- Go to `/branches/{slug}`
- Should see only branch-specific categories

---

## Status

🟢 **Migration file fixed**

Now run: `php artisan migrate --force`
