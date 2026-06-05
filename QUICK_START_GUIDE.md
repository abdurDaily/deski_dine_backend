# Quick Start Guide: Menu-Specific Offers

## 🚀 How to Create an Offer

### Step 1: Navigate to Offers
1. Login to admin dashboard
2. Go to **Offers** menu in sidebar
3. Click **"Create Offer"** button

### Step 2: Fill Basic Information
```
✓ Offer Name: "Weekend Special"
✓ Discount %: 50
✓ Description: "Get 50% off on selected items this weekend"
```

### Step 3: Choose Offer Type
**Option A: All Items**
- Select "All Food Items" from dropdown
- Offer applies to everything in the menu
- Skip menu selection

**Option B: Specific Items** ⭐ NEW
- Select "Specific Food Items" from dropdown
- Menu selection box appears
- Hold **Ctrl** (Windows) or **Cmd** (Mac) and click items
- Select multiple items (e.g., "Kacchi Biriyani - 1:2", "Beef Tehari - 1:3")

### Step 4: Set Conditions (Optional)
```
✓ Applicable To: All / Membership / Student / Golden
✓ Min Order Total: 200 (leave blank for no minimum)
✓ First Order Only: ☐ (check if yes)
```

### Step 5: Popup Ad Settings (Optional)
```
✓ Show as popup: ☑ (check to display on homepage)
✓ Upload popup image (WebP, PNG, JPG - max 2MB)
✓ Popup badge: "FLASH SALE"
✓ Expires on: 2026-12-31
```

### Step 6: Validity Period (Optional)
```
✓ Valid From: 2026-06-01 (when offer starts)
✓ Valid Until: 2026-06-30 (when offer ends)
```

### Step 7: Activate & Save
```
✓ Active: ☑ (check to enable offer)
✓ Click "Create Offer" button
```

---

## 🎯 Where Offers Appear

### 1. Home Page Menu Slider
- Red pulsing badge: "🏷️ 50% OFF"
- Original price strikethrough
- Discounted price in red

### 2. Complete Menu Page
- Same badge on grid items
- Filters work normally
- Price comparison visible

### 3. Checkout Page
- Order summary shows:
  - Subtotal
  - Membership Discount
  - **🎉 Offer Discount** ← NEW (with offer name + badge)
  - Total

---

## 💡 Examples

### Example 1: Weekend Kacchi Sale
```
Name: "Weekend Kacchi Special"
Type: Specific Items
Items: 
  - Kacchi Biriyani - 1:2 (৳450)
  - Kacchi Biriyani - 1:3 (৳650)
Discount: 30%
Min Order: ৳200
Valid: Friday-Sunday
```
**Result:** Only Kacchi items get 30% off on weekends

---

### Example 2: Student Discount
```
Name: "Student Offer"
Type: All Items
Applicable To: Student
Discount: 25%
First Order: ☑
```
**Result:** Students get 25% off on first order only

---

### Example 3: Flash Sale
```
Name: "Flash Sale - 50% OFF"
Type: Specific Items
Items: Select 5-10 slow-moving items
Discount: 50%
Show as Popup: ☑
Popup Badge: "FLASH SALE"
Valid Until: Today at midnight
```
**Result:** Homepage popup + badge on selected items

---

## 🔍 How Discounts Are Applied

### Priority Logic
```
1. System calculates MEMBERSHIP discount
   - Golden Card: 10% always
   - First Order: 30% (regular) or 35% (student)
   - Otherwise: 0%

2. System calculates OFFER discount
   - For each cart item:
     - Find best applicable offer
     - Calculate item discount
   - Sum all item discounts

3. Apply MAXIMUM of the two
   - Show both in checkout
   - Gray out the one not used
   - Customer always gets best deal
```

### Example Scenario
```
Cart:
  - Kacchi Biriyani (1:2) - ৳450 [has 50% offer]
  - Beef Tehari (1:3) - ৳350 [has 30% offer]
  - Chicken Roast (single) - ৳250 [no offer]

Membership: Golden Card (10% on all)

Calculation:
  Subtotal: ৳1,050
  
  Membership Discount:
    1050 × 10% = ৳105
  
  Offer Discount:
    Kacchi: 450 × 50% = ৳225
    Tehari: 350 × 30% = ৳105
    Roast: no offer = ৳0
    Total = ৳330
  
  Best Discount: ৳330 (offer wins!)
  
  Final Total: ৳720
```

---

## 📊 Monitoring Offers

### View Active Offers
1. Dashboard → Offers
2. See list with:
   - Name
   - Discount %
   - Type (All Items / Specific Items)
   - Status (Active/Inactive toggle)
   - Actions (Edit/Delete)

### Edit an Offer
1. Click **Edit** button
2. Modify fields
3. Add/remove menu items
4. Click "Save Changes"

### Toggle On/Off
- Click the **toggle switch** in the list
- Instantly activates/deactivates
- No page reload needed

### Delete an Offer
- Click **Delete** icon
- Confirm deletion
- Associated pivot table entries auto-deleted

---

## ⚠️ Important Notes

1. **Cache**: Home page caches for 5 minutes. If offer badge doesn't appear immediately, wait or clear cache:
   ```bash
   php artisan cache:clear
   ```

2. **Multiple Offers**: If multiple offers apply to same item, **highest discount wins**

3. **Offer vs Membership**: Customer always gets the **better discount**, never both combined

4. **Validity Dates**: Offers outside valid period won't show badges or apply discounts

5. **Inactive Offers**: Toggling offer to inactive immediately removes badges from menu cards

6. **All Items Offers**: When editing, changing from "Specific Items" to "All Items" clears menu selections

---

## 🐛 Troubleshooting

### Badge Not Showing
- ✓ Check offer is Active
- ✓ Check validity dates
- ✓ Refresh browser (Ctrl+F5)
- ✓ Clear cache: `php artisan cache:clear`

### Discount Not Applying at Checkout
- ✓ Verify items in cart have offers
- ✓ Check minimum order total requirement
- ✓ Ensure offer not expired
- ✓ Check browser console for JS errors

### Menu Items Not Saving
- ✓ Ensure "Specific Items" is selected
- ✓ At least one item must be selected
- ✓ Check form validation messages

### Performance Issues
- ✓ Cache is enabled (5 min TTL)
- ✓ Run: `php artisan optimize`
- ✓ Check database indexes

---

## 📞 Need Help?

For technical issues:
1. Check `storage/logs/laravel.log` for errors
2. Enable debug mode: `APP_DEBUG=true` in `.env`
3. Test in browser console

---

**Happy Offering! 🎉**
