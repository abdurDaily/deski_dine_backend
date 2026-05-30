@extends('frontend.layout')
@section('frontend_content')
      <!-- Checkout Hero Banner -->
      <div class="cart-page-hero">
        <div class="container px-4 px-lg-5">
          <div
            class="d-flex align-items-center justify-content-between flex-wrap gap-3"
          >
            <div>
              <span class="menu-kicker"
                ><i class="bi bi-shield-lock"></i> Secure Order</span
              >
              <h1 class="cart-hero-title mt-1">Checkout</h1>
            </div>
            <div class="cart-stepper">
              <span class="cart-step">
                <i class="bi bi-bag me-1"></i>Cart
              </span>
              <i class="bi bi-chevron-right cart-step-arrow"></i>
              <span class="cart-step cart-step-active">
                <i class="bi bi-credit-card me-1"></i>Checkout
              </span>
              <i class="bi bi-chevron-right cart-step-arrow"></i>
              <span class="cart-step">
                <i class="bi bi-check-circle me-1"></i>Confirmed
              </span>
            </div>
          </div>
        </div>
      </div>

      <section class="section-block cart-page-section">
        <div class="container px-4 px-lg-5">
          <div class="row g-4 align-items-start">
            <!-- Left: Checkout Form -->
            <div class="col-lg-7">
              <form id="checkoutForm" class="checkout-form-card" action="{{ route('frontend.order.store') }}" method="POST">
                @csrf

                <div id="checkoutMessages"></div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Delivery Details -->
                <div class="checkout-form-section">
                  <h6 class="checkout-form-heading">
                    <span class="checkout-step-num">1</span>
                    Delivery Details
                  </h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Full Name</label>
                      <div class="checkout-input-wrap">
                        <i class="bi bi-person checkout-input-icon"></i>
                        <input
                          class="form-control checkout-input"
                          required
                          type="text"
                          name="customer_name"
                          placeholder="e.g. Rahim Uddin"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Phone Number</label>
                      <div class="checkout-input-wrap">
                        <i class="bi bi-telephone checkout-input-icon"></i>
                        <input
                          class="form-control checkout-input"
                          required
                          type="tel"
                          name="customer_phone"
                          placeholder="01XXXXXXXXX"
                        />
                      </div>
                    </div>
                    <div class="col-12">
                      <label class="form-label">Delivery Address</label>
                      <div class="checkout-input-wrap checkout-textarea-wrap">
                        <i
                          class="bi bi-geo-alt checkout-input-icon checkout-textarea-icon"
                        ></i>
                        <textarea
                          class="form-control checkout-input"
                          required
                          rows="3"
                          name="customer_address"
                          placeholder="House/Flat, Road, Area, City"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Membership Card Number</label>
                        <div class="checkout-input-wrap">
                          <i class="bi bi-credit-card checkout-input-icon"></i>
                          <input
                            class="form-control checkout-input"
                            required
                            type="text"
                            name="member_card_number"
                            placeholder="Enter your registered card number"
                          />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check mt-4 pt-2">
                            <input class="form-check-input" type="checkbox" name="student_card" value="1" id="studentCard" />
                            <label class="form-check-label" for="studentCard">I can show a student card</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Order Total (৳)</label>
                        <div class="checkout-input-wrap">
                          <i class="bi bi-cash-stack checkout-input-icon"></i>
                          <input
                            class="form-control checkout-input"
                            required
                            readonly
                            type="number"
                            step="0.01"
                            min="0"
                            name="order_total"
                            value="0"
                          />
                        </div>
                    </div>
                    <input type="hidden" name="items" value="[]" />
                  </div>
                </div>

                <div class="checkout-form-divider"></div>

                <div class="checkout-form-divider"></div>

                <!-- Payment Method -->
                <div class="checkout-form-section">
                  <h6 class="checkout-form-heading">
                    <span class="checkout-step-num">2</span>
                    Payment Method
                  </h6>
                  <div class="checkout-payment-options">
                    <label class="checkout-payment-card">
                      <input type="radio" name="payment_method" value="cod" checked />
                      <span class="checkout-payment-body">
                        <i class="bi bi-cash-stack checkout-payment-icon"></i>
                        <span>Cash on Delivery</span>
                      </span>
                    </label>
                    <label class="checkout-payment-card">
                      <input type="radio" name="payment_method" value="bkash" />
                      <span class="checkout-payment-body">
                        <i
                          class="bi bi-phone checkout-payment-icon"
                          style="color: #e2136e"
                        ></i>
                        <span>bKash</span>
                      </span>
                    </label>
                  </div>
                </div>
              </form>
              <!-- /form -->
            </div>

            <!-- Right: Order Summary -->
            <div class="col-lg-5">
              <div class="cart-summary-card checkout-summary-sticky">
                <div class="cart-summary-header">
                  <i class="bi bi-receipt me-2"></i>Your Order
                </div>

                <div class="checkout-summary-items-wrap">
                  <!-- Item 1 -->
                  <div class="checkout-order-item">
                    <img
                      src="images/signature_menu/1.jpg"
                      alt="Mutton Kacchi"
                      class="checkout-order-img"
                    />
                    <div class="checkout-order-info">
                      <p class="checkout-order-name">Mutton Kacchi</p>
                      <span class="checkout-order-price">৳ 420 × 1</span>
                    </div>
                    <strong class="checkout-order-subtotal">৳ 420</strong>
                  </div>
                  <!-- Item 2 -->
                  <div class="checkout-order-item">
                    <img
                      src="images/signature_menu/4.jpg"
                      alt="Kacchi Biryani"
                      class="checkout-order-img"
                    />
                    <div class="checkout-order-info">
                      <p class="checkout-order-name">Kacchi Biryani</p>
                      <span class="checkout-order-price">৳ 360 × 2</span>
                    </div>
                    <strong class="checkout-order-subtotal">৳ 720</strong>
                  </div>
                </div>

                <div class="cart-summary-body">
                  <div class="cart-summary-row">
                    <span
                      >Subtotal
                      <small class="text-muted">(2 items)</small></span
                    >
                    <span id="checkoutSubtotal">৳ 1,140</span>
                  </div>
                  <div class="cart-summary-row">
                    <span>Delivery</span>
                    <span class="cart-free-tag">Free</span>
                  </div>
                  <div class="cart-summary-divider"></div>
                  <div class="cart-summary-total-row">
                    <span>Total</span>
                    <strong id="checkoutTotal" class="cart-summary-total-val"
                      >৳ 1,140</strong
                    >
                  </div>
                </div>

                <div class="cart-summary-footer">
                  <button
                    type="submit"
                    form="checkoutForm"
                    class="btn cart-checkout-btn w-100"
                  >
                    <i class="bi bi-bag-check me-2"></i>Place Order
                  </button>
                  <p class="cart-secure-note">
                    <i class="bi bi-shield-check me-1"></i>Your information is
                    100% secure
                  </p>
                </div>
              </div>

              <a
                href="{{ route('frontend.addtocart') }}"
                class="cart-continue-link mt-3 d-inline-flex align-items-center"
              >
                <i class="bi bi-arrow-left me-2"></i>Back to Cart
              </a>
            </div>
          </div>
          <!-- /row -->
        </div>
      </section>
@endsection