# Review System Documentation

## Overview
A complete membership-based review system for Degchi Dine restaurant that allows only members with membership cards to submit reviews. Reviews are automatically attached with member profile images and require admin approval before display.

## Features

### 1. Frontend - Reviews Display Page
**File:** `resources/views/frontend/reviews.blade.php`
- Displays all approved reviews with member profile images
- Layout switcher: Single row or double column view
- Responsive design with smooth animations
- Shows member name, review title, rating (1-5 stars), and comment
- Pagination support
- NO review submission form on this page

### 2. Frontend - Contact/Review Submission Page
**File:** `resources/views/frontend/contact.blade.php`
- Combined contact information and review submission form
- Accessible via `/contact` route
- Members enter membership card number for verification
- System validates member card and pulls member data automatically
- Collects: Rating (1-5 stars), Title, Comment
- Profile image is automatically pulled from member account
- Prevents duplicate reviews from the same member
- Beautiful contact information display with social links

### 3. Frontend Navigation
**Updated File:** `resources/views/frontend/layout.blade.php`
- "Reviews" link → Shows approved reviews only
- "Contact" link → Shows review submission form + contact info
- Mobile and desktop navigation updated

### 4. Backend - Dashboard Integration
**Updated File:** `resources/views/components/dashboard-nav.blade.php`
- New "Reviews" menu item in dashboard sidebar
- Icon: ri-star-line
- Route: `/admin/reviews`

### 5. Backend - Reviews Management Page
**File:** `resources/views/backend/reviews/index.blade.php`
- Yajra DataTable with server-side processing
- Stats cards showing:
  - Total reviews
  - Pending reviews (warning badge)
  - Approved reviews (success badge)
  - Rejected reviews (danger badge)
- DataTable columns:
  - ID
  - Name (with member profile image)
  - Email
  - Rating (star display)
  - Title
  - Comment (truncated)
  - Status (badge color-coded)
  - Submitted date
  - Actions (View, Approve, Reject, Delete)
- Modal popup for detailed review view with member image
- Search functionality across all fields
- Pagination and sorting
- Bulk actions for approve/reject/delete

## Database

### Reviews Table Structure
```sql
CREATE TABLE reviews (
  id BIGINT PRIMARY KEY,
  member_id BIGINT FOREIGN KEY (members),
  name VARCHAR(255),
  email VARCHAR(255),
  rating INT (1-5),
  comment TEXT,
  title VARCHAR(255) NULLABLE,
  image VARCHAR(255) NULLABLE, -- Profile image from member
  status ENUM('pending', 'approved', 'rejected'),
  approved_at TIMESTAMP NULLABLE,
  approved_by BIGINT FOREIGN KEY (users),
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  INDEX: status, member_id
);
```

### Migration
**File:** `database/migrations/2026_06_06_review_system.php`
- Creates reviews table with all required fields
- Adds foreign key relationships to members and users
- Automatic timestamps

## Models

### Review Model
**File:** `app/Models/Review.php`
```php
- Fillable: member_id, name, email, rating, comment, title, image, status, approved_at, approved_by
- Relationships:
  - member(): belongsTo(Member)
  - approvedBy(): belongsTo(User)
- Scopes:
  - approved() - where status = 'approved'
  - pending() - where status = 'pending'
  - rejected() - where status = 'rejected'
```

## Controllers

### Frontend ReviewController
**File:** `app/Http/Controllers/Frontend/ReviewController.php`

#### index()
- Returns approved reviews with pagination (12 per page)
- Eager loads member relationship
- Ordered by approval date (newest first)

#### store()
- Validates membership card number
- Finds member by card_number
- Validates member has uploaded profile image
- Checks for duplicate reviews from same member
- Creates review with auto-populated member data:
  - Name from member
  - Email from member
  - Profile image from member
  - Status: pending (requires admin approval)
- Returns JSON response

### Backend ReviewController
**File:** `app/Http/Controllers/Backend/ReviewController.php`

#### index()
- **AJAX request:** Returns DataTable JSON for server-side processing
  - Paginated data (10, 25, 50, 100 per page)
  - Searchable across: name, email, comment
  - Includes action buttons for each review
  - Renders member images in list
- **Regular request:** Returns view with stats cards

#### approve($id)
- Updates review status to 'approved'
- Sets approved_at timestamp
- Tracks approved_by (admin user ID)
- Returns JSON success

#### reject($id)
- Updates review status to 'rejected'
- Tracks approved_by (admin user ID)
- Returns JSON success

#### delete($id)
- Deletes review permanently
- Returns JSON success

## Routes

### Frontend Routes
```php
GET  /reviews              → ReviewController@index    (frontend.reviews.index)
POST /reviews              → ReviewController@store    (frontend.reviews.store)
GET  /contact              → ReviewController@index    (frontend.contact)
```

### Backend Routes
```php
GET    /admin/reviews              → ReviewController@index      (admin.reviews.index)
POST   /admin/reviews/{id}/approve → ReviewController@approve    (admin.reviews.approve)
POST   /admin/reviews/{id}/reject  → ReviewController@reject     (admin.reviews.reject)
DELETE /admin/reviews/{id}         → ReviewController@delete     (admin.reviews.delete)
```

## Workflow

### Member Submits Review
1. Member goes to `/contact` page
2. Enters membership card number
3. System validates card number against members table
4. System checks member has uploaded profile image
5. Member selects rating (1-5 stars)
6. Member enters review title (optional)
7. Member enters review comment (min 10 chars)
8. System checks member doesn't already have pending/approved review
9. Review is created with:
   - Auto-populated member data
   - Member's profile image
   - Status: pending
10. Member sees success message
11. Redirected to reviews page

### Admin Approves Review
1. Admin goes to `/admin/reviews` dashboard
2. Views all reviews in DataTable
3. Can search by name, email, or comment
4. Clicks "View" to see full details in modal (with member image)
5. Clicks "Approve" button
6. Review status changes to "approved"
7. Review now appears on public `/reviews` page

### Admin Rejects Review
1. Admin views review details
2. Clicks "Reject" button
3. Review status changes to "rejected"
4. Review doesn't appear on public page
5. Can still be viewed by admin but marked as rejected

### Admin Deletes Review
1. Admin clicks delete button on DataTable or modal
2. Confirms deletion
3. Review is permanently removed

## Validation

### Member Submission Validation
- **member_card_number:** Required, string, max 100 chars
- **rating:** Required, integer, 1-5 range
- **title:** Optional, string, max 150 chars
- **comment:** Required, string, min 10 chars, max 1000 chars

### Member Card Validation
- Card number must exist in members table
- Member must have uploaded a profile_image
- Member cannot have pending or approved review

## Styling & UI

### Color Scheme
- Primary: Purple gradient (#667eea - #764ba2)
- Accent: Orange (#f39c12) for ratings
- Status Badges:
  - Pending: Warning (yellow)
  - Approved: Success (green)
  - Rejected: Danger (red)

### Components
- Card-based design with hover effects
- Star rating system (interactive)
- Circular profile images (48x48 or 80x80)
- Responsive grid layout
- DataTable with Bootstrap 5 styling
- Modal popup for detailed view
- Quote icons on review cards
- Beautiful form styling

## Relationships

```
Member (1) ──→ (Many) Review
  - A member can have multiple reviews (but only one pending/approved at a time)
  - Profile image flows from member → review

User (1) ──→ (Many) Review (via approved_by)
  - An admin user approves multiple reviews
  - Tracks who approved each review
```

## File Structure

```
app/
├── Models/
│   └── Review.php
└── Http/
    └── Controllers/
        ├── Frontend/
        │   └── ReviewController.php
        └── Backend/
            └── ReviewController.php

database/
└── migrations/
    └── 2026_06_06_review_system.php

resources/
└── views/
    ├── frontend/
    │   ├── reviews.blade.php      (Approved reviews display)
    │   └── contact.blade.php      (Review submission form)
    ├── backend/
    │   └── reviews/
    │       └── index.blade.php    (Admin dashboard)
    └── components/
        └── dashboard-nav.blade.php (Menu item added)

routes/
└── web.php                         (Review routes configured)
```

## JavaScript Libraries

### Frontend
- Toastr.js - Notifications
- Bootstrap 5 - Modal popups
- Vanilla JavaScript - Star rating, form handling

### Backend
- jQuery 3.6.0
- DataTables 1.11.5
- Bootstrap 5 responsive tables
- Vanilla JavaScript - AJAX operations

## Testing Checklist

- [ ] Migration runs without errors
- [ ] Member can submit review with valid card number
- [ ] System rejects invalid card numbers
- [ ] System rejects reviews without profile image
- [ ] System prevents duplicate reviews
- [ ] Review form submits and shows success message
- [ ] Admin can see reviews in DataTable
- [ ] Admin can approve review (status changes)
- [ ] Admin can reject review (status changes)
- [ ] Admin can delete review (removed from database)
- [ ] Approved reviews appear on public page
- [ ] Member images display correctly
- [ ] Search functionality works
- [ ] Pagination works
- [ ] Responsive design works on mobile
- [ ] Navigation links work (Reviews, Contact)
- [ ] Dashboard menu item appears

## Future Enhancements

- Review editing by admin
- Review response system (restaurant can reply)
- Email notifications when review is approved
- Review filtering by rating
- Review sorting (newest, oldest, highest rating, lowest rating)
- Review pagination (load more)
- Review thumbs up/down system
- Reply notifications to reviewers
- Export reviews to CSV/PDF
