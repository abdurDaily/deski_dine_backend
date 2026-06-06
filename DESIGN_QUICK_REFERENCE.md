# Design System Quick Reference

## Icon Library - Remixicon

### Remixicon CDN
```html
<link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet" type="text/css" />
```

### Common Icon Classes
```html
<!-- Communication -->
<i class="ri-chat-3-line"></i>          <!-- Chat -->
<i class="ri-chat-quote-line"></i>      <!-- Chat quote -->
<i class="ri-mail-line"></i>            <!-- Email -->

<!-- Status -->
<i class="ri-check-line"></i>           <!-- Check -->
<i class="ri-check-double-line"></i>    <!-- Double check -->
<i class="ri-close-line"></i>           <!-- Close -->
<i class="ri-close-circle-line"></i>    <!-- Close circle -->
<i class="ri-alert-line"></i>           <!-- Alert -->

<!-- Time -->
<i class="ri-time-line"></i>            <!-- Time -->
<i class="ri-hourglass-2-line"></i>     <!-- Hourglass -->
<i class="ri-calendar-line"></i>        <!-- Calendar -->

<!-- Actions -->
<i class="ri-eye-line"></i>             <!-- Eye/View -->
<i class="ri-delete-bin-line"></i>      <!-- Delete -->
<i class="ri-edit-line"></i>            <!-- Edit -->
<i class="ri-save-line"></i>            <!-- Save -->

<!-- Navigation -->
<i class="ri-arrow-left-line"></i>      <!-- Back -->
<i class="ri-arrow-right-line"></i>     <!-- Forward -->
<i class="ri-search-line"></i>          <!-- Search -->
<i class="ri-menu-line"></i>            <!-- Menu -->

<!-- More icons available at: https://remixicon.com -->
```

---

## CSS Class Reference

### Stats Cards
```html
<div class="card stats-card stats-card-purple">
  <!-- Purple gradient card -->
</div>

<div class="card stats-card stats-card-warning">
  <!-- Warning/Orange gradient card -->
</div>

<div class="card stats-card stats-card-success">
  <!-- Success/Green gradient card -->
</div>

<div class="card stats-card stats-card-danger">
  <!-- Danger/Red gradient card -->
</div>
```

### Avatars
```html
<div class="avatar-lg avatar-gradient-purple">
  <i class="ri-chat-quote-line"></i>
</div>

<div class="avatar-lg avatar-gradient-warning">
  <i class="ri-hourglass-2-line"></i>
</div>

<div class="avatar-lg avatar-gradient-success">
  <i class="ri-check-line"></i>
</div>

<div class="avatar-lg avatar-gradient-danger">
  <i class="ri-close-circle-line"></i>
</div>
```

### Buttons
```html
<!-- View Button (Primary/Blue) -->
<button class="btn btn-action btn-view" title="View">
  <i class="ri-eye-line"></i>
</button>

<!-- Approve Button (Success/Green) -->
<button class="btn btn-action btn-approve" title="Approve">
  <i class="ri-check-double-line"></i>
</button>

<!-- Delete Button (Danger/Red) -->
<button class="btn btn-action btn-delete" title="Delete">
  <i class="ri-delete-bin-line"></i>
</button>

<!-- Button Group -->
<div class="btn-group-action" role="group">
  <!-- Multiple buttons -->
</div>
```

### Badges
```html
<!-- Success Badge -->
<span class="badge bg-success">
  Approved
</span>

<!-- Warning Badge -->
<span class="badge bg-warning">
  Pending
</span>

<!-- Danger Badge -->
<span class="badge bg-danger">
  Rejected
</span>

<!-- Info Badge -->
<span class="badge bg-info">
  Info
</span>
```

### Rating Stars
```html
<div class="rating-stars">
  <i class="ri-star-fill star-filled"></i>
  <i class="ri-star-fill star-filled"></i>
  <i class="ri-star-fill star-filled"></i>
  <i class="ri-star-line star-empty"></i>
  <i class="ri-star-line star-empty"></i>
</div>
```

### Search Box
```html
<div class="search-box">
  <input type="text" placeholder="Search...">
</div>
```

---

## Color Variables

### CSS Custom Properties
```css
--color-primary: #667eea
--color-success: #28a745
--color-warning: #f39c12
--color-danger: #dc3545
--color-info: #17a2b8
--color-light: #f8f9fa
--color-dark: #333
--color-muted: #6c757d
```

### Usage in CSS
```css
.my-element {
  color: var(--color-primary);
  background: linear-gradient(135deg, var(--color-success) 0%, var(--color-info) 100%);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}
```

---

## Shadow Depths

### Shadow Variables
```css
--shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.08)      /* Cards, inputs */
--shadow-md: 0 8px 24px rgba(0, 0, 0, 0.12)      /* Button hover */
--shadow-lg: 0 16px 40px rgba(0, 0, 0, 0.15)     /* Modals */
```

### Usage
```css
.card {
  box-shadow: var(--shadow-sm);
}

.card:hover {
  box-shadow: var(--shadow-lg);
}
```

---

## Animation Timings

### Predefined Transitions
```css
/* Cards */
all 0.3s cubic-bezier(0.4, 0, 0.2, 1)

/* Buttons */
all 0.2s ease

/* Interactive elements */
all 0.2s - 0.3s ease
```

### Common Hover Effects
```css
/* Card lift */
transform: translateY(-8px);

/* Button lift */
transform: translateY(-3px);

/* Avatar scale */
transform: scale(1.05);

/* Stars scale */
transform: scale(1.15);
```

---

## Table Styling Classes

### Table Classes
```html
<!-- Reviews table -->
<table class="table reviews-datatable table-hover mb-0">
  <thead class="bg-light">
    <tr>
      <th>Column</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Data</td>
    </tr>
  </tbody>
</table>
```

### Name with Avatar
```html
<div class="name-with-image">
  <img src="" class="name-avatar" />
  <div>Name Here</div>
</div>
```

### Email Link
```html
<a href="mailto:user@example.com" class="email-link">
  user@example.com
</a>
```

---

## Pagination Classes

### Pagination Elements
```html
<ul id="reviewsPagination" class="pagination mb-3">
  <li class="page-item">
    <a class="page-link" href="#">1</a>
  </li>
  <li class="page-item active">
    <a class="page-link" href="#">2</a>
  </li>
  <li class="page-item disabled">
    <a class="page-link" href="#">3</a>
  </li>
</ul>

<div id="paginationInfo" class="flex-grow-1"></div>
```

---

## Modal Classes

### Modal Structure
```html
<div class="modal fade" id="viewModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Title</h5>
        <button type="button" class="btn-close"></button>
      </div>
      <div class="modal-body">
        <!-- Content -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary">Close</button>
        <button class="btn btn-primary">Action</button>
      </div>
    </div>
  </div>
</div>
```

---

## Common Patterns

### Stats Card Pattern
```html
<div class="card border-0 shadow-sm stats-card stats-card-purple">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <div class="flex-grow-1">
        <p class="text-muted mb-2 small fw-bold d-flex align-items-center">
          <i class="ri-chat-3-line me-2 fs-18"></i>LABEL
        </p>
        <h2 class="mb-0 fw-bold stats-number">42</h2>
      </div>
      <div class="avatar-lg avatar-gradient-purple">
        <i class="ri-chat-quote-line"></i>
      </div>
    </div>
  </div>
</div>
```

### Action Button Group Pattern
```html
<div class="btn-group-action" role="group">
  <button class="btn btn-action btn-view" title="View">
    <i class="ri-eye-line"></i>
  </button>
  <button class="btn btn-action btn-approve" title="Approve">
    <i class="ri-check-double-line"></i>
  </button>
  <button class="btn btn-action btn-delete" title="Delete">
    <i class="ri-delete-bin-line"></i>
  </button>
</div>
```

### Status Badge Pattern
```html
<span class="badge bg-success">
  <i class="ri-check-line"></i> Approved
</span>
```

---

## Responsive Breakpoints

### Bootstrap Breakpoints (Maintained)
```css
xs:  < 576px    (mobile)
sm:  ≥ 576px    (phone)
md:  ≥ 768px    (tablet)
lg:  ≥ 992px    (desktop)
xl:  ≥ 1200px   (large desktop)
xxl: ≥ 1400px   (extra large)
```

### Usage
```html
<!-- Hide on mobile -->
<div class="d-none d-md-block">Desktop only</div>

<!-- Show only on mobile -->
<div class="d-md-none">Mobile only</div>

<!-- Responsive classes -->
<div class="col-12 col-md-6 col-lg-3">Responsive column</div>
```

---

## Font Sizes (Remixicon)

### Icon Size Classes
```html
<i class="ri-icon-name fs-12"></i>  <!-- 12px -->
<i class="ri-icon-name fs-14"></i>  <!-- 14px -->
<i class="ri-icon-name fs-16"></i>  <!-- 16px -->
<i class="ri-icon-name fs-18"></i>  <!-- 18px (used in labels) -->
<i class="ri-icon-name fs-20"></i>  <!-- 20px -->
<i class="ri-icon-name fs-22"></i>  <!-- 22px -->
<i class="ri-icon-name fs-24"></i>  <!-- 24px -->
```

---

## Usage Tips

1. **Always use icon titles** for accessibility:
   ```html
   <button title="View review"><i class="ri-eye-line"></i></button>
   ```

2. **Combine gradients for visual interest**:
   ```css
   background: linear-gradient(135deg, var(--color-primary) 0%, #764ba2 100%);
   ```

3. **Use CSS variables** for consistency:
   ```css
   color: var(--color-primary);
   box-shadow: var(--shadow-md);
   ```

4. **Mobile first approach**:
   ```css
   /* Default: mobile */
   .element { font-size: 0.9rem; }
   
   /* Enhanced: desktop */
   @media (min-width: 768px) {
     .element { font-size: 1rem; }
   }
   ```

---

## Resources

- **Remixicon Icons:** https://remixicon.com
- **Bootstrap Documentation:** https://getbootstrap.com
- **CSS Gradients:** https://www.css-gradient.com
- **Color Palette:** https://colorhunt.co

---

## Support

For questions or issues with the design system:
1. Check the DESIGN_IMPROVEMENTS.md file
2. Review DESIGN_CHANGES_VISUAL_GUIDE.md for visual reference
3. Test in different browsers (Chrome, Firefox, Safari)
4. Ensure responsive design on mobile devices
