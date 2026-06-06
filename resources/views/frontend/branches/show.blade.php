@extends('frontend.layout')
@section('frontend_content')

<style>
    :root {
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --accent-orange: #f39c12;
        --accent-maroon: #8B3A3A;
        --light-bg: #f8f9fa;
        --dark-text: #212529;
        --muted-text: #6c757d;
    }

    .branch-hero-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 40px;
    }

    .branch-hero-header h1 {
        margin: 0 0 10px 0;
        font-size: 2.2rem;
        font-weight: 800;
    }

    .branch-info-line {
        display: flex;
        gap: 30px;
        margin-top: 15px;
        font-size: 0.95rem;
        flex-wrap: wrap;
    }

    .branch-info-line a {
        color: white;
        text-decoration: none;
        transition: opacity 0.3s;
    }

    .branch-info-line a:hover {
        opacity: 0.8;
    }

    /* Delivery Services Section */
    .delivery-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 35px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .delivery-section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark-text);
        margin: 0 0 25px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .delivery-services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
    }

    .delivery-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 25px 15px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background: white;
        text-decoration: none;
        color: var(--dark-text);
        transition: all 0.3s;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .delivery-btn:hover {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%);
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(102,126,234,0.15);
        text-decoration: none;
        color: var(--dark-text);
    }

    .delivery-logo {
        width: 60px;
        height: 60px;
        margin-bottom: 12px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Search & Filter Section */
    .search-filter-section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 35px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .search-wrapper {
        position: relative;
        margin-bottom: 20px;
    }

    .search-input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(102,126,234,0.1);
    }

    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e9ecef;
        border-top: none;
        border-radius: 0 0 10px 10px;
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        margin-top: -2px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .search-result-item {
        padding: 15px 18px;
        border-bottom: 1px solid #e9ecef;
        cursor: pointer;
        transition: background 0.2s;
    }

    .search-result-item:hover {
        background: var(--light-bg);
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-name {
        font-weight: 700;
        color: var(--dark-text);
        margin-bottom: 4px;
    }

    .search-result-meta {
        font-size: 0.85rem;
        color: var(--muted-text);
    }

    /* Category Filter */
    .category-nav {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 10px;
        -webkit-overflow-scrolling: touch;
    }

    .category-btn {
        padding: 10px 20px;
        border: 2px solid #e9ecef;
        background: white;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        white-space: nowrap;
        color: var(--muted-text);
    }

    .category-btn:hover {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }

    .category-btn.active {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }

    /* Menu Grid - Matching Reference Image */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 28px;
    }

    .menu-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        border: 1px solid #e9ecef;
    }

    .menu-card.hidden {
        display: none;
    }

    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        border-color: var(--accent-maroon);
    }

    .menu-card-image {
        width: 100%;
        height: 200px;
        background: #d3d3d3;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
    }

    .menu-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .menu-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .menu-card-title {
        font-weight: 700;
        font-size: 1rem;
        color: var(--accent-maroon);
        margin: 0 0 10px 0;
        line-height: 1.3;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .menu-card-description {
        font-size: 0.85rem;
        color: var(--muted-text);
        margin-bottom: 15px;
        line-height: 1.5;
        flex: 1;
    }

    .menu-card-price-section {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .menu-card-price-label {
        font-size: 0.7rem;
        color: var(--muted-text);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
    }

    .menu-card-price {
        font-weight: 700;
        font-size: 1.3rem;
        color: var(--accent-orange);
    }

    .menu-card-options {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        color: var(--muted-text);
        background: #f5f1e8;
        padding: 6px 12px;
        border-radius: 6px;
        width: fit-content;
    }

    .menu-card-options i {
        font-size: 0.9rem;
    }

    .order-now-btn {
        width: 100%;
        padding: 12px;
        background: transparent;
        color: var(--accent-maroon);
        border: 2px solid var(--accent-maroon);
        border-radius: 6px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.95rem;
        margin-top: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .order-now-btn:hover {
        background: var(--accent-maroon);
        color: white;
    }

    .no-items {
        text-align: center;
        padding: 60px 20px;
        color: var(--muted-text);
        font-size: 1.05rem;
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .branch-hero-header h1 {
            font-size: 1.6rem;
        }

        .branch-info-line {
            flex-direction: column;
            gap: 10px;
        }

        .menu-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .delivery-services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<!-- Branch Hero Header -->
<div class="branch-hero-header">
    <div class="container">
        <h1>{{ $branch->name }}</h1>
        <div class="branch-info-line">
            <div>📍 {{ $branch->location }}</div>
            <div>📞 <a href="tel:{{ $branch->phone }}">{{ $branch->phone }}</a></div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Delivery Services Section -->
    @if(!empty($deliveryServices))
        <div class="delivery-section">
            <h3 class="delivery-section-title">
                <i class="ri-e-bike-2-fill"></i> Order for Quick Delivery
            </h3>
            <div class="delivery-services-grid">
                @foreach($deliveryServices as $key => $service)
                    <a href="{{ $service['url'] }}" target="_blank" rel="noopener noreferrer" class="delivery-btn">
                        @php
                            $logoUrl = null;
                            if ($key === 'foodpanda' && $branch->foodpanda_logo) {
                                $logoUrl = strpos($branch->foodpanda_logo, 'http') === 0 
                                    ? $branch->foodpanda_logo 
                                    : asset('uploads/branches/' . $branch->foodpanda_logo);
                            } elseif ($key === 'pathao' && $branch->pathao_logo) {
                                $logoUrl = strpos($branch->pathao_logo, 'http') === 0 
                                    ? $branch->pathao_logo 
                                    : asset('uploads/branches/' . $branch->pathao_logo);
                            } elseif ($key === 'foodi' && $branch->foodi_logo) {
                                $logoUrl = strpos($branch->foodi_logo, 'http') === 0 
                                    ? $branch->foodi_logo 
                                    : asset('uploads/branches/' . $branch->foodi_logo);
                            }
                        @endphp
                        
                        @if($logoUrl)
                            <img src="{{ $logoUrl }}" class="delivery-logo" alt="{{ $service['name'] }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%23667eea'/%3E%3Ctext x='50' y='55' font-size='40' font-weight='bold' fill='white' text-anchor='middle'%3E{{ strtoupper(substr($key, 0, 1)) }}%3C/text%3E%3C/svg%3E" class="delivery-logo" alt="{{ $service['name'] }}" style="display:none;">
                        @else
                            @if($key === 'foodpanda')
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%23E62E04'/%3E%3Ctext x='50' y='55' font-size='40' font-weight='bold' fill='white' text-anchor='middle'%3EF%3C/text%3E%3C/svg%3E" class="delivery-logo" alt="FoodPanda">
                            @elseif($key === 'pathao')
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%23F71735'/%3E%3Ctext x='50' y='55' font-size='50' font-weight='bold' fill='white' text-anchor='middle'%3EP%3C/text%3E%3C/svg%3E" class="delivery-logo" alt="Pathao">
                            @elseif($key === 'foodi')
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%23C71E1E'/%3E%3Ctext x='50' y='52' font-size='35' font-weight='bold' fill='white' text-anchor='middle'%3E%26%3C/text%3E%3C/svg%3E" class="delivery-logo" alt="Foodi">
                            @endif
                        @endif
                        {{ $service['name'] }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Search & Filter Section -->
    <div class="search-filter-section">
        <div class="search-wrapper">
            <input type="text" class="search-input" id="menuSearch" placeholder="🔍 Search menu items...">
            <div class="search-results" id="searchResults"></div>
        </div>

        <div class="category-nav" id="categoryNav">
            <button class="category-btn active" data-category="all">All Items</button>
            @foreach($categories as $category)
                <button class="category-btn" data-category="{{ $category->id }}">{{ $category->name }}</button>
            @endforeach
        </div>
    </div>

    <!-- Menu Grid -->
    <div>
        @if($categories->isEmpty() || $categories->every(fn($c) => $c->menus->isEmpty()))
            <div class="no-items">
                <p>No menu items available for this branch.</p>
            </div>
        @else
            <div class="menu-grid" id="menuGrid">
                @foreach($categories as $category)
                    @foreach($category->menus as $menu)
                        @php
                            $firstVariation = $menu->variations->sortBy('price')->first();
                            $imagePath = $firstVariation?->image ?? null;
                            if ($imagePath) {
                                $imageUrl = strpos($imagePath, 'http') === 0
                                    ? $imagePath
                                    : asset($imagePath);
                            } else {
                                $imageUrl = null;
                            }
                            $minPrice = $menu->variations->min('price') ?? 0;
                        @endphp
                        <div class="menu-card category-item" data-category="{{ $category->id }}" data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}" data-menu-price="{{ $minPrice }}">
                            <div class="menu-card-image">
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $menu->name }}" onerror="this.parentElement.style.background='#d3d3d3'; this.style.display='none';">
                                @else
                                    <i class="ri-restaurant-2-line"></i>
                                @endif
                            </div>
                            <div class="menu-card-body">
                                <h5 class="menu-card-title">{{ $menu->name }}</h5>
                                <p class="menu-card-description">{{ Str::limit($menu->description ?? 'Fresh and delicious item', 80) }}</p>
                                
                                <div class="menu-card-price-section">
                                    <div>
                                        <div class="menu-card-price-label">Starts from</div>
                                        <div class="menu-card-price">৳ {{ number_format((float) $minPrice, 2) }}</div>
                                    </div>
                                    <div class="menu-card-options">
                                        <i class="ri-stack-line"></i>
                                        <span>{{ $menu->variations->count() }} option{{ $menu->variations->count() > 1 ? 's' : '' }}</span>
                                    </div>
                                </div>

                                <button class="order-now-btn add-to-cart" type="button" data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}" data-menu-price="{{ $minPrice }}">
                                    <i class="ri-shopping-bag-line"></i> Order Now
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    $(document).ready(function() {
        const branchSlug = '{{ $branch->slug }}';
        let allMenus = [];

        // Store all menus data on page load
        function storeMenusData() {
            $('.category-item').each(function() {
                allMenus.push({
                    id: $(this).data('menu-id'),
                    name: $(this).data('menu-name'),
                    price: $(this).data('menu-price'),
                    category: $(this).data('category'),
                    element: this
                });
            });
        }

        storeMenusData();

        // Category Filter
        $('.category-btn').click(function(e) {
            e.preventDefault();
            $('.category-btn').removeClass('active');
            $(this).addClass('active');
            
            const categoryId = $(this).data('category');
            
            if (categoryId === 'all') {
                $('.category-item').removeClass('hidden');
            } else {
                $('.category-item').addClass('hidden');
                $('.category-item[data-category="' + categoryId + '"]').removeClass('hidden');
            }
            
            // Clear search when filtering
            $('#menuSearch').val('');
            $('#searchResults').empty().hide();
        });

        // Menu Search with AJAX
        let searchTimeout;
        $('#menuSearch').on('keyup', function() {
            clearTimeout(searchTimeout);
            const query = $(this).val().trim();
            
            if (query.length < 2) {
                $('#searchResults').empty().hide();
                // Reset to all items
                $('.category-item').removeClass('hidden');
                return;
            }

            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: "{{ route('frontend.branches.search-menu', $branch->slug) }}",
                    method: 'GET',
                    data: { q: query },
                    dataType: 'json',
                    success: function(response) {
                        const results = response.data;
                        let html = '';

                        if (results.length > 0) {
                            // Hide all items first
                            $('.category-item').addClass('hidden');
                            
                            results.forEach(item => {
                                // Show matching items
                                $('.category-item[data-menu-id="' + item.id + '"]').removeClass('hidden');
                                
                                html += `
                                    <div class="search-result-item" data-menu-id="${item.id}" data-menu-name="${item.name}" data-menu-price="${item.price}">
                                        <div class="search-result-name">${item.name}</div>
                                        <div class="search-result-meta">
                                            ${item.category} · ৳${parseFloat(item.price).toFixed(2)}
                                        </div>
                                    </div>
                                `;
                            });
                        } else {
                            html = '<div class="search-result-item"><div class="search-result-name">No items found</div></div>';
                        }

                        $('#searchResults').html(html).show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Search error:', error);
                        $('#searchResults').html('<div class="search-result-item"><div class="search-result-name">Error searching</div></div>').show();
                    }
                });
            }, 300);
        });

        // Add to cart from search result
        $(document).on('click', '.search-result-item', function() {
            const menuId = $(this).data('menu-id');
            if (!menuId) return;
            
            const menuName = $(this).data('menu-name');
            const menuPrice = $(this).data('menu-price');
            
            addToCart(menuId, menuName, menuPrice);
            $('#menuSearch').val('');
            $('#searchResults').empty().hide();
            
            // Reset to all items
            $('.category-btn').removeClass('active');
            $('.category-btn[data-category="all"]').addClass('active');
            $('.category-item').removeClass('hidden');
        });

        // Add to cart button
        $(document).on('click', '.add-to-cart', function() {
            const menuId = $(this).data('menu-id');
            const menuName = $(this).data('menu-name');
            const menuPrice = $(this).data('menu-price');
            
            addToCart(menuId, menuName, menuPrice);
        });

        function addToCart(menuId, menuName, menuPrice) {
            // Show notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-success alert-dismissible fade show';
            notification.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; width: 90%; max-width: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';
            notification.innerHTML = `
                <strong>✓ Added!</strong> "${menuName}" added to cart (৳${parseFloat(menuPrice).toFixed(2)})
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(notification);
            
            // Trigger cart update event if available
            $(document).trigger('cartUpdated', { menuId, menuName, menuPrice });
            
            setTimeout(() => notification.remove(), 3000);
        }

        // Close search results when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.search-wrapper').length) {
                $('#searchResults').hide();
            }
        });
    });
</script>

@endsection
