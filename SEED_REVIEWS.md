# Add Test Reviews to Dashboard

## Option 1: Run Full Seed (Recommended)

This will recreate all database tables and seed them with test data:

```bash
php artisan migrate:fresh --seed
```

This will:
- ✅ Drop all tables
- ✅ Run all migrations
- ✅ Create test reviews
- ✅ Populate dashboard

Then visit: `http://127.0.0.1:8000/admin/reviews`

---

## Option 2: Seed Only Reviews

If you want to keep existing data and just add reviews:

```bash
php artisan db:seed --class=ReviewSeeder
```

This will:
- ✅ Keep all existing data
- ✅ Add 3 test reviews
- ✅ No tables dropped

Then visit: `http://127.0.0.1:8000/admin/reviews`

---

## Option 3: Manual Insert (If neither option works)

If you have access to your database client, run these SQL queries:

```sql
-- Find a member first
SELECT id, name, email, profile_image_path FROM members LIMIT 1;

-- Copy the ID from above and use it in the INSERT statements below
-- Replace MEMBER_ID with the actual ID

INSERT INTO reviews (member_id, name, email, rating, title, comment, image, status, approved_at, approved_by, created_at, updated_at)
VALUES 
(MEMBER_ID, 'Test User 1', 'test1@example.com', 5, 'Excellent Service!', 'The food quality is outstanding and the service is impeccable.', 'path/to/image.jpg', 'approved', NOW(), 1, NOW(), NOW()),
(MEMBER_ID, 'Test User 2', NULL, 4, 'Great Experience', 'Loved the ambiance and food variety. Will definitely come back again.', 'path/to/image.jpg', 'pending', NULL, NULL, NOW(), NOW()),
(MEMBER_ID, 'Test User 3', 'test3@example.com', 5, 'Amazing!', 'Best dining experience I have had. The traditional recipes are authentic and delicious.', 'path/to/image.jpg', 'approved', NOW(), 1, NOW(), NOW());
```

Then visit: `http://127.0.0.1:8000/admin/reviews`

---

## What Test Reviews Are Created

| # | Name | Email | Rating | Status | Comments |
|---|------|-------|--------|--------|----------|
| 1 | Test User 1 | test1@example.com | 5 stars | Approved | Tests normal email |
| 2 | Test User 2 | NULL | 4 stars | Pending | Tests NULL email handling |
| 3 | Test User 3 | test3@example.com | 5 stars | Approved | Tests another review |

---

## After Seeding

### Dashboard will show:
- ✅ Stats: 3 Total, 1 Pending, 2 Approved, 0 Rejected
- ✅ DataTable with 3 rows
- ✅ All icons and buttons working
- ✅ Search functionality
- ✅ Pagination
- ✅ Action buttons: View, Approve, Reject, Delete

### Test Features:
- Click "View" to see review modal
- Click "Approve" on pending review
- Click "Reject" to reject a review
- Click "Delete" to remove a review
- Type in search to filter reviews
- Check NULL email handling (Test User 2)

---

## Troubleshooting

### If `migrate:fresh --seed` fails:

```bash
# Clear migrations first
php artisan migrate:reset

# Then migrate fresh
php artisan migrate --seed
```

### If ReviewSeeder not found:

Make sure the file exists:
```
database/seeders/ReviewSeeder.php
```

And it's included in `database/seeders/DatabaseSeeder.php`.

### If no members exist:

Run member seeder first:
```bash
php artisan db:seed --class=MemberSeeder
```

Or manually create a member in the database.

---

## Quick Test Checklist

After seeding, verify:

- [ ] Dashboard loads: `/admin/reviews`
- [ ] Stats show: 3 total reviews
- [ ] DataTable displays 3 rows
- [ ] Search works
- [ ] Pagination works
- [ ] View button opens modal
- [ ] Approve/Reject/Delete buttons work
- [ ] NULL email (Test User 2) displays as "-"
- [ ] Icons show correctly

---

## Next Steps

Once dashboard shows data:
1. Test the frontend `/contact` page
2. Try submitting a real review
3. Verify it appears in dashboard as "pending"
4. Test approve/reject workflow

