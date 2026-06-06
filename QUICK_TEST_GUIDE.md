# Quick Test Guide - 5 Minutes

## Setup (30 seconds)

```bash
php artisan cache:clear
```

Then refresh browser.

---

## Test 1: Search (1 minute)

1. Go to `/branches`
2. Click any branch
3. In search box, type: "biryani"
4. ✅ Should see matching items in dropdown
5. ✅ Grid should show only matching items
6. Click one result
7. ✅ Toast notification appears
8. ✅ Item added to cart
9. Clear search (backspace)
10. ✅ Grid resets to show all items

---

## Test 2: Filter (1 minute)

1. On same branch page
2. Click "All Items" - ✅ Show all
3. Click any category (e.g., "Biryani") - ✅ Only that category shows
4. Click different category - ✅ Grid updates
5. Click "All Items" - ✅ All items show again

---

## Test 3: Cards (1 minute)

Look at any card and verify:

- ✅ Image displays (or fork/spoon icon)
- ✅ Title is UPPERCASE in maroon
- ✅ Description is gray
- ✅ "STARTS FROM" label
- ✅ Price in orange (big number)
- ✅ Option badge with beige background
- ✅ "ORDER NOW" button with maroon border
- ✅ Hover effect (card lifts up)

---

## Test 4: Mobile (1 minute)

1. Press F12 to open DevTools
2. Click device icon (mobile view)
3. Set to 375px width
4. ✅ Cards stack vertically
5. ✅ Search works
6. ✅ Filter works
7. ✅ All buttons touch-friendly

---

## Test 5: Notifications (1 minute)

1. Click "ORDER NOW" on any card
2. ✅ Green notification appears top-right
3. ✅ Shows item name and price
4. ✅ Disappears after 3 seconds
5. Click multiple times
6. ✅ Each one shows notification

---

## If Something Doesn't Work

### Search not filtering grid:
- Clear browser cache (Ctrl+Shift+Delete)
- Refresh page (Ctrl+F5)
- Check console (F12) for errors

### Filter buttons not working:
- Try clicking category button multiple times
- Try "All Items" to reset
- Check console for JavaScript errors

### Cards not displaying:
- Check images are loading (Network tab in DevTools)
- Check prices are showing (should be orange)
- Check buttons are visible

### Notifications not showing:
- Make sure Bootstrap is loaded
- Check console for JavaScript errors

---

## What Should Work ✅

1. **Search**
   - Real-time results
   - Grid filters
   - Dropdown shows matches

2. **Filter**
   - Category buttons toggle
   - Grid updates instantly
   - Active button highlights

3. **Cards**
   - Clean design
   - Maroon titles
   - Orange prices
   - Option badges
   - Maroon button

4. **Responsive**
   - Works on mobile (375px)
   - Works on tablet (768px)
   - Works on desktop (1024px+)

---

## Success Indicators

When testing, you should see:

✅ Search shows dropdown with items  
✅ Grid filters to show only matching  
✅ Categories filter instantly  
✅ Cards display clean design  
✅ Prices are orange  
✅ Titles are maroon  
✅ Buttons work on click  
✅ Notifications appear  
✅ Mobile responsive  

---

## Done! 🎉

All features working = Ready for production!

---

## Quick Reference

| Feature | What to Test | Expected Result |
|---------|-------------|-----------------|
| Search | Type "biryani" | Dropdown + grid filtered |
| Filter | Click category | Grid shows only that category |
| Cards | Look at design | Maroon title, orange price |
| Mobile | F12 → Device | Cards stack, all work |
| Click Order | Click button | Toast notification appears |

---

## Troubleshooting Commands

```bash
# Clear everything
php artisan optimize:clear

# Check routes
php artisan route:list | grep branch

# Check database
php artisan tinker
# Type: App\Models\Branch::count()
```

---

**Test it now! It's ready!** ✨
