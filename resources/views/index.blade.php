@extends('frontend.layout')
@section('frontend_content')
    <!-- HERO  -->
    <section id="home" class="hero">
      <video class="hero-video" autoplay muted loop playsinline preload="auto"
        poster="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=1800&q=80">
        <source src="{{ asset('assets/frontend/video/video.mp4') }}" type="video/mp4" />
      </video>
      <div class="hero-overlay"></div>

      <div class="hero-mobile-stack d-flex d-lg-none align-items-end justify-content-center text-center">
        <div class="container hero-mobile-inner px-3 px-sm-4 pb-4 pb-md-5">
          <p class="hero-mobile-kicker mb-2">Degchi Dine · হালিশহার</p>
          <h2 class="hero-mobile-title">Home of Authentic Kacchi & Biriyani</h2>
          <p class="hero-mobile-copy mx-auto mb-0">
            Formal hospitality meets bold local flavor — dine in or order for
            takeaway in Chittagong.
          </p>
          <div
            class="hero-cta-group d-flex flex-column flex-sm-row gap-2 gap-sm-3 justify-content-center align-items-stretch align-items-sm-center pt-3 pt-sm-4">
            <a href="{{ route('frontend.home') }}#menu" class="btn btn-brand btn-lg px-4 flex-grow-1 flex-sm-grow-0">Order Now</a>
            <a href="{{ route('frontend.home') }}#menu" class="btn btn-brand-outline btn-lg px-4 flex-grow-1 flex-sm-grow-0">Explore Menu</a>
          </div>
        </div>
      </div>

      <div class="hero-side-rail hero-side-right d-none d-lg-flex">
        <a href="https://www.facebook.com/DegchiDine" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i
            class="bi bi-facebook"></i></a>
        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
      </div>

      <div class="container hero-content px-4 px-lg-5 d-none d-lg-flex align-items-center justify-content-center">
        <div class="text-center w-100">
          <h2 class="hero-title">
            Home of Authentic Kacchi & Biriyani
          </h2>
          <p class="hero-copy mt-3 mb-4 mx-auto">
             From slow-cooked Kacchi to flavorful Biriyani, we bring generations of tradition, rich spices, and unforgettable aromas together to create a dining experience that feels like a celebration in every bite.
            </p> 
          <div class="hero-cta-group d-flex flex-wrap gap-3 justify-content-center">
            <a href="{{ route('frontend.home') }}#menu" class="btn btn-brand btn-lg px-4">Order Now</a>
            <a href="{{ route('frontend.home') }}#menu" class="btn btn-brand-outline btn-lg px-4">Explore Menu</a>
          </div>
        </div>
      </div>
    </section>

    <!-- BRANCHES  -->

    <section class="branch-container" id="new_branch">
      <div class="mb-5 text-center reveal py-lg-2">
        <h2 class="section-title mt-2">Our Branches</h2>
        <div class="elegant-divider mx-auto">
          <span></span>
          <i class="fa-solid fa-utensils"></i>
          <span></span>
        </div>
        <p class="section-subtitle">
          Our signature experience across the city
        </p>
      </div>

        <div class="branch-grid">
        @forelse($branches as $branch)
          <a href="tel:{{ $branch->phone }}" class="branch-card">
            <div class="default-state">
              <h3>{{ $branch->name }}</h3>
              <span class="phone-number">
                <i class="fa-solid fa-phone"></i> {{ $branch->phone }}
              </span>
            </div>
            <div class="hover-state">
              <p class="branch-address">{{ $branch->location }}</p>
            </div>
          </a>
        @empty
          <div class="text-center">
            <p class="text-muted">No branches are available at the moment.</p>
          </div>
        @endforelse
      </div>
    </section>

    <!-- MENU  -->
    <section class="menu-section section-block py-5" id="menu">
      <div class="container px-4 px-lg-5">
        <div class="mb-5 text-center reveal">
          <h2 class="section-title mt-2">Loved by Our Guests</h2>
          <div class="elegant-divider mx-auto">
            <span></span>
            <i class="fa-solid fa-heart"></i>
            <!-- Swapped to a heart icon to match the "loved" theme! -->
            <span></span>
          </div>
          <p class="section-subtitle">
            Discover the culinary creations our patrons keep coming back for
          </p>
        </div>

        <div id="menuSlider" class="menu-slider reveal">
          <div class="menu-slider-viewport">
            <div class="menu-slider-track">
              @php
                $sliderMenus = $categories
                    ->pluck('menus')
                    ->flatten()
                    ->filter(fn($menu) => $menu->variations->isNotEmpty())
                    ->take(10);
              @endphp

              @forelse($sliderMenus as $menu)
                @php
                  $firstVariation = $menu->variations->sortBy('price')->first();
                  $imagePath = $firstVariation?->image ?? 'assets/frontend/images/signature_menu/2.jpg';
                  $imageUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                      ? $imagePath
                      : asset($imagePath);
                @endphp
                <div class="menu-slide-item">
                  <a href="#" class="menu-offer-card">
                    <div class="menu-offer-image-wrap">
                      <img src="{{ $imageUrl }}" alt="{{ $menu->name }}" class="menu-offer-image" />
                    </div>
                    <div class="menu-offer-body">
                      <h5 class="menu-offer-title">{{ $menu->name }}</h5>
                      <p class="menu-offer-meta mb-0">
                        {{ \Illuminate\Support\Str::limit($menu->description ?? 'Freshly prepared signature dish from Degchi Dine.', 95) }}
                      </p>
                      <div class="menu-offer-divider"></div>
                      <div class="menu-offer-footer">
                        <div class="menu-offer-price-wrap">
                          <span class="menu-offer-price-label">Starts from</span>
                          <span class="menu-offer-price">৳ {{ number_format((float) ($firstVariation?->price ?? 0), 2) }}</span>
                        </div>
                        <span class="menu-offer-serve"><i class="bi bi-collection"></i> {{ $menu->variations->count() }} option{{ $menu->variations->count() > 1 ? 's' : '' }}</span>
                      </div>
                      <div class="menu-offer-actions" onclick="event.preventDefault()">
                        <button class="menu-offer-cart-btn" type="button">
                          <i class="bi bi-bag-plus" aria-hidden="true"></i>
                          Order Now
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
              @empty
                <div class="menu-slide-item">
                  <div class="menu-offer-card">
                    <div class="menu-offer-body">
                      <h5 class="menu-offer-title">Menu coming soon</h5>
                      <p class="menu-offer-meta mb-0">New dishes will be added shortly.</p>
                    </div>
                  </div>
                </div>
              @endforelse
            </div>
          </div>

          <button class="menu-slider-btn menu-slider-prev" aria-label="Previous">
            <span class="menu-control-icon" aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
          </button>
          <button class="menu-slider-btn menu-slider-next" aria-label="Next">
            <span class="menu-control-icon" aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
          </button>

          <div class="menu-slider-dots"></div>
        </div>

        <div class="menu-slider-footer">
          <a href="{{ route('frontend.completeMenu') }}" class="btn menu-show-more-btn">
            <span>View Complete Menu <i class="bi bi-arrow-right-short ms-1"></i></span>
          </a>
        </div>
      </div>
    </section>

    <!-- MENU CARD -->

    <section class="platter-section">
      <div class="mb-5 text-center reveal py-lg-2">
        <h2 class="section-title mt-2">Our Signature Platters</h2>
        <div class="elegant-divider mx-auto">
          <span></span>
          <i class="fa-solid fa-concierge-bell"></i>
          <span></span>
        </div>
        <p class="section-subtitle">
          Carefully crafted selections perfect for sharing
        </p>
      </div>

      <div class="platter-card-wrapper">
        <div class="platter-card p-0">
          <div class="bg-blob blob-1"></div>
          <div class="bg-blob blob-2"></div>

          <div class="platter-nav-column">
            <div class="slider-nav">
              <div class="nav-item">
                <div class="nav-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=500&q=80"
                    alt="Lunch Feast" />
                  <div class="sticker-badge">
                    <div class="sticker-inner">Lunch<br />Feast</div>
                  </div>
                </div>
              </div>
              <div class="nav-item">
                <div class="nav-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&q=80" alt="Healthy Bowl" />
                  <div class="sticker-badge">
                    <div class="sticker-inner">Healthy<br />Bowl</div>
                  </div>
                </div>
              </div>
              <div class="nav-item">
                <div class="nav-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=500&q=80"
                    alt="Dinner Special" />
                  <div class="sticker-badge">
                    <div class="sticker-inner">Dinner<br />Special</div>
                  </div>
                </div>
              </div>
              <div class="nav-item">
                <div class="nav-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=500&q=80"
                    alt="Chef's Choice" />
                  <div class="sticker-badge">
                    <div class="sticker-inner">Chef's<br />Choice</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="platter-content-column">
            <div class="slider-for">
              <div class="content-item">
                <div class="subtitle-wrapper">
                  <h4 class="platter-subtitle">A MID-DAY FEAST OF INDIA</h4>
                  <span class="subtitle-line"></span>
                </div>
                <h2 class="platter-title">
                  Flavors To Brighten<br />Your Afternoon!
                </h2>
                <p class="platter-desc">
                  Choose from a delightful balance of vegetarian and
                  non-vegetarian dishes — Perfect for a satisfying, flavorful
                  lunch break.
                </p>
                <ul class="platter-features">
                  <li>
                    <i class="fa-solid fa-leaf text-success"></i>
                    <strong>Veg Lunch Special:</strong> Paneer Butter Masala,
                    Dal Tadka, Mixed Vegetable Curry Served with Basmati Rice
                    & Naan
                  </li>
                  <li>
                    <i class="fa-solid fa-drumstick-bite text-warning"></i>
                    <strong>Non-Veg Lunch Special:</strong> Butter Chicken or
                    Chicken Curry, Lamb Rogan Josh, Fish Masala
                  </li>
                </ul>
                <div class="text-center text-lg-start">
                  <button class="btn-order trigger-menu-popup">
                    Order Today
                  </button>
                </div>
              </div>

              <div class="content-item">
                <div class="subtitle-wrapper">
                  <h4 class="platter-subtitle">FRESH & REVITALIZING</h4>
                  <span class="subtitle-line"></span>
                </div>
                <h2 class="platter-title">
                  The Ultimate<br />Healthy Power Bowl
                </h2>
                <p class="platter-desc">
                  A perfect mix of greens, grains, and proteins to keep your
                  energy up throughout the day without feeling heavy.
                </p>
                <ul class="platter-features">
                  <li>
                    <i class="fa-solid fa-bowl-food text-success"></i>
                    <strong>Base:</strong> Organic Quinoa, Fresh Kale, and
                    Roasted Sweet Potatoes
                  </li>
                  <li>
                    <i class="fa-solid fa-seedling text-warning"></i>
                    <strong>Toppings:</strong> Sliced Avocado, Cherry
                    Tomatoes, Toasted Seeds, and our House Vinaigrette
                  </li>
                </ul>
                <button class="btn-order trigger-menu-popup">
                  Order Today
                </button>
              </div>

              <div class="content-item">
                <div class="subtitle-wrapper">
                  <h4 class="platter-subtitle">EVENING INDULGENCE</h4>
                  <span class="subtitle-line"></span>
                </div>
                <h2 class="platter-title">The Grand<br />Dinner Special</h2>
                <p class="platter-desc">
                  A rich and fulfilling spread designed for the perfect
                  evening dining experience with friends and family.
                </p>
                <ul class="platter-features">
                  <li>
                    <i class="fa-solid fa-star text-warning"></i>
                    <strong>Premium Curries:</strong> Mutton Korma, Shahi
                    Paneer, and Dal Makhani
                  </li>
                  <li>
                    <i class="fa-solid fa-bread-slice text-warning"></i>
                    <strong>Accompaniments:</strong> Garlic Naan, Jeera Rice,
                    and Mint Raita
                  </li>
                </ul>
                <button class="btn-order trigger-menu-popup">
                  Order Today
                </button>
              </div>

              <div class="content-item">
                <div class="subtitle-wrapper">
                  <h4 class="platter-subtitle">CURATED PERFECTION</h4>
                  <span class="subtitle-line"></span>
                </div>
                <h2 class="platter-title">
                  The Chef's<br />Exclusive Choice
                </h2>
                <p class="platter-desc">
                  Let our head chef take you on a culinary journey with our
                  most premium, hand-selected seasonal dishes.
                </p>
                <ul class="platter-features">
                  <li>
                    <i class="fa-solid fa-crown text-warning"></i>
                    <strong>Signature Mains:</strong> Tandoori Lobster,
                    Truffle Butter Chicken
                  </li>
                  <li>
                    <i class="fa-solid fa-wine-glass text-danger"></i>
                    <strong>Pairings:</strong> Saffron Pilaf, Assorted Artisan
                    Breads
                  </li>
                </ul>
                <button class="btn-order trigger-menu-popup">
                  Order Today
                </button>
              </div>
            </div>

            <div class="custom-slider-arrows">
              <button class="custom-prev">
                <i class="fa-solid fa-chevron-left"></i>
              </button>
              <button class="custom-next">
                <i class="fa-solid fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div id="menuPopup" class="menu-modal">
      <div class="menu-modal-content">
        <button class="menu-modal-close">
          <i class="fa-solid fa-xmark"></i>
        </button>
        <img src="images/menu_card/1.jpg" alt="Menu Details" />
      </div>
    </div>
    
    <!-- PREMIUM VISUAL SYNC LIGHT LIGHTBOX MODAL -->
    <div class="menu-modal-overlay js-modal-overlay">
      <div class="modal-container-board">
        <button class="close-modal-btn js-close-modal" aria-label="Close window">
          <i class="fas fa-times"></i>
        </button>

        <div class="modal-split-grid">
          <!-- Left Main Product Photo View Frame -->
          <div class="modal-left-view-frame">
            <img id="modal-active-display-img" src="./images/menu_card/1.jpg" alt="Active Menu Canvas View" />
          </div>

          <!-- Right Selection Synchronization Column -->
          <div class="modal-right-nav-column">
            <button class="vert-arrow vert-prev" aria-label="Scroll Up">
              <i class="fas fa-chevron-up"></i>
            </button>
            <button class="vert-arrow vert-next" aria-label="Scroll Down">
              <i class="fas fa-chevron-down"></i>
            </button>

            <div class="vertical-carousel-engine js-modal-nav-carousel">
              <!-- Nav Item 1 -->
              <div class="vertical-carousel-item" data-img="./images/menu_card/1.jpg">
                <div class="vertical-nav-img-box">
                  <img src="./images/menu_card/1.jpg" class="thumb-preview" alt="Thumbnail 1" />
                  <span>bangla menu</span>
                </div>
              </div>
              <!-- Nav Item 2 -->
              <div class="vertical-carousel-item" data-img="./images/menu_card/2.jpg">
                <div class="vertical-nav-img-box">
                  <img src="./images/menu_card/2.jpg" class="thumb-preview" alt="Thumbnail 2" />
                  <span>kacchi menu</span>
                </div>
              </div>
              <!-- Nav Item 3 -->
              <div class="vertical-carousel-item" data-img="./images/menu_card/3.jpg">
                <div class="vertical-nav-img-box">
                  <img src="./images/menu_card/3.jpg" class="thumb-preview" alt="Thumbnail 3" />
                  <span>Mejbani Menu</span>
                </div>
              </div>
              <!-- Nav Item 4 -->
              <div class="vertical-carousel-item" data-img="./images/menu_card/4.jpg">
                <div class="vertical-nav-img-box">
                  <img src="./images/menu_card/4.jpg" class="thumb-preview" alt="Thumbnail 4" />
                  <span>family package</span>
                </div>
              </div>
              <!-- Nav Item 5 -->
              <div class="vertical-carousel-item" data-img="./images/menu_card/4.jpg">
                <div class="vertical-nav-img-box">
                  <img src="./images/menu_card/5.jpg" class="thumb-preview" alt="Thumbnail 4" />
                  <span>bangla menu</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MENU CARD END -->

    <!-- REELS -->
    <section class="section-block py-5 reels-section" id="video">
      <div class="container px-4 px-lg-5">
        <div class="reels-header-shell reveal mb-5">
          <div class="reels-section-header">
            <div class="reels-header-left">
              <!-- <span class="reels-kicker text-uppercase">
                  <i class="bi bi-camera-reels me-1"></i> Behind The Scenes
                </span> -->
              <h2 class="section-title mt-2 mb-2">Watch Us on facebook</h2>
              <p class="section-lead mb-0">
                Kitchen energy, chef moments, and guest vibes from Degchi
                Dine. Fresh reels every week.
              </p>
              <div class="reels-header-cta-mobile d-md-none mt-3">
                <a href="https://www.facebook.com/DegchiDine" class="btn reels-follow-btn w-100 justify-content-center"
                  target="_blank" rel="noopener noreferrer">
                  <i class="bi bi-facebook" aria-hidden="true"></i><span>Follow on Facebook</span>
                </a>
              </div>
            </div>

            <div class="reels-header-right d-none d-md-flex align-items-center">
              <a href="https://www.facebook.com/DegchiDine" class="btn reels-follow-btn" target="_blank"
                rel="noopener noreferrer">
                <i class="bi bi-facebook" aria-hidden="true"></i><span>Follow on Facebook</span>
              </a>
            </div>
          </div>
        </div>

        <div class="reels-slider-container-wrap position-relative">
          <div id="reelsSlider" class="reels-slick reveal">
            <div class="reel-slide-wrap">
              <a class="reel-card" href="https://www.facebook.com/share/r/1cNLa7uWHT/" target="_blank"
                rel="noopener noreferrer">
                <div class="reel-card-thumb">
                  <div class="reel-progress-indicator"></div>
                  <img src="./images/reels/4.jpg" alt="Kitchen Rush reel" loading="lazy" />
                  <div class="reel-card-overlay">
                    <span class="reel-play-icon"><i class="bi bi-play-fill"></i></span>
                    <span class="reel-watch-label text-uppercase"><i class="bi bi-facebook me-1"></i>Watch on
                      Facebook</span>
                  </div>
                </div>
              </a>
            </div>

            <div class="reel-slide-wrap">
              <a class="reel-card" href="https://www.facebook.com/share/r/1cNLa7uWHT/" target="_blank"
                rel="noopener noreferrer">
                <div class="reel-card-thumb">
                  <div class="reel-progress-indicator"></div>
                  <img src="./images/reels/1.jpg" alt="Chef Moments reel" loading="lazy" />
                  <div class="reel-card-overlay">
                    <span class="reel-play-icon"><i class="bi bi-play-fill"></i></span>
                    <span class="reel-watch-label text-uppercase"><i class="bi bi-facebook me-1"></i>Watch on
                      Facebook</span>
                  </div>
                </div>
              </a>
            </div>

            <div class="reel-slide-wrap">
              <a class="reel-card" href="https://www.facebook.com/share/r/1cNLa7uWHT/" target="_blank"
                rel="noopener noreferrer">
                <div class="reel-card-thumb">
                  <div class="reel-progress-indicator"></div>
                  <img src="./images/reels/2.jpg" alt="Guest Vibes reel" loading="lazy" />
                  <div class="reel-card-overlay">
                    <span class="reel-play-icon"><i class="bi bi-play-fill"></i></span>
                    <span class="reel-watch-label text-uppercase"><i class="bi bi-facebook me-1"></i>Watch on
                      Facebook</span>
                  </div>
                </div>
              </a>
            </div>
            <div class="reel-slide-wrap">
              <a class="reel-card" href="https://www.facebook.com/share/r/1cNLa7uWHT/" target="_blank"
                rel="noopener noreferrer">
                <div class="reel-card-thumb">
                  <div class="reel-progress-indicator"></div>
                  <img src="./images/reels/2.jpg" alt="Guest Vibes reel" loading="lazy" />
                  <div class="reel-card-overlay">
                    <span class="reel-play-icon"><i class="bi bi-play-fill"></i></span>
                    <span class="reel-watch-label text-uppercase"><i class="bi bi-facebook me-1"></i>Watch on
                      Facebook</span>
                  </div>
                </div>
              </a>
            </div>

            <div class="reel-slide-wrap">
              <a class="reel-card" href="https://www.facebook.com/share/r/1cNLa7uWHT/" target="_blank"
                rel="noopener noreferrer">
                <div class="reel-card-thumb">
                  <div class="reel-progress-indicator"></div>
                  <img src="./images/reels/3.jpg" alt="Signature Dish preparation reel" loading="lazy" />
                  <div class="reel-card-overlay">
                    <span class="reel-play-icon"><i class="bi bi-play-fill"></i></span>
                    <span class="reel-watch-label text-uppercase"><i class="bi bi-facebook me-1"></i>Watch on
                      Facebook</span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ABOUT -->
    <section class="section-block py-5 about-section" id="about">
      <div class="container px-4 px-lg-5">
        <div class="row align-items-center g-5">
          <div class="col-12 col-lg-6 reveal">
            <div class="about-content-block">
              <span class="about-kicker text-uppercase">
                <i class="bi bi-heart-fill me-1" aria-hidden="true"></i> Our
                Heritage
              </span>
              <h2 class="section-title mt-2 mb-3">
                The Story of Degchi Dine
              </h2>
              <p class="about-lead mb-4">
                Bringing the authentic, slow-cooked royal culinary traditions
                of heritage clay-pot dining straight to your contemporary
                table.
              </p>
              <p class="about-paragraph mb-4">
                At Degchi Dine, every recipe tells a story of patience, craft,
                and passion. We specialize in traditional Dum cooking
                methods—where premium cuts of meat, fragrant basmati rice, and
                freshly crushed spice masalas are sealed tightly inside heavy
                vessels, allowing the ingredients to mature perfectly in their
                own steam.
              </p>

              <div class="about-features-grid d-flex flex-wrap gap-4 mb-4">
                <div class="about-feature-item d-flex align-items-center gap-3">
                  <div class="feature-icon-box">
                    <i class="bi bi-fire"></i>
                  </div>
                  <span class="feature-text text-uppercase">Authentic Dum Style</span>
                </div>
                <div class="about-feature-item d-flex align-items-center gap-3">
                  <div class="feature-icon-box">
                    <i class="bi bi-patch-check-fill"></i>
                  </div>
                  <span class="feature-text text-uppercase">Premium Ingredients</span>
                </div>
              </div>

              <div class="about-cta-wrap">
                <a href="about-detail.html" class="btn about-explore-btn">
                  <span>Read Full Journey <i class="bi bi-arrow-right ms-2"></i></span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6 reveal">
            <div class="about-media-frame position-relative">
              <div class="about-shape-backdrop"></div>

              <div class="about-img-container">
                <img src="./images/about.png" alt="Our authentic kitchen craft" class="about-main-img" />
                <div class="about-img-overlay"></div>
              </div>

              <div class="about-experience-badge text-center">
                <span class="exp-number">10+</span>
                <span class="exp-text text-uppercase">Years Of Culinary Craft</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials / Guest Impressions Slider Section -->
    <section class="section-block reviews-section" id="testimonials">
      <div class="container px-4 px-lg-5">
        <div class="mb-5 text-center reveal">
          <!-- <span class="badge badge-soft rounded-pill mb-3"
              >Guest Impressions</span -->
          >
          <h2 class="section-title">What Our Guests Say</h2>
          <div class="title-divider mx-auto"></div>
        </div>

        <div class="reviews-slider">
          <div class="review-slide-item">
            <div class="review-card">
              <div class="review-quote-icon">
                <i class="bi bi-quote"></i>
              </div>
              <div class="review-stars mb-3">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="review-text">
                "Authentic flavors that remind me of old traditional cookery.
                The premium Kacchi items are absolutely worth every visit."
              </p>
              <hr class="review-divider" />
              <div class="review-author">
                <img src="https://i.pravatar.cc/150?u=asif" class="review-avatar" alt="Asif R." />
                <div class="author-info">
                  <strong class="d-block">Asif R.</strong>
                  <span class="text-muted small">Food Enthusiast</span>
                </div>
              </div>
            </div>
          </div>

          <div class="review-slide-item">
            <div class="review-card">
              <div class="review-quote-icon">
                <i class="bi bi-quote"></i>
              </div>
              <div class="review-stars mb-3">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="review-text">
                "The atmosphere is elegant without feeling stiff. Every course
                was balanced, flavorful, and beautifully presented."
              </p>
              <hr class="review-divider" />
              <div class="review-author">
                <img src="https://i.pravatar.cc/150?u=eleanor" class="review-avatar" alt="Eleanor W." />
                <div class="author-info">
                  <strong class="d-block">Eleanor W.</strong>
                  <span class="text-muted small">Regular Guest</span>
                </div>
              </div>
            </div>
          </div>

          <div class="review-slide-item">
            <div class="review-card">
              <div class="review-quote-icon">
                <i class="bi bi-quote"></i>
              </div>
              <div class="review-stars mb-3">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="review-text">
                "From arrival to dessert, service was impeccable. A perfect
                venue for formal client dinners and traditional feasts."
              </p>
              <hr class="review-divider" />
              <div class="review-author">
                <img src="https://i.pravatar.cc/150?u=daniel" class="review-avatar" alt="Daniel C." />
                <div class="author-info">
                  <strong class="d-block">Daniel C.</strong>
                  <span class="text-muted small">Business Dining</span>
                </div>
              </div>
            </div>
          </div>

          <div class="review-slide-item">
            <div class="review-card">
              <div class="review-quote-icon">
                <i class="bi bi-quote"></i>
              </div>
              <div class="review-stars mb-3">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="review-text">
                "The best dining experience in Chittagong. The staff knows
                exactly how to treat you like royalty while serving hot, fresh
                food."
              </p>
              <hr class="review-divider" />
              <div class="review-author">
                <img src="https://i.pravatar.cc/150?u=mira" class="review-avatar" alt="Mira L." />
                <div class="author-info">
                  <strong class="d-block">Mira L.</strong>
                  <span class="text-muted small">Seasonal Guest</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--  -->


    <section class="section-block pt-0" id="location">
      <div class="container px-4 px-lg-5">

        <!-- Elegant Header -->
        <div class="mb-5 text-center reveal py-lg-2">
          <h2 class="section-title mt-2">Visit Us</h2>
          <div class="elegant-divider mx-auto">
            <span></span>
            <i class="fa-solid fa-map-location-dot"></i>
            <span></span>
          </div>
          <p class="section-subtitle">We look forward to welcoming you</p>
        </div>

        <!-- The Masterpiece Location Layout -->
        <div class="location-container reveal">

          <!-- LEFT COLUMN: The Premium Info Card -->
          <div class="location-info-card">
            <h3 class="info-title">Degchi Dine</h3>

            <div class="info-list">
              <!-- Item 1 -->
              <div class="info-item">
                <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="info-text">
                  <strong>Address</strong>
                  <p>Boropool Circle, Kaptan Villa,<br>Halishahar, Chittagong.</p>
                </div>
              </div>

              <!-- Item 2 -->
              <div class="info-item">
                <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
                <div class="info-text">
                  <strong>Opening Hours</strong>
                  <p>Mon - Sun: 11:00 AM - 11:00 PM</p>
                </div>
              </div>

              <!-- Item 3 -->
              <div class="info-item">
                <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="info-text">
                  <strong>Reservations</strong>
                  <p>+880 1234 567 890</p>
                </div>
              </div>
            </div>

            <!-- Interactive CTA Button -->
            <a href="https://maps.google.com" target="_blank" class="btn-directions">
              Get Directions
              <i class="fa-solid fa-arrow-right-long btn-arrow"></i>
            </a>
          </div>

          <!-- RIGHT COLUMN: The Map -->
          <div class="location-map-card">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.669527376662!2d91.7766299!3d22.3283281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjLCsDE5JzQyLjAiTiA5McKwNDYnMzUuOSJF!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
              title="Degchi Dine location map"></iframe>
          </div>

        </div>
      </div>
    </section>

@endsection