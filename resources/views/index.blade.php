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
                  
                  // Get ALL active offers on this variation (not just best one)
                  $activeOffers = $firstVariation?->offers->sortByDesc('discount_percent') ?? collect();
                  $bestOffer = $activeOffers->first();
                @endphp
                <div class="menu-slide-item">
                  <a href="#" class="menu-offer-card">
                    <div class="menu-offer-image-wrap" style="position: relative;">
                      <img src="{{ $imageUrl }}" alt="{{ $menu->name }}" class="menu-offer-image"
                           onerror="this.src='{{ asset('assets/frontend/images/placeholder.webp') }}'" />
                      
                      @if($activeOffers->count() > 0)
                        {{-- Offer icon badge (left side) --}}
                        <div class="offer-icon-badge" title="Special Offer Available!">
                          <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        
                        {{-- Discount badge (right side) --}}
                        @if($activeOffers->count() === 1)
                          {{-- Single offer badge --}}
                          <div class="offer-badge-card">
                            <i class="bi bi-tag-fill"></i> {{ $bestOffer->discount_percent }}% OFF
                          </div>
                        @else
                          {{-- Multiple offers - stack badges --}}
                          <div class="offer-badge-card offer-badge-multiple" style="padding: 0.3rem 0.6rem;">
                            <i class="bi bi-tags-fill"></i> {{ $activeOffers->count() }} OFFERS
                          </div>
                          <div class="offer-badge-card" style="top: 52px; font-size: 0.7rem; padding: 0.3rem 0.6rem;">
                            Up to {{ $bestOffer->discount_percent }}% OFF
                          </div>
                        @endif
                      @endif
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
                          @if($bestOffer)
                            <span class="menu-offer-price" style="text-decoration: line-through; opacity: 0.6; font-size: 0.9em;">
                              ৳ {{ number_format((float) ($firstVariation?->price ?? 0), 2) }}
                            </span>
                            <span class="menu-offer-price text-danger fw-bold">
                              ৳ {{ number_format((float) ($firstVariation?->price ?? 0) * (1 - $bestOffer->discount_percent / 100), 2) }}
                            </span>
                          @else
                            <span class="menu-offer-price">৳ {{ number_format((float) ($firstVariation?->price ?? 0), 2) }}</span>
                          @endif
                        </div>
                        <span class="menu-offer-serve"><i class="bi bi-collection"></i> {{ $menu->variations->count() }} option{{ $menu->variations->count() > 1 ? 's' : '' }}</span>
                      </div>
                      <div class="menu-offer-actions" onclick="event.preventDefault()">
                        <button class="menu-offer-cart-btn" type="button" 
                                data-variation-id="{{ $firstVariation?->id }}"
                                data-original-price="{{ $firstVariation?->price ?? 0 }}">
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
                <div class="text-center text-lg-start">
                  <button class="btn-order trigger-menu-popup">
                    Order Today
                  </button>
                </div>
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
                <div class="text-center text-lg-start">
                  <button class="btn-order trigger-menu-popup">
                    Order Today
                  </button>
                </div>
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
                <div class="text-center text-lg-start">
                  <button class="btn-order trigger-menu-popup">
                    Order Today
                  </button>
                </div>
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
                <a href="{{ $contactSettings['contact_facebook_url']->value ?? 'https://www.facebook.com/DegchiDine' }}" class="btn reels-follow-btn w-100 justify-content-center"
                  target="_blank" rel="noopener noreferrer">
                  <i class="bi bi-facebook" aria-hidden="true"></i><span>Follow on Facebook</span>
                </a>
              </div>
            </div>

            <div class="reels-header-right d-none d-md-flex align-items-center">
              <a href="{{ $contactSettings['contact_facebook_url']->value ?? 'https://www.facebook.com/DegchiDine' }}" class="btn reels-follow-btn" target="_blank"
                rel="noopener noreferrer">
                <i class="bi bi-facebook" aria-hidden="true"></i><span>Follow on Facebook</span>
              </a>
            </div>
          </div>
        </div>

        <div class="reels-slider-container-wrap position-relative">
          <div id="reelsSlider" class="reels-slick reveal">
            @forelse($facebookReels as $reel)
              @php
                $reelThumbnail = $reel->thumbnail
                    ? (\Illuminate\Support\Str::startsWith($reel->thumbnail, ['http://', 'https://'])
                        ? $reel->thumbnail
                        : asset('uploads/reels/' . $reel->thumbnail))
                    : asset('assets/frontend/images/placeholder.webp');
                $reelUrl = $reel->facebook_url ?: 'https://www.facebook.com/DegchiDine';
              @endphp
              <div class="reel-slide-wrap">
                <a class="reel-card" href="{{ $reelUrl }}" target="_blank" rel="noopener noreferrer">
                  <div class="reel-card-thumb">
                    <div class="reel-progress-indicator"></div>
                    <img src="{{ $reelThumbnail }}" alt="{{ $reel->title ?? 'Facebook Reel' }}" loading="lazy" />
                    <div class="reel-card-overlay">
                      <span class="reel-play-icon"><i class="bi bi-play-fill"></i></span>
                      <span class="reel-watch-label text-uppercase"><i class="bi bi-facebook me-1"></i>Watch on Facebook</span>
                    </div>
                  </div>
                </a>
              </div>
            @empty
              <div class="reel-slide-wrap">
                <div class="reel-card">
                  <div class="reel-card-thumb">
                    <div class="reel-progress-indicator"></div>
                    <img src="{{ asset('assets/frontend/images/placeholder.webp') }}" alt="No reels available" loading="lazy" />
                    <div class="reel-card-overlay">
                      <span class="reel-play-icon"><i class="bi bi-play-fill"></i></span>
                      <span class="reel-watch-label text-uppercase"><i class="bi bi-facebook me-1"></i>Watch on Facebook</span>
                    </div>
                  </div>
                </div>
              </div>
            @endforelse
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
              @php
                $aboutKicker = optional($aboutSettings->get('about_kicker'))->value ?? 'Our Heritage';
                $aboutTitle = optional($aboutSettings->get('about_title'))->value ?? 'The Story of Degchi Dine';
                $aboutLead = optional($aboutSettings->get('about_lead'))->value ?? 'Bringing the authentic, slow-cooked royal culinary traditions of heritage clay-pot dining straight to your contemporary table.';
                $aboutParagraph = optional($aboutSettings->get('about_paragraph'))->value ?? 'At Degchi Dine, every recipe tells a story of patience, craft, and passion. We specialize in traditional Dum cooking methods—where premium cuts of meat, fragrant basmati rice, and freshly crushed spice masalas are sealed tightly inside heavy vessels, allowing the ingredients to mature perfectly in their own steam.';
                $aboutFeature1Icon = optional($aboutSettings->get('about_feature_1_icon'))->value ?? 'bi bi-fire';
                $aboutFeature1Text = optional($aboutSettings->get('about_feature_1_text'))->value ?? 'Authentic Dum Style';
                $aboutFeature2Icon = optional($aboutSettings->get('about_feature_2_icon'))->value ?? 'bi bi-patch-check-fill';
                $aboutFeature2Text = optional($aboutSettings->get('about_feature_2_text'))->value ?? 'Premium Ingredients';
                $aboutExpNumber = optional($aboutSettings->get('about_exp_number'))->value ?? '10+';
                $aboutExpText = optional($aboutSettings->get('about_exp_text'))->value ?? 'Years Of Culinary Craft';
                $aboutCtaUrl = optional($aboutSettings->get('about_cta_url'))->value ?? route('frontend.completeMenu');
                $aboutImage = optional($aboutSettings->get('about_image'))->value ? asset('uploads/about/' . optional($aboutSettings->get('about_image'))->value) : asset('assets/frontend/images/about.png');
              @endphp

              <span class="about-kicker text-uppercase">
                <i class="bi bi-heart-fill me-1" aria-hidden="true"></i> {{ $aboutKicker }}
              </span>
              <h2 class="section-title mt-2 mb-3">
                {{ $aboutTitle }}
              </h2>
              <p class="about-lead mb-4">
                {{ $aboutLead }}
              </p>
              <div class="about-paragraph mb-4">
                {!! $aboutParagraph !!}
              </div>

              <div class="about-features-grid d-flex flex-wrap gap-4 mb-4">
                <div class="about-feature-item d-flex align-items-center gap-3">
                  <div class="feature-icon-box">
                    <i class="{{ $aboutFeature1Icon }}"></i>
                  </div>
                  <span class="feature-text text-uppercase">{{ $aboutFeature1Text }}</span>
                </div>
                <div class="about-feature-item d-flex align-items-center gap-3">
                  <div class="feature-icon-box">
                    <i class="{{ $aboutFeature2Icon }}"></i>
                  </div>
                  <span class="feature-text text-uppercase">{{ $aboutFeature2Text }}</span>
                </div>
              </div>

              <div class="about-cta-wrap">
                <a href="{{ $aboutCtaUrl }}" class="btn about-explore-btn">
                  <span>Read Full Journey <i class="bi bi-arrow-right ms-2"></i></span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6 reveal">
            <div class="about-media-frame position-relative">
              <div class="about-shape-backdrop"></div>

              <div class="about-img-container">
                <img src="{{ $aboutImage }}" alt="About image" class="about-main-img" onerror="this.src='{{ asset('assets/frontend/images/about.png') }}'" />
                <div class="about-img-overlay"></div>
              </div>

              <div class="about-experience-badge text-center">
                <span class="exp-number">{{ $aboutExpNumber }}</span>
                <span class="exp-text text-uppercase">{{ $aboutExpText }}</span>
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
        @php
          $contactTitle = optional($contactSettings->get('contact_section_title'))->value ?? 'Visit Us';
          $contactSubtitle = optional($contactSettings->get('contact_section_subtitle'))->value ?? 'We look forward to welcoming you';
          $contactName = optional($contactSettings->get('contact_restaurant_name'))->value ?? 'Degchi Dine';
          $contactAddress = optional($contactSettings->get('contact_address'))->value ?? 'Boropool Circle, Kaptan Villa, Halishahar, Chittagong.';
          $contactHours = optional($contactSettings->get('contact_hours'))->value ?? 'Mon - Sun: 11:00 AM - 11:00 PM';
          $contactPhone = optional($contactSettings->get('contact_phone'))->value ?? '+880 1234 567 890';
          $contactMapLink = optional($contactSettings->get('contact_map_link'))->value ?: 'https://maps.google.com';
          $contactMapEmbed = optional($contactSettings->get('contact_map_embed'))->value ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.669527376662!2d91.7766299!3d22.3283281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjLCsDE5JzQyLjAiTiA5McKwNDYnMzUuOSJF!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd';
          $contactFacebookUrl = optional($contactSettings->get('contact_facebook_url'))->value ?? 'https://www.facebook.com/DegchiDine';
          $contactInstagramUrl = optional($contactSettings->get('contact_instagram_url'))->value ?? '#';
        @endphp

        <div class="mb-5 text-center reveal py-lg-2">
          <h2 class="section-title mt-2">{{ $contactTitle }}</h2>
          <div class="elegant-divider mx-auto">
            <span></span>
            <i class="fa-solid fa-map-location-dot"></i>
            <span></span>
          </div>
          <p class="section-subtitle">{{ $contactSubtitle }}</p>
        </div>

        <!-- The Masterpiece Location Layout -->
        <div class="location-container reveal">

          <!-- LEFT COLUMN: The Premium Info Card -->
          <div class="location-info-card">
            <h3 class="info-title">{{ $contactName }}</h3>

            <div class="info-list">
              <!-- Item 1 -->
              <div class="info-item">
                <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="info-text">
                  <strong>Address</strong>
                  <p>{!! nl2br(e($contactAddress)) !!}</p>
                </div>
              </div>

              <!-- Item 2 -->
              <div class="info-item">
                <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
                <div class="info-text">
                  <strong>Opening Hours</strong>
                  <p>{{ $contactHours }}</p>
                </div>
              </div>

              <!-- Item 3 -->
              <div class="info-item">
                <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="info-text">
                  <strong>Reservations</strong>
                  <p><a href="tel:{{ preg_replace('/\D+/', '', $contactPhone) }}">{{ $contactPhone }}</a></p>
                </div>
              </div>
            </div>

            <!-- Interactive CTA Button -->
            <a href="{{ $contactMapLink }}" target="_blank" class="btn-directions">
              Get Directions
              <i class="fa-solid fa-arrow-right-long btn-arrow"></i>
            </a>
          </div>

          <!-- RIGHT COLUMN: The Map -->
          <div class="location-map-card">
            <iframe
              src="{{ $contactMapEmbed }}"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="{{ $contactName }} location map"></iframe>
          </div>

        </div>
      </div>
    </section>

    {{-- ══ Offer Popup Ad ══ --}}
    @if(isset($popupOffer) && $popupOffer)
    <div id="offerPopupOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.65); z-index:9990; align-items:center; justify-content:center;">
        <div style="position:relative; background:#fff; border-radius:18px; max-width:480px; width:90%; overflow:hidden; box-shadow:0 24px 60px rgba(0,0,0,.4); animation:offerPopIn .4s cubic-bezier(.34,1.56,.64,1);">
            {{-- Close button --}}
            <button onclick="closeOfferPopup()" style="position:absolute; top:12px; right:12px; z-index:2; background:rgba(0,0,0,.5); border:none; color:#fff; border-radius:50%; width:32px; height:32px; font-size:1.1rem; cursor:pointer; display:flex; align-items:center; justify-content:center;">&times;</button>

            {{-- Badge --}}
            @if($popupOffer->popup_badge)
            <div style="position:absolute; top:16px; left:16px; z-index:2; background:#e74c3c; color:#fff; font-size:.72rem; font-weight:700; letter-spacing:.08em; padding:4px 12px; border-radius:20px; text-transform:uppercase;">
                {{ $popupOffer->popup_badge }}
            </div>
            @endif

            {{-- Image --}}
            @if($popupOffer->popup_image)
            <img src="{{ asset('storage/' . $popupOffer->popup_image) }}"
                 alt="{{ $popupOffer->name }}"
                 onerror="this.src='{{ asset('assets/frontend/images/placeholder.webp') }}'"
                 style="width:100%; max-height:240px; object-fit:cover; display:block;">
            @else
            <div style="background:linear-gradient(135deg,#c0392b,#e74c3c); height:140px; display:flex; align-items:center; justify-content:center;">
                <span style="font-size:3.5rem;">🎉</span>
            </div>
            @endif

            {{-- Body --}}
            <div style="padding:24px 26px 28px;">
                @if($popupOffer->discount_percent > 0)
                <div style="font-size:2.8rem; font-weight:800; color:#e74c3c; line-height:1; margin-bottom:4px;">
                    {{ $popupOffer->discount_percent }}% <span style="font-size:1.1rem; font-weight:600; color:#444;">OFF</span>
                </div>
                @endif
                <h3 style="font-size:1.2rem; font-weight:700; color:#1a1a1a; margin:6px 0 8px;">{{ $popupOffer->name }}</h3>
                @if($popupOffer->description)
                <p style="font-size:.88rem; color:#666; margin:0 0 20px; line-height:1.55;">{{ $popupOffer->description }}</p>
                @endif
                
                @php
                    // Determine the redirect URL based on offer type
                    $redirectUrl = route('frontend.completeMenu');
                    
                    if ($popupOffer->offer_type === 'specific_items' && $popupOffer->menuVariations->isNotEmpty()) {
                        // Get unique categories from the offer's menu items
                        $categories = $popupOffer->menuVariations->pluck('menu.category')->unique()->filter();
                        if ($categories->count() === 1) {
                            // If all items are from same category, filter by category
                            $redirectUrl = route('frontend.completeMenu', ['category' => $categories->first()->slug, 'offer' => $popupOffer->id]);
                        } else {
                            // Multiple categories, just pass offer ID to show all offer items
                            $redirectUrl = route('frontend.completeMenu', ['offer' => $popupOffer->id]);
                        }
                    }
                @endphp
                
                <div style="display:flex; gap:10px;">
                    <a href="{{ $redirectUrl }}" style="flex:1; background:#e74c3c; color:#fff; text-align:center; padding:11px; border-radius:10px; text-decoration:none; font-weight:700; font-size:.88rem;">
                        Order Now &rarr;
                    </a>
                    <button onclick="closeOfferPopup()" style="flex:1; background:#f5f5f5; color:#555; border:none; padding:11px; border-radius:10px; font-weight:600; font-size:.88rem; cursor:pointer;">
                        Maybe Later
                    </button>
                </div>
                {{-- Don't show again --}}
                <label style="display:flex; align-items:center; gap:6px; margin-top:14px; font-size:.78rem; color:#999; cursor:pointer;">
                    <input type="checkbox" id="offerDontShow" style="cursor:pointer;">
                    Don't show again today
                </label>
            </div>
        </div>
    </div>
    <style>
        @keyframes offerPopIn {
            from { transform: scale(.7); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }
    </style>
    <script>
        (function(){
            var key = 'offer_hidden_{{ $popupOffer->id }}';
            var hidden = sessionStorage.getItem(key);
            if(!hidden){
                setTimeout(function(){
                    var el = document.getElementById('offerPopupOverlay');
                    if(el){ el.style.display = 'flex'; }
                }, 1200);
            }
        })();
        function closeOfferPopup(){
            var el = document.getElementById('offerPopupOverlay');
            if(el) el.style.display = 'none';
            if(document.getElementById('offerDontShow')?.checked){
                sessionStorage.setItem('offer_hidden_{{ $popupOffer->id }}', '1');
            }
        }
        document.getElementById('offerPopupOverlay')?.addEventListener('click', function(e){
            if(e.target === this) closeOfferPopup();
        });
    </script>
    @endif

<script>
  // Handle view menu card button clicks in signature platters section
  document.addEventListener('DOMContentLoaded', function() {
    const viewPlatterCardBtns = document.querySelectorAll('.view-platter-card-btn');
    const modalOverlay = document.querySelector('.js-modal-overlay');
    const closeModalBtn = document.querySelector('.js-close-modal');
    const modalImg = document.getElementById('modal-active-display-img');

    viewPlatterCardBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const menuImage = this.getAttribute('data-menu-image');
        const menuTitle = this.getAttribute('data-menu-title');
        if (menuImage && modalImg && modalOverlay) {
          modalImg.src = menuImage;
          modalImg.alt = menuTitle;
          modalOverlay.style.display = 'flex';
        }
      });
    });

    // Close modal when close button is clicked
    if (closeModalBtn) {
      closeModalBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (modalOverlay) {
          modalOverlay.style.display = 'none';
        }
      });
    }

    // Close modal when clicking on overlay background
    if (modalOverlay) {
      modalOverlay.addEventListener('click', function(e) {
        if (e.target === this) {
          this.style.display = 'none';
        }
      });
    }
  });
</script>

@endsection