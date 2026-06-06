# Branch CRUD Testing Guide

## Test Cases

### 1. CREATE New Branch
**Steps:**
1. Click "Add New Branch" button
2. Modal appears with title "Add Branch Details"
3. Fill in form:
   - Branch Name: "Downtown Branch"
   - Phone: "+8801234567890"
   - Location: "123 Main Street"
   - Optional delivery service URLs and logos
4. Click "Save Branch"
5. Should see success toast: "Branch created successfully!"
6. Modal closes
7. DataTable reloads and shows new branch

**Expected Result:** ✓ New branch appears in table

---

### 2. READ/VIEW Branch Details
**Steps:**
1. Click eye icon on any branch row
2. "Branch Details" modal opens
3. Shows all branch information
4. Shows delivery services if configured
5. Has "Edit Branch" button

**Expected Result:** ✓ All details display correctly

---

### 3. UPDATE Existing Branch
**Steps:**
1. Click edit icon on any branch
2. Modal appears with title "Edit Branch Details"
3. Form is pre-filled with current data
4. Modify any field (e.g., phone number)
5. Click "Save Branch"
6. Should see success toast: "Branch updated successfully!"
7. Modal closes
8. DataTable reloads and shows updated data

**Expected Result:** ✓ Branch updated, data appears in table

---

### 4. DELETE Branch
**Steps:**
1. Click delete icon on any branch
2. Confirmation dialog appears
3. Click "Yes, Delete"
4. Should see success toast: "Branch deleted successfully!"
5. DataTable reloads without deleted branch

**Expected Result:** ✓ Branch removed from table

---

### 5. COPY LINK to Clipboard
**Steps:**
1. Click links icon on any branch
2. Should see success toast: "Link copied to clipboard!"
3. Link format: `http://site.com/branches/{slug}`

**Expected Result:** ✓ Link copied successfully

---

## Key Fixes Applied

### Backend (PHP/Laravel)
1. ✓ Fixed typo in `BranchController::update()` - `pathao_path` → `pathao_url`
2. ✓ Proper validation error handling
3. ✓ File upload handling with proper null checks
4. ✓ DataTable reload with 300ms delay for race condition prevention

### Frontend (JavaScript)
1. ✓ Simplified URL building - no complex route helper usage
2. ✓ Clean currentEditId tracking
3. ✓ Dynamic modal title switching
4. ✓ Proper form reset on modal close
5. ✓ Comprehensive error handling with field-level validation display

### Routes
1. ✓ POST `/admin/branch` → store (create)
2. ✓ POST `/admin/branch/{id}` → update
3. ✓ GET `/admin/branch/{id}/edit` → edit (get data)
4. ✓ DELETE `/admin/branch/{id}` → destroy

---

## Common Issues Fixed

### Issue: "Branch not found (ID: store)"
**Cause:** Form data-edit-id was being set to invalid values
**Solution:** Use `currentEditId` variable directly, reset it to null when form is cleared

### Issue: Image not uploading on update
**Cause:** File handler wasn't preserving existing images when no new file uploaded
**Solution:** Added proper `isset()` and `.isValid()` checks

### Issue: DataTable not refreshing after CRUD
**Cause:** Race condition between modal close and table reload
**Solution:** Added 300ms setTimeout before table.ajax.reload()

### Issue: Validation errors not showing
**Cause:** Error messages weren't being displayed in form
**Solution:** Added error-text spans for each field, populated via JavaScript

---

## Database Schema

```sql
CREATE TABLE branches (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  slug VARCHAR(255) UNIQUE,
  phone VARCHAR(20) NOT NULL,
  location TEXT NOT NULL,
  foodpanda_url TEXT NULLABLE,
  foodpanda_logo TEXT NULLABLE,
  pathao_url TEXT NULLABLE,
  pathao_logo TEXT NULLABLE,
  foodi_url TEXT NULLABLE,
  foodi_logo TEXT NULLABLE,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

---

## Response Format

All endpoints return JSON:

```json
{
  "status": "success|error",
  "message": "Description of result",
  "data": {},
  "errors": {} // Only on validation error
}
```

---

## Testing Notes

- All CRUD operations use DataTables with server-side processing
- Form submission uses AJAX with FormData for file uploads
- Validation happens server-side first
- Comprehensive logging in Laravel for debugging
- Check `storage/logs/laravel.log` for detailed request logs
