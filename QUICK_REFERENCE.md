# 🎯 QUICK REFERENCE - NEW OFFER SYSTEM

## ✅ What Was Done

### 1. **Performance** - Home Page Load Time

- ✅ Added pagination (10 categories per page)
- ✅ Optimized database queries with `select()`
- ✅ Only load necessary columns

### 2. **Offer System** - Item-Specific Offers

- ✅ Created `offer_type` field (all_items / specific_items)
- ✅ Created `menu_variation_offer` pivot table
- ✅ Added time-based validity (valid_from / valid_until)
- ✅ Updated Offer & MenuVariation models with relationships

### 3. **Display** - Offer Badges on Cards

- ✅ Created OfferCheckController with API endpoints
- ✅ Created OfferHelper.php with 6 helper functions
- ✅ Registered helpers in composer.json autoload

### 4. **Checkout** - Proper Discount Calculation

- ✅ Per-item offer checking
- ✅ Smart discount logic (max of member/offer discount)
- ✅ Offer details stored in order items JSON

---

## 📋 Database Migration Status

```
✅ Migration 2026_06_05_150000_enhance_offers_system applied
✅ New columns in offers table
✅ New menu_variation_offer pivot table created
```

---

## 🎨 Helper Functions Available

Use in **Blade templates**:

```blade
{{ hasVariationOffer($id) }}              → true/false
{{ getVariationOffer($id) }}              → Offer object
{{ getBestOfferDiscount($id) }}           → 25 (percentage)
{!! renderOfferBadge($id, 'class') !!}   → HTML badge
{{ getDiscountedPrice($id, $price) }}    → 750.50 (amount)
{{ getVariationOffers($id) }}             → Collection
```

---

## 🔌 API Endpoints Available

```
GET  /api/variation/{id}/offers
     Returns: { has_offers, offers[], best_discount }

GET  /api/variations/with-offers
     Returns: { variations[] with offers }
```

---

## 📝 Implementation Steps

### Step 1: Update Your Menu Display Blade

In your view where you show menu items, add this:

```blade
@if(hasVariationOffer($variation->id))
    {!! renderOfferBadge($variation->id, 'badge badge-danger') !!}
@endif

@php $offer = getVariationOffer($variation->id); @endphp

@if($offer)
    <del>৳{{ $variation->price }}</del>
    <strong>৳{{ getDiscountedPrice($variation->id, $variation->price) }}</strong>
@else
    <strong>৳{{ $variation->price }}</strong>
@endif
```

### Step 2: Create Your First Offer

Go to **Admin Panel → Offers → Create**

**Example 1 - All Items:**

- Name: Eid Special
- Discount: 15%
- Offer Type: **All Items**
- Valid From: 2026-06-10
- Valid Until: 2026-06-15

**Example 2 - Specific Items:**

- Name: Biryani Fest
- Discount: 25%
- Offer Type: **Specific Items**
- Select: (checkbox) Chicken Biryani variants
- Valid From: 2026-06-05
- Valid Until: 2026-06-30

### Step 3: Test on Home Page

- Visit home page
- Look for selected menu items
- Should see offer badge on card
- Price should show discount

### Step 4: Test Checkout

- Add discounted item to cart
- Checkout with/without member card
- Verify discount is applied correctly

---

## 🎯 Key Features

| Feature             | How It Works                                      |
| ------------------- | ------------------------------------------------- |
| **All Items Offer** | Applies to every menu item during validity period |
| **Specific Items**  | Only applies to selected menu variations          |
| **Time-Based**      | Set valid_from and valid_until dates              |
| **Member Discount** | Golden card (10%), 1st order (30-35%)             |
| **Smart Stacking**  | Uses HIGHEST: member discount OR item offer       |
| **Offer Badge**     | Auto-displays on card using helper function       |
| **Price Display**   | Shows original + discounted price                 |
| **Bulk API**        | Get offers for all items at once                  |

---

## 🛠️ Files Modified

**New Files:**

- `database/migrations/2026_06_05_150000_enhance_offers_system.php`
- `app/Http/Controllers/Frontend/OfferCheckController.php`
- `app/Helpers/OfferHelper.php`
- `OFFER_SYSTEM_GUIDE.php` (this guide)

**Updated Files:**

- `app/Models/Offer.php` (relationships + scopes)
- `app/Models/MenuVariation.php` (relationships + helpers)
- `app/Http/Controllers/Backend/OfferController.php` (new form logic)
- `app/Http/Controllers/Frontend/HomeController.php` (optimized + new discount calc)
- `routes/web.php` (API endpoints)
- `composer.json` (autoload OfferHelper)

---

## 🚀 Next: Create Your First Offer

### Via Laravel Tinker (Quick Test)

```bash
php artisan tinker

// Create an offer for all items
$offer = \App\Models\Offer::create([
    'name' => 'Test Offer',
    'discount_percent' => 20,
    'applicable_to' => 'all',
    'offer_type' => 'all_items',
    'is_active' => true,
]);

// Create an offer for specific items
$offer = \App\Models\Offer::create([
    'name' => 'Biryani Special',
    'discount_percent' => 25,
    'applicable_to' => 'all',
    'offer_type' => 'specific_items',
    'is_active' => true,
]);

// Attach to menu variation (ID = 5)
$offer->menuVariations()->attach(5);

exit
```

### Via Admin Panel

1. Login to admin
2. Navigate: **System → Offers**
3. Click **Create New Offer**
4. Fill in form
5. If "Specific Items": select menu items
6. Click **Save**

---

## ✨ Example Blade Implementation

```blade
<div class="menu-grid">
    @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>

        @foreach($category->menus as $menu)
            @foreach($menu->variations as $variation)
                <div class="menu-card">
                    <!-- Badge -->
                    @if(hasVariationOffer($variation->id))
                        <div class="offer-badge">
                            {!! renderOfferBadge($variation->id) !!}
                        </div>
                    @endif

                    <!-- Price -->
                    @php $offer = getVariationOffer($variation->id); @endphp
                    <div class="price">
                        @if($offer)
                            <del class="text-muted">৳{{ $variation->price }}</del>
                            <span class="text-success">
                                ৳{{ getDiscountedPrice($variation->id, $variation->price) }}
                            </span>
                        @else
                            ৳{{ $variation->price }}
                        @endif
                    </div>
                </div>
            @endforeach
        @endforeach
    @endforeach
</div>
```

---

## 💡 Pro Tips

1. **Pagination**: Home page now loads 10 categories per page. Add pagination links in Blade:

    ```blade
    {{ $categories->links() }}
    ```

2. **Cache Offers**: For high-traffic sites, cache offer queries:

    ```php
    $offers = cache()->remember('all_active_offers', 300, function() {
        return MenuVariation::with('offers')->get();
    });
    ```

3. **Offer Analytics**: Track which offers drive sales:

    ```php
    $order->items // contains offer_id for each item
    ```

4. **Bulk Load**: Get all items with offers at once:
    ```javascript
    fetch("/api/variations/with-offers").then((r) => r.json());
    ```

---

## ⚠️ Important Notes

- ✅ Migrations already run
- ✅ Database updated
- ✅ Code deployed
- ⏳ **Next**: Update your Blade templates to use helpers
- ⏳ **Then**: Create offers via admin panel
- ⏳ **Test**: Verify badges show on home page

---

## 📞 Troubleshooting

**Q: Offer badge not showing?**

- Check: Is variation ID correct in template?
- Check: Is offer active and within valid dates?
- Check: Run: `php artisan cache:clear`

**Q: Wrong discount on checkout?**

- Check: Is order calculation using new code?
- Check: Are items in correct format in cart?
- Test: Use Tinker to trace calculation

**Q: Helper functions not found?**

- Run: `composer dump-autoload`
- Check: OfferHelper.php in app/Helpers/

**Q: API returning empty?**

- Check: Variation ID exists?
- Check: Offer is active?
- Check: Within valid date range?

---

## 🎓 Learning Resources

See `OFFER_SYSTEM_GUIDE.php` for:

- Complete Blade examples
- JavaScript usage examples
- Admin form full HTML
- Discount calculation logic
- Testing procedures
- All helper function details

---

**Status**: ✅ READY TO USE
**Last Updated**: 2026-06-05
**Version**: 1.0
